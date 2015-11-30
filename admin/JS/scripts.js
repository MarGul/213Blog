jQuery(document).ready(function($) {
    // For displaying the Edit and Delete actions on a data table.
    $('.data-table tr').hover(function(){
        $(this).find('.table-actions').css('visibility', 'visible');
    }, function() {
        $(this).find('.table-actions').css('visibility', 'hidden');
    });

    // For sliding up the alert messages after 5 seconds
    $('.alert-success').delay(3000).slideUp(500);

    // AJAX request for deleting a user
    $('.delete-user').on('click', function(event) {
        event.preventDefault();

        var deleteConfirm = confirm('Are you sure you want to delete this user?');

        if(deleteConfirm) {
            // Grab the user ID
            var usrID = parseInt($(this).data('id'));
            // Grab the table row
            var tableRow = $(this).closest('tr');

            // Send the ajax request
            $.ajax({
                url: 'user_delete.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    usrID: usrID
                },
                success: function (data) {
                    if (data.success) {
                        tableRow.remove();
                    }
                }
            });
        }
    });

    // AJAX request for trashing a blog
    $('.delete-blog').on('click', function(event) {
        event.preventDefault();

        var deleteConfirm = confirm('Are you sure you want to delete this post?');

        // Grab the blog ID
        var blogID = parseInt($(this).data('id'));
        // Grab the table row
        var tableRow = $(this).closest('tr');

        // Send the ajax request
        $.ajax({
            url: 'blog_delete.php',
            method: 'GET',
            dataType: 'JSON',
            data: {
                blogID: blogID,
                ajax: true
            },
            success: function (data) {
                if (data.success) {
                    tableRow.remove();
                }
            }
        })
    });

    // For adding tags
    $('.add-tag').on('click', function(e) {
        e.preventDefault();

        var tagList   = $('#tagsList');
        var input     = $(this).closest('.input-group').find('input');
        var tagName   = input.val();
        var exists    = tagList.find('li:contains(' + tagName + ')').length;
        var tagsInput = $('#tags');
        var arrTags   = $.parseJSON(tagsInput.val());

        if(!exists) {
            tagList.append('<li><span>' + tagName + '</span><button type="button" class="delete-tag"><i class="fa fa-minus-circle"></i></button></li>');
            input.val('');
            arrTags.push(tagName);
            tagsInput.val(JSON.stringify(arrTags));
        }
    });

    // For deleting a tag
    $('#tagsList').on('click', '.delete-tag', function(e) {
        e.preventDefault();

        var tagName   = $(this).closest('li').find('span').text();
        var tagsInput = $('#tags');
        var arrTags   = $.parseJSON(tagsInput.val());

        for(var i = 0; i < arrTags.length; i++) {
            if(tagName == arrTags[i]) {
                arrTags.splice(i, 1);
            }
        }

        $(this).closest('li').remove();
        tagsInput.val(JSON.stringify(arrTags));
    });
});
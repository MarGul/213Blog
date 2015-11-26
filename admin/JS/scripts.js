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
});
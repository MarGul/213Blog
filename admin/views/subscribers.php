<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">
        <main class="page">

            <h2>
                Subscribers
            </h2>


            <table class="table table-striped data-table">
                <thead>
                <tr>
                    <th width="50%">Author</th>
                    <th width="40%">Email</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($objData->subscribers as $subscriber) { ?>
                    <tr>
                        <td>
                            <?php echo $subscriber['author']->getFirstname() . ' ' . $subscriber['author']->getLastname(); ?>
                            <div class="table-actions">
                                <a href="#" class="text-danger delete-subscriber"
                                   data-id="<?php echo $subscriber['id']; ?>">Unsubscribe</a>
                            </div>
                        </td>
                        <td><?php echo $subscriber['email']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>

                <tfoot>
                <tr>
                    <th>Author</th>
                    <th>Email</th>
                </tr>
                </tfoot>
            </table>

        </main>
    </div>

<?php include('views/admin_footer.php') ?>
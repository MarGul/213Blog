<?php include('views/admin_header.php') ?>

    <script type="text/javascript" src="JS/scripts.js"></script>

    <div class="container">
        <main class="page">

            <h2>
                Users
                <a href="user_register.php" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-user-plus"></i> Add New User</a>
            </h2>


            <table class="table table-striped data-table">
                <thead>
                    <tr>
                        <th width="35%">Email</th>
                        <th width="35%">Name</th>
                        <th width="20%">Role</th>
                        <th width="10%">Posts</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($objData->users as $user) { ?>
                    <tr>
                        <td>
                            <?php echo $user->email; ?>
                            <div class="table-actions">
                                <a href="user_edit.php?usrID=<?php echo $user->id; ?>" class="text-blue">Edit</a> |
                                <a href="#" class="text-danger delete-user" data-id="<?php echo $user->id; ?>">Delete</a>
                            </div>
                        </td>
                        <td><?php echo $user->firstname . ' ' . $user->lastname; ?></td>
                        <td><?php echo ($user->admin) ? 'Administrator' : 'Author'; ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Posts</th>
                    </tr>
                </tfoot>
            </table>

        </main>
    </div>

<?php include('views/admin_footer.php') ?>
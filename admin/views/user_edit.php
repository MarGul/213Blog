<?php include('views/admin_header.php') ?>

    <div class="container">
        <main class="page">

            <h2>Edit User</h2>

            <form action="" method="POST">

                <?php if($objData->error) echo '<div class="alert alert-danger" role="alert"><strong>Error Input</strong><br>' . implode('<br>', $objData->msg) . '</div>'; ?>
                <?php if($objData->success) echo '<div class="alert alert-success" role="alert"><strong>Success</strong><br>' . implode('<br>', $objData->msg) . '</div>'; ?>


                <div class="form-group <?php echo (in_array('email', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrEmail">Email:</label>
                    <input type="email" name="usrEmail" id="usrEmail" class="form-control" value="<?php echo $objData->input['email']; ?>">
                </div>

                <div class="form-group <?php echo (in_array('firstname', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrFirstName">First Name:</label>
                    <input type="text" name="usrFirstName" id="usrFirstName" class="form-control" value="<?php echo $objData->input['firstname']; ?>">
                </div>

                <div class="form-group <?php echo (in_array('lastname', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrLastName">Last Name:</label>
                    <input type="text" name="usrLastName" id="usrLastName" class="form-control" value="<?php echo $objData->input['lastname']; ?>">
                </div>

                <div class="form-group">
                    <label for="usrWebsite">Website</label>
                    <input type="text" name="usrWebsite" id="usrWebsite" class="form-control" value="<?php echo $objData->input['website']; ?>">
                </div>

                <div class="form-group <?php echo (in_array('password', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrPassword">Password:</label>
                    <input type="password" name="usrPassword" id="usrPassword" class="form-control">
                </div>

                <div class="form-group <?php echo (in_array('password', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrPasswordRepeat">Repeat password:</label>
                    <input type="password" name="usrPasswordRepeat" id="usrPasswordRepeat" class="form-control">
                </div>

                <div class="form-group <?php echo (in_array('admin', $objData->errors)) ? 'has-error' : ''; ?>">
                    <label for="usrRole">User Role:</label>
                    <select name="usrRole" id="usrRole" class="form-control">
                        <option value="0" <?php echo ($objData->input['admin'] == 0) ? 'selected="selected"' : ''; ?>>Author</option>
                        <option value="1" <?php echo ($objData->input['admin'] == 1) ? 'selected="selected"' : ''; ?>>Administrator</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Update User">

            </form>

        </main>
    </div>

<?php include('views/admin_footer.php') ?>
<?php include('views/admin_header.php') ?>

	<div class="container">
		<main class="page">

			<h2>Add New User</h2>

			<form action="" method="POST">

				<?php if($objData->error) echo '<div class="alert alert-danger"><strong>Error Input</strong><br>' . implode('<br>', $objData->msg) . '</div>'; ?>


				<div class="form-group <?php echo (in_array('usrEmail', $objData->errors)) ? 'has-error' : ''; ?>">
					<label for="usrEmail">Email:</label>
					<input type="email" name="usrEmail" id="usrEmail" class="form-control" value="<?php echo ($objData->error) ? $objData->input['usrEmail'] : ''; ?>">
				</div>

				<div class="form-group <?php echo (in_array('usrFirstName', $objData->errors)) ? 'has-error' : ''; ?>">
					<label for="usrFirstName">First Name:</label>
					<input type="text" name="usrFirstName" id="usrFirstName" class="form-control" value="<?php echo ($objData->error) ? $objData->input['usrFirstName'] : ''; ?>">
				</div>

				<div class="form-group <?php echo (in_array('usrLastName', $objData->errors)) ? 'has-error' : ''; ?>">
					<label for="usrLastName">Last Name:</label>
					<input type="text" name="usrLastName" id="usrLastName" class="form-control" value="<?php echo ($objData->error) ? $objData->input['usrLastName'] : ''; ?>">
				</div>

				<div class="form-group">
					<label for="usrWebsite">Website</label>
					<input type="text" name="usrWebsite" id="usrWebsite" class="form-control" value="<?php echo ($objData->error) ? $objData->input['usrWebsite'] : ''; ?>">
				</div>

				<div class="form-group <?php echo (in_array('usrPassword', $objData->errors)) ? 'has-error' : ''; ?>">
					<label for="usrPassword">Password:</label>
					<input type="password" name="usrPassword" id="usrPassword" class="form-control">
				</div>

				<div class="form-group <?php echo (in_array('usrPasswordRepeat', $objData->errors)) ? 'has-error' : ''; ?>">
					<label for="usrPasswordRepeat">Repeat password:</label>
					<input type="password" name="usrPasswordRepeat" id="usrPasswordRepeat" class="form-control">
				</div>

				<input type="submit" class="btn btn-primary" value="Add New User">

			</form>

		</main>
	</div>

<?php include('views/admin_footer.php') ?>
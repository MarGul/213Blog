<?php include('views/admin_header.php') ?>

	<div class="container">
		<main class="page">

			<h2>Add New User</h2>

			<form action="" method="POST">

				<div class="form-group">
					<label for="usrEmail">Email:</label>
					<input type="email" name="usrEmail" id="usrEmail" class="form-control">
				</div>

				<div class="form-group">
					<label for="usrFirstName">First Name:</label>
					<input type="text" name="usrFirstName" id="usrFirstName" class="form-control">
				</div>

				<div class="form-group">
					<label for="usrLastName">Last Name:</label>
					<input type="text" name="usrLastName" id="usrLastName" class="form-control">
				</div>

				<div class="form-group">
					<label for="usrWebsite">Website</label>
					<input type="text" name="usrWebsite" id="usrWebsite" class="form-control">
				</div>

				<div class="form-group">
					<label for="usrPassword">Password:</label>
					<input type="password" name="usrPassword" id="usrPassword" class="form-control">
				</div>

				<div class="form-group">
					<label for="usrPasswordRepeat">Repeat password:</label>
					<input type="password" name="usrPasswordRepeat" id="usrPasswordRepeat" class="form-control">
				</div>

				<input type="submit" class="btn btn-primary" value="Add New User">

			</form>

		</main>
	</div>

<?php include('views/admin_footer.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $objData->pageTitle; ?></title>

		<!-- Pull in Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="CSS/admin_styles.css">
		<!-- Pull in font awesome-->
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<!-- Pull in jQuery and Bootstrap JS -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>

	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><strong>m</strong>BLOG</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li <?php echo ($objData->activeLink == 'dash') ? 'class="active"' : ''; ?>>
						<a href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
					</li>
					<li <?php echo ($objData->activeLink == 'blog') ? 'class="active"' : ''; ?>>
						<a href="blog.php"><i class="fa fa-newspaper-o"></i> Blog</a>
					</li>
					<li <?php echo ($objData->activeLink == 'users') ? 'class="active"' : ''; ?>>
						<a href="users.php"><i class="fa fa-users"></i> Users</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
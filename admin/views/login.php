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

    </head>
    <body>
        <div class="container">
            <div class="page login-form">
                <form action="" method="POST">

                    <?php if($objData->error) { ?>
                        <div class="alert alert-danger"><strong>Invalid Credentials</strong><br>Not a valid email and password. Please try again.</div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <input type="submit" value="Login" class="btn btn-info full-width">

                </form>
            </div>
        </div>
    </body>
</html>
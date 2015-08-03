<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Header Start -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inventory Management System">
    <meta name="author" content="Shivam Agarwal">
    <title>Log in | IMS</title>
	<!-- Styling Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">	
	<link href="css/animate.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- Header End -->

<!-- Body Start -->
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="form1" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Login"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

    <!-- Functioning JS files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/main.js"></script>
	<script src="js/bootstrap-notify.min.js"></script>
	
	<!-- Notify JS -->
	<script>
$.notifyDefaults({
	type: "success",
	newest_on_top: true,
	placement: {
		from: "top",
		align: "center"
	},
	offset: 20,
	spacing: 10,
	z_index: 2031,
	delay: 10000
});
</script>

<!-- PHP Code -->
<?php
//Catch Submit Button
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
		?>
<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: "Username or Password can't be empty!"
},{
	type: 'warning'
});
</script>
<?php        
    } else {
        require 'includes/connection.php';
        $tbl_name = "users";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $password = sha1($password);
        $sql      = "SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
        $result   = mysqli_query($conn, $sql);
        $count    = mysqli_num_rows($result);
        if ($count == 1) {
			?>
<script>
$.notify({
	icon: 'glyphicon glyphicon-ok',
	message: 'Logging in..'
},{
	type: 'success'
});
</script>
<?php			
            $_SESSION['username'] = $username;
            header("location:profile.php");
        } else {
?>
<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: 'Wrong username or Password!'
},{
	type: 'danger'
});
</script>
<?php
        }
    }
}
//Detect Already logged in
if(isset($_SESSION['username']))
	header("location:profile.php");
?>
</div>
</body>
<!-- Body End -->
</html>
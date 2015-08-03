<?php
include('includes/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inventory Management System">
    <meta name="author" content="Shivam Agarwal">
    <title>Manage Users | IMS</title>
    <!-- Styling Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/dataTables.bootstrap.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-notify.min.js"></script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
</head>
<body>
<?php
//Position Check
if($position=="Administrator")
{$u=1;
include('includes/admin-functions.php');}
elseif($position=="Organization")
{$u=2;header('Location: support.php');}
elseif($position=="User")
{$u=3;header('Location: profile.php');}
else
{header('Location: main.php');}	
?>
<div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href=""><i>IMS</i></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Hola <?php echo $nickname; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="myp.php"><i class="fa fa-dashboard fa-fw"></i> My Products</a>
                        </li>
                        <li>
                            <a href="tools.php"><i class="fa fa-tasks fa-fw"></i> My Tools<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
								if($u==1){
								echo '<li><a href="tools.php#addproducts">Add Products</a></li>';
								}
								?>
                                <li>
                                    <a href="tools.php#viewproducts">View Products</a>
                                </li>
								<?php
								if($u==1){
								echo '<li><a href="tools.php#addorganisations">Add Organisations</a></li>';
								}
								?>
								<li>
                                    <a href="tools.php#vieworganisations">View Organisations</a>
                                </li>
								<?php
								if($u==1){
								echo '<li><a href="tools.php#allocate">Allocate Products</a></li>';
								echo '<li><a href="tools.php#deallocate">Deallocate Products</a></li>';
								}
								?>
								<li>
                                    <a href="tools.php#viewallocated">View Allocated Products</a>
                                </li>
                            </ul>
                        </li>
						<?php
						if($u==1)
						{
							?>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Advanced<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="musers.php">Manage Users</a>
                                </li>
                            </ul>
                        </li>
						<?php
						}
						?>
                        <li>
                            <a href="support.php"><i class="fa fa-life-ring fa-fw"></i>Support Center</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Users</h1>
                </div>
            </div>
			<div class="row">
			<div class="col-lg-4">
                    <div class="panel panel-primary tool-container">
					<div class="panel-heading">
                            <i class="fa fa-eye fa-fw"></i> View Users
                    </div>
					<div class="panel-body">					
			<div class="row">
                <div class="col-lg-10 col-lg-offset-1"><div class="row">
                    You can view Administrators, Organisations or Users. 
</div>
<div class="row text-center metho"> 
					<br>
					<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="viewu">View Users</button>
</div>
            </div>
					</div>
					</div>
					</div>
					</div>
                <div class="col-lg-4">
                    <div class="panel panel-primary tool-container">
					<div class="panel-heading">
                            <i class="fa fa-plus fa-fw"></i> Add Users
                    </div>
					<div class="panel-body">					
			<div class="row">
                <div class="col-lg-10 col-lg-offset-1"><div class="row">
                    You can add Administrators, Organisations or Users. 
</div>
<div class="row text-center metho"> 
					<br>
					<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="adduf">Add Users</button>
</div>
            </div>
					</div>
					</div>
					</div>
					</div>					
					<div class="col-lg-4">
                    <div class="panel panel-primary tool-container">
					<div class="panel-heading">
                            <i class="fa fa-minus fa-fw"></i> Delete Users
                    </div>
					<div class="panel-body">
					<div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="row">
                    You can remove Administrators, Organisations or Users. 
</div>
<div class="row text-center metho"> 
					<br>
					<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="deluf">Delete Users</button>
</div>
            </div>
					</div>
					</div>
					</div>
					</div>	
        </div>
		<div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="panel panel-info tool-container">
					<div class="panel-heading">
                            <i class="fa fa-bars fa-fw"></i> Result
                    </div>
					<div class="panel-body">
					<div class="adduf pbody" style="display:none;">
					<div class="col-lg-6">
				<form role="form" action="" method="post">
		<div class="form-group">
		<label>Choose User Position</label>
		<select class="form-control" name="pos" required>
		<option></option>
		<option value="admin">Administrator</option>
		<option value="org">Organisation</option>
		<option value="user">User</option>
		</select>
		</div>
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="addusf"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
</div>
</div>
<?php					
					//Delete Users pre-form
					echo '<div class="deluf pbody" style="display:none;">';
							echo '<div class="col-lg-8 col-lg-offset-3" >';
							formdelus($user_check);
							echo '</div>';
					echo '</div>';
					if (isset($_POST['delus'])) {
								$new=array();
								$new[]=(htmlentities($_POST['username']));
								$pass=htmlentities($_POST['password']);
								$new[]=sha1($pass);
								remdelu($new,$user_check);							
							}
					//View Users
					echo '<div class="viewu pbody" style="display:none;">';
	echo '<div class="row"><div class="col-lg-10 col-lg-offset-1">';
	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Position</th>';
		echo '<th>Name</th>';
		echo '<th>Username</th>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_assoc($result)) 
		{
			//Display Results
			echo '<tr>';
			echo "<td>".$row['position']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['username']."</td>";
			echo '</tr>';
		}
		echo '</tbody></table></div>';
	}
	else {
		echo "No results found.";
	}		
	echo '</div></div>';					
					echo '</div>';
					//Add Users form
					if (isset($_POST['addusf'])) {
							echo '<div class="adduss pbody">';
							echo '<div class="col-lg-8 col-lg-offset-3" >';
							$posa=(htmlentities($_POST['pos']));
							formaddu($posa);
							echo '</div>';
							echo '</div>';
						}
						//Add users function
if (isset($_POST['addus'])) {
								$new=array();
								$new[]=(htmlentities($_POST['name']));
								$new[]=(htmlentities($_POST['username']));
								$pass=htmlentities($_POST['password']);
								$new[]=sha1($pass);
								$posa=(htmlentities($_POST['pos']));
								if ($posa=='admin')
									$new[]="Administrator";
								elseif($posa=='org')
								$new[]="Organization";
								elseif($posa=='user')
								$new[]="User";
								$new[]=htmlentities($_POST['pos']);
								insaddu($new);							
							}							
					?>
					</div>
					</div>
					</div>
					</div>
		</div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- JS Files -->
	<script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('div.metho').each(function() {
            var $metho = $(this);
			var myp=$("button.btlink", $metho).attr("go");
            $("button.btlink", $metho).click(function(e) {
                e.preventDefault();
                $div = $("div." + myp);
                $div.toggle(300);
                $("div.pbody").not($div).hide();
                return false;
            });
        });
    });
	</script>
	<script>
    $(document).ready(function() {
        $('table.my-table').DataTable({
                responsive: true,
				"bLengthChange": false,
				"ordering": false,
				"info": false
        });
    });
    </script>
	</body>
</html>
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
    <title>My Tools | IMS</title>
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
{$u=1;}
elseif($position=="Organization")
{$u=2;header('Location: support.php');}
elseif($position=="User")
{$u=3;}
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
                    <h1 class="page-header">My Tools</h1>
                </div>
            </div>
			<?php
			if($u==1)
			{	
		?>		
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-shopping-cart fa-fw"></i> Product Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="addproducts" class="col-md-6 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="add1">Add Products</button>
							</div>
							<div id="viewproducts" class="col-md-6 text-center metho" go="view1">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view1">View Products</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-building-o fa-fw"></i> Organisation Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="addorganisations" class="col-md-6 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="add2">Add Organisation</button>
							</div>
							<div id="vieworganisations" class="col-md-6 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view2">View Organisations</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-exchange fa-fw"></i> Allocating Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="allocate" class="col-md-4 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="add3">Allocate</button>
							</div>
							<div id="deallocate" class="col-md-4 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="rem1">Deallocate</button>
							</div>
							<div id="viewalloacted" class="col-md-4 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view3">View Allocated</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>                
            </div>
			<?php
			}
			elseif ($u==3)
			{
				?>
			<div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-shopping-cart fa-fw"></i> Product Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="viewproducts" class="col-md-12 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view1">View Products</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-building-o fa-fw"></i> Organisation Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="vieworganisations" class="col-md-12 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view2">View Organistaions</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-exchange fa-fw"></i> Allocating Tools
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div id="viewalloacted" class="col-md-12 text-center metho">
							<button type="button" class="btn btn-outline btn-primary btn-lg btlink" go="view3">View Allocated</button>
							</div>
							</div>
                        </div>
                    </div>
                </div>                
            </div>
			<?php
			}
			?>
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="panel panel-info tool-container">
					<div class="panel-heading">
                            <i class="fa fa-bars fa-fw"></i> Result
                    </div>
					<div class="panel-body">
					<div class="none pbody">Choose an option from above.</div>
					<?php
					if($u==1)
					{
						include('includes/admin-functions.php');
						//Add Products
						echo '<div class="add1 pbody" style="display:none;">';
						formproducts();
						if (isset($_POST['products'])) {
							$new=array();
							$new[]=(htmlentities($_POST['pcode']));
							$new[]=(htmlentities($_POST['desc']));
							$new[]=(htmlentities($_POST['price']));
							$dop = str_replace('/','-',$_POST['dop']);
							$war=(htmlentities($_POST['warranty']));
							$dop = date("d-m-Y",strtotime($dop));
							$doe = date("d-m-Y", strtotime("$dop+$war years"));
							$new[]=(htmlentities($dop));
							$new[]=(htmlentities($doe));
							$new[]=(htmlentities($_POST['scode']));
							$new[]=(htmlentities($_POST['mcode']));
							$new[]=(htmlentities($_POST['quantity']));
							$maxp=(htmlentities($_POST['quantity']));
							$denter = new DateTime($_POST['dop']);
							$today = new DateTime();
							if($denter > $today)
							{
								?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Please enter a valid date!"
},{
	type: 'warning'
});
</script>
		<?php
							}
							else
							{
								insertproducts($new);
							}
						}
						echo '</div>';						
						//Add Organisations
						echo '<div class="add2 pbody" style="display:none;">';
						formorg();
						if (isset($_POST['org'])) {
							$new=array();
							$new[]=(htmlentities($_POST['agency']));
							$new[]=(htmlentities($_POST['address']));
							$new[]=(htmlentities($_POST['contact']));
							$new[]=(htmlentities($_POST['type']));
							insertorg($new);
						}
						echo '</div>';
						//Allocate
						echo '<div class="add3 pbody" style="display:none;">';
						formalloc();
						if (isset($_POST['alloc'])) {
							$new=array();
							$new[]=(htmlentities($_POST['pno']));
							$new[]=(htmlentities($_POST['pcode']));
							$new[]=(htmlentities($_POST['user']));
							insertalloc($new);
						}
						echo '</div>';
						//Deallocate
						echo '<div class="rem1 pbody" style="display:none;">';
						formdealloc();
						if (isset($_POST['dealloc'])) {
							$new=(htmlentities($_POST['id']));
							deletealloc($new);
						}
						echo '</div>';
					}
					if($u==1||$u==3)
					{
						include('includes/user-functions.php');
						//View Products
						echo '<div class="view1 pbody" style="display:none;">';
						viewproducts();
						echo '</div>';
						//View Organisations
						echo '<div class="view2 pbody" style="display:none;">';
						vieworg();
						echo '</div>';
						//View Allocated
						echo '<div class="view3 pbody" style="display:none;">';
						viewalloc();
						echo '</div>';
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
			var myp=$(".btlink", $metho).attr("go");
            $(".btlink", $metho).click(function(e) {
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
	$(document).ready(function() {
        $('#my-table-order').DataTable({
                responsive: true,
				"bLengthChange": false,
				"ordering": true,
				"info": false
        });
    });
    </script>
	</body>
</html>
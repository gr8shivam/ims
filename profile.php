<?php
include('includes/session.php');
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
    <title>Dashboard | IMS</title>
    <!-- Styling Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
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
<?php
//Position Check
if($position=="Administrator")
{$u=1;}
elseif($position=="Organization")
{$u=2;header('Location: support.php');}
elseif($position=="User")
{$u=3;}
else
{header('Location: logout.php');}	
?>
<div id="wrapper">
        <!-- Navigation -->
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
                    <h1 class="page-header">Dashboard</h1>
                </div>
            </div>
			<?php
			if($u==1){
				?>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select COALESCE(SUM(quantity),0) AS total from products";
									$result=mysqli_query($conn,$sql);
									if (mysqli_num_rows($result) > 0)
										{
											$row = mysqli_fetch_assoc($result);
											echo $row['total'];
										}
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Total Products</div>
                                </div>
                            </div>
                        </div>
                        <a href="tools.php#viewproducts">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exchange fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select COALESCE(SUM(allocated),0) AS total from products";
									$result=mysqli_query($conn,$sql);
									if (mysqli_num_rows($result) > 0)
										{
											$row = mysqli_fetch_assoc($result);
											echo $row['total'];
										}
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Allocated Products</div>
                                </div>
                            </div>
                        </div>
                        <a href="tools.php#allocate">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-building-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select * from organizations";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Organisations</div>
                                </div>
                            </div>
                        </div>
                        <a href="tools.php#vieworganisations">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select * from users";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="musers.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
			<?php
			}
			?>
			<?php
			if($u==1){
				?>
			<br>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-life-ring fa-fw"></i> Support Requests
                        </div>
                        <div class="panel-body">
                            <?php
	$sqla="select * from complaints";
	$resulta=mysqli_query($conn,$sqla);
	if (mysqli_num_rows($resulta) > 0) {				
	?>
	<div id="admin-support-req"></div>
	<?php
	}
	else
	{echo 'No complaints found!';}
	?>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			}
			?>
			<?php
			if($u==3){
				?>
				<div class="row">
                <div class="col-lg-4 col-lg-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select * from allocated WHERE user='$user_check'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Total Products</div>
                                </div>
                            </div>
                        </div>
                        <a href="myp.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-life-ring fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql="select * from complaints WHERE user='$user_check'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									mysqli_free_result($result);
									?>
									</div>
                                    <div>Complaints</div>
                                </div>
                            </div>
                        </div>
                        <a href="support.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
			<br>
			
				<?php
			}
			?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- JS Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/main.js"></script>
	<script src="js/bootstrap-notify.min.js"></script>

	<?php
	$sqla="select * from complaints";
	$resulta=mysqli_query($conn,$sqla);
	if (mysqli_num_rows($resulta) > 0) {				
	?>
	<script>
						$(function() {

    Morris.Line({
        element: 'admin-support-req',
		data:[<?php
	$dates=array();
	$comp=array();
	$sql="select doc,count(*) AS total from complaints GROUP BY doc";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {						
						while($row = mysqli_fetch_assoc($result))
				{
					$docg = date("Y-m-d",strtotime($row['doc']));
					$dates[]=$docg;
					$comp[]=$row['total'];
				}
					}
					$first=$dates[0];
					$last=date("Y-m-d");
	while (strtotime($first) <= strtotime($last)) {
		if (in_array("$first", $dates))
  {
	  $index=array_search("$first",$dates);
	  ?>{
            date: '<?php echo $dates[$index]; ?>',
            complaints: '<?php echo $comp[$index]; ?>'
        },<?php
  
  }
else
  {
  ?>{
            date: '<?php echo $first; ?>',
            complaints: '0'
        },<?php
  }
 $first = date ("Y-m-d", strtotime("+1 day", strtotime($first)));
 }
 ?>],
 xkey: 'date',
ykeys: ['complaints'],
labels: ['Complaints'],
xLabels:'day',
pointSize: 2,
hideHover: 'auto',
resize: true,
yLabelFormat: function(y){return y != Math.round(y)?'':y;},
xLabelFormat: function (x) {
                  var IndexToMonth = [ "Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez" ];
                  var month = IndexToMonth[ x.getMonth() ];
                  var year = x.getFullYear();
				  var date = x.getDate();
                  return date + ' ' + month + ' ' + year;
              },
          dateFormat: function (x) {
                  var IndexToMonth = [ "Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez" ];
                  var month = IndexToMonth[ new Date(x).getMonth() ];
                  var year = new Date(x).getFullYear();
				  var date = new Date(x).getDate();
                  return date + ' ' + month + ' ' + year;
              },
    });
});
</script>
<?php
	}
	?>
</body>
</html>
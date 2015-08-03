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
    <title>Support Center | IMS</title>
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
{$u=2;}
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
                    <h1 class="page-header">Support Center</h1>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4 col-md-6 col-lg-offset-1">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- Display no. of Tickets -->
									<div class="huge">
									<?php
									if($u==1){
									$sql="select * from complaints WHERE status<>'closed'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
									elseif($u==2)
									{
										$sql="select * from complaints WHERE status<>'closed' AND org='$nickname'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
									elseif($u==3)
									{
										$sql="select * from complaints WHERE status<>'closed' AND user='$user_check'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
										
									?>
									</div>
                                    <div>Active Complaints</div>
                                </div>
                            </div>
                        </div>
						<div class="metho">
                        <a href="#" class="btlink" go="actt">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
						</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-lg-offset-1">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									if($u==1)
									{
									$sql="select * from complaints";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
									elseif($u==2)
									{
										$sql="select * from complaints WHERE org='$nickname'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
									elseif($u==3)
									{
										$sql="select * from complaints WHERE user='$user_check'";
									$result=mysqli_query($conn,$sql);
									echo mysqli_num_rows($result);
									}
									?>
									</div>
                                    <div>Total Complaints</div>
                                </div>
                            </div>
                        </div>
						<div class="metho">
                        <a href="#" class="btlink" go="allt">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
						</div>
                    </div>
                </div>
            </div>
			<?php
			if($u!=2)
			{
				?>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="panel panel-danger tool-container">
					<div class="panel-heading">
                            <i class="fa fa-cog fa-fw"></i> Actions
                    </div>
					<div class="panel-body">
					<div class="row">
							<div class="col-md-12 text-center metho">
							<button type="button" class="btn btn-outline btn-danger btn-lg btlink" go="addt">Add Complaint</button>
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
					
			<div class="row">
                <div class="col-lg-12">
                    <?php
					if($u==1)
					{
						//View Active Tickets
						echo '<div class="actt pbody" style="display:none;">';
						$sql="select * from complaints WHERE status<>'closed'";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of Complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>User</th>';
		echo '<th>Organisation</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['user'].'</td>';
					echo '<td>'.$row['org'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				?>
				<br>
				<div class="col-lg-6">
				<form role="form" action="" method="post">
		<div class="form-group">
		<label>Enter Comp No to close</label>
		<?php
	//Fetch Complaints
	$sql = "SELECT * FROM complaints WHERE status<>'closed'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="cno" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['cno'].">".$row['cno']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Active complaints.</option></select>';
	}
	mysqli_free_result($result);	
	?>
		</div>
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="closet"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
</div>		
<?php		
				}				
				else
				{
					echo "No Active Tickets!";
				}
				
				echo '</div>';
				
				//View Total Tickets
						echo '<div class="allt pbody" style="display:none;">';
						$sql="select * from complaints";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>User</th>';
		echo '<th>Organisation</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['user'].'</td>';
					echo '<td>'.$row['org'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				}				
				else
				{
					echo "No tickets found.";
				}
				
				echo '</div>';
					}
					elseif($u==2)
					{
						//Organisations!!
						//View Active Tickets
						echo '<div class="actt pbody" style="display:none;">';
						$sql="select * from complaints WHERE status<>'closed' AND org='$nickname'";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of Complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>User</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['user'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				?>
				<br>
				<div class="col-lg-6">
				<form role="form" action="" method="post">
		<div class="form-group">
		<label>Enter Comp No to close</label>
		<?php
	//Fetch Complaints
	$sql = "SELECT * FROM complaints WHERE status<>'closed' AND org='$nickname'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="cno" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['cno'].">".$row['cno']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Active complaints.</option></select>';
	}
	mysqli_free_result($result);	
	?>
		</div>
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="closet"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
</div>		
<?php		
				}				
				else
				{
					echo "No Active Tickets!";
				}
				
				echo '</div>';
				
				//View Total Tickets
						echo '<div class="allt pbody" style="display:none;">';
						$sql="select * from complaints WHERE org='$nickname'";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>User</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['user'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				}				
				else
				{
					echo "No tickets found.";
				}
				
				echo '</div>';
					}
					elseif($u==3)
					{
						//View Active Tickets
						echo '<div class="actt pbody" style="display:none;">';
						$sql="select * from complaints WHERE status<>'closed' AND user='$user_check'";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>Organisation</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['org'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				}				
				else
				{
					echo "No Active Tickets!";
				}
				
				echo '</div>';
				//View Total Tickets
						echo '<div class="allt pbody" style="display:none;">';
						$sql="select * from complaints WHERE user='$user_check'";
					$result=mysqli_query($conn,$sql);
					if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Comp. No</th>';
		echo '<th>Date of complaint</th>';
		echo '<th>Product Code</th>';
		echo '<th>Product No</th>';
		echo '<th>Organisation</th>';
		echo '<th>Complaint</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
	
					while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>';
					echo '<td>'.$row['cno'].'</td>';
					echo '<td>'.$row['doc'].'</td>';
					echo '<td>'.$row['pcode'].'</td>';
					echo '<td>'.$row['pno'].'</td>';
					echo '<td>'.$row['org'].'</td>';
					echo '<td>'.$row['comp'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '</tr>';
				
				}
				echo '</tbody></table></div>';
				}				
				else
				{
					echo "No tickets found.";
				}
				
				echo '</div>';
					}
					if($u==1||$u==3)
					{
						
				//Add Ticket
						echo '<div class="addt pbody" style="display:none;">';
						?>
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<form role="form" action="" method="post">
	<div class="form-group">
	<label>Product Code</label>
	<?php
	//Fetch product codes
	$sql = "SELECT pcode,pno FROM allocated WHERE user='$user_check'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="pcode"><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['pcode'].">".$row['pcode']."</option>";
		}
		echo '</select>';
		mysqli_free_result($result);		
	}
	else {
		echo '<select class="form-control"><option></option><option>No Products Found.</option></select>';
	}
	
	?>
	</div>
	<div class="form-group">
	<label>Product No</label>
	<?php
	//Fetch product codes
	$sql = "SELECT pcode,pno FROM allocated WHERE user='$user_check'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {				
		echo '<select class="form-control" name="pno"><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['pno'].">".$row['pno']."</option>";
		}
		echo '</select>';
		mysqli_free_result($result);
	}
	else {
		echo '<select class="form-control"><option></option><option>No Products Found.</option></select>';
	}
	
	?>
	</div>
	<div class="form-group">
	<label>Complaint</label>
	<input class="form-control" type="textarea" name="complaint" required>
	</div>
	<button type="submit" class="btn btn-success btn-circle btn-lg" name="comp"><i class="fa fa-check"></i></button>
	<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
	</form>
	</div>
	</div>
<?php				
				if (isset($_POST['comp'])) {
							$new=array();
							$doc = date("d-m-Y");
							$doc = date("d-m-Y",strtotime($doc));
							$new[]=(htmlentities($doc));
							$new[]=(htmlentities($_POST['pcode']));
							$new[]=(htmlentities($_POST['pno']));
							$new[]=(htmlentities($user_check));
							//Fetch responsible organisation
							$pcode=$_POST['pcode'];
							$sql = "SELECT doe,scode,mcode FROM products WHERE pcode='$pcode'";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									$doe=$row['doe'];
									$doe = new DateTime($row['doe']);
									$today = new DateTime();
									if($today>$doe)
									{
										//Fetch Name of AMC Organization
			$m=$row['mcode'];
			$sql2 = "SELECT agency FROM organizations WHERE ocode=$m";
			$result2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_assoc($result2)) {$amc=$row2['agency'];}
			mysqli_free_result($result2);
										$new[]=$amc;
									}
									else
									{
										//Fetch Name of Seller Organization
										$s=$row['scode'];
										$sql2 = "SELECT agency FROM organizations WHERE ocode=$s";
			$result2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_assoc($result2)) {$seller=$row2['agency'];}
			mysqli_free_result($result2);
			$new[]=$seller;
										//echo "In warranty";
									}
									$new[]=(htmlentities($_POST['complaint']));
									$new[]="open";
//Function to Insert New Complaint

		$sql = "INSERT INTO complaints VALUES (NULL,'$new[0]','$new[1]',$new[2],'$new[3]','$new[4]','$new[5]','$new[6]')";
		if (mysqli_query($conn, $sql)) {
			//echo "<div id='alert'>New record created successfully</div>";
			?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-ok',
	message: " Successfully Added!"
},{
	type: 'success'
});
</script>
		<?php			
		}
		else {
			//echo "<div id='alert'>Error: " . $sql . "<br>" . mysqli_error($conn)."</div>";
			?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Error! Please check your values."
},{
	type: 'danger'
});
</script>
<?php
		}	

									
									}
		mysqli_free_result($result);
	}
	else {
		echo 'Error checking warranty information!';
	}
						}
				echo '</div>';
					}
					if($u==1||$u==2)
					{
						if (isset($_POST['closet'])){
					$clid=(htmlentities($_POST['cno']));
					$sql = "UPDATE complaints SET status='closed' WHERE cno=$clid AND status='open'";
					if (mysqli_query($conn, $sql)) {
						//Successfully
						?>
		<script>
			$.notify({
				icon: 'glyphicon glyphicon-ok',
				message: " Closed successfully."
			},{
				type: 'success'
			});
		</script>
		<?php
					}
					else
					{
						//Error
						?>
		<script>
			$.notify({
				icon: 'glyphicon glyphicon-warning-sign',
				message: " Error! Please check your values."
			},{
				type: 'danger'
			});
		</script>
		<?php
					}
				}
					}
					?>
                <!-- /.col-lg-12 -->
            </div>
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
    </script>
	</body>
</html>
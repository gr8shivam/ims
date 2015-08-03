<?php
//#1: Function to display products
function viewproducts(){
	require 'connection.php';
	echo '<div class="row"><div class="col-lg-10 col-lg-offset-1">';
	$sql = "SELECT * FROM products";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Product Code</th>';
		echo '<th>Description</th>';
		echo '<th>Price</th>';
		echo '<th>Date of Purchase</th>';
		echo '<th>Warranty expiry</th>';
		echo '<th>Seller</th>';
		echo '<th>Maintenance Agency</th>';
		echo '<th>Quantity</th>';
		echo '<th>Allocated</th>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_assoc($result)) 
		{
			//Fetch Names of Organizations
			$s=$row['scode'];$m=$row['mcode'];
			$sql2 = "SELECT agency FROM organizations WHERE ocode=$s";
			$result2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_assoc($result2)) {$seller=$row2['agency'];}
			mysqli_free_result($result2);
			$sql2 = "SELECT agency FROM organizations WHERE ocode=$m";
			$result2 = mysqli_query($conn, $sql2);
			while($row2 = mysqli_fetch_assoc($result2)) {$amc=$row2['agency'];}
			mysqli_free_result($result2);
			//Display Results
			
			echo '<tr>';
			echo "<td>".$row['pcode']."</td>";
			echo "<td>".$row['desc']."</td>";
			echo "<td>".$row['price']."</td>";
			echo "<td>".$row['dop']."</td>";
			echo "<td>".$row['doe']."</td>";
			echo "<td>".$seller."</td>";
			echo "<td>".$amc."</td>";
			echo "<td>".$row['quantity']."</td>";
			echo "<td>".$row['allocated']."</td>";
			echo '</tr>';
		}
		echo '</tbody></table></div>';
	}
	else {
		echo "No results found.";
	}	
	echo '</div></div>';
}
//#2: Function to display organisations
function vieworg(){
	require 'connection.php';
	echo '<div class="row"><div class="col-lg-10 col-lg-offset-1">';
	$sql = "SELECT * FROM organizations";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo "<thead><tr>";
		echo '<th>Organisation Code</th>';
		echo '<th>Name</th>';
		echo '<th>Address</th>';
		echo '<th>Contact</th>';
		echo '<th>Type</th>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_assoc($result)) 
		{
			//Display Results
			echo '<tr>';
			echo "<td>".$row['ocode']."</td>";
			echo "<td>".$row['agency']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td>".$row['contact']."</td>";
			echo "<td>".$row['type']."</td>";
			echo '</tr>';
		}
		echo '</tbody></table></div>';
	}
	else {
		echo "No results found.";
	}		
	echo '</div></div>';
}

//#3: Function to display allocated products
function viewalloc(){
	require 'connection.php';
	echo '<div class="row"><div class="col-lg-10 col-lg-offset-1">';
	$sql = "SELECT * FROM allocated ORDER BY pcode ASC,pno ASC";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover" id="my-table-order">';
		echo "<thead><tr>";
		echo '<th rowspan="2">Product Code</th>';
		echo '<th rowspan="2">Product No</th>';
		echo '<th align="center" colspan="2">User</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>Username</th>';
		echo '<th>Name</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_assoc($result)) 
		{
			//Display Results
			echo '<tr>';
			echo "<td>".$row['pcode']."</td>";
			echo "<td>".$row['pno']."</td>";
			$user=$row['user'];
			$sql2 = "SELECT name FROM users WHERE username='$user'";
			$result2 = mysqli_query($conn, $sql2);
			if (mysqli_num_rows($result2) > 0)
			{
				while($row2 = mysqli_fetch_assoc($result2))
				{
					echo "<td>".$user."</td>";
					echo "<td>".$row2['name']."</td>";
				}				
			}
			echo '</tr>';
		}
		echo '</tbody></table></div>';
	}
	else {
		echo "No results found.";
	}		
	echo '</div></div>';
}
?>
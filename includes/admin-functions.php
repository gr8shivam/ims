<?php
//#1: Function to add products
function formproducts(){
	require 'connection.php';
	?>
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<form role="form" action="" method="post">
	<div class="form-group">
	<label>Product Code</label>
	<input class="form-control" type="text" name="pcode" required>
	</div>
	<div class="form-group">
	<label>Description</label>
	<input class="form-control" type="text" name="desc" required>
	</div>
	<div class="form-group">
	<label>Price</label>
	<input class="form-control" type="text" name="price" required>
	</div>
	<div class="form-group">
	<label>Date of Purchase</label>
	<input class="form-control" type="date" name="dop" required>
	</div>
	<div class="form-group">
	<label>Seller</label>
	<?php
	//Fetch Sellers
	$sql = "SELECT * FROM organizations WHERE type='seller'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="scode" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['ocode'].">".$row['agency']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Seller Found.</option></select>';
	}
	mysqli_free_result($result);
	?>	
	</div>
	<div class="form-group">
	<label>Maintenance Agency</label>
	<?php
	//Fetch AMC agencies
	$sql = "SELECT * FROM organizations WHERE type='amc'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="mcode" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['ocode'].">".$row['agency']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Maintenance Company Found.</option></select>';
	}
	mysqli_free_result($result);
	?>
	</div>
	<div class="form-group">
	<label>Quantity</label>
	<input class="form-control" type="number" name="quantity" required>
	</div>
	
	<div class="form-group">
	<label>Warranty (in years)</label>
	<input class="form-control" type="number" name="warranty" required>
	</div>
	<button type="submit" class="btn btn-success btn-circle btn-lg" name="products"><i class="fa fa-check"></i></button>
	<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
</form>
</div>
</div>
<?php
}

//#2: Function to Insert New Products (Fetches info from #1)
function insertproducts($new){
	require 'connection.php';
	$sql = "SELECT * FROM products WHERE pcode='$new[0]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Product Code already exists!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else
	{
	$sql = "INSERT INTO products VALUES ('$new[0]','$new[1]',$new[2],'$new[3]','$new[4]','$new[5]','$new[6]',$new[7],0)";
	if (mysqli_query($conn, $sql)) {
		//echo "<div id='alert'>New record created successfully</div>";
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-ok',
	message: "Successfully Added!"
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
	message: "Error! Please check your values."
},{
	type: 'danger'
});
</script>
<?php
	}
	}
}

//#3: Function to display form to add organizations
function formorg(){
	require 'connection.php';
	?>
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<form role="form" action="" method="post">
	<div class="form-group">
	<label>Company name</label>
	<input class="form-control" type="text" name="agency" required>
	</div>
	<div class="form-group">
	<label>Address</label>
	<input class="form-control" type="text" name="address" required>
	</div>
	<div class="form-group">
	<label>Contact No</label>
	<input class="form-control" type="tel" name="contact" required>
	</div>
	<div class="form-group">
	<label>Type</label>
	<select class="form-control" name="type" required>
	<option></option>
	<option value="seller">Seller</option>
	<option value="amc">Maintenance Agency</option>
	</select>
	</div>
	<button type="submit" class="btn btn-success btn-circle btn-lg" name="org"><i class="fa fa-check"></i></button>
	<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
	</form>
	</div>
	</div>
<?php
}

//#4: Function to Insert New Organization (Fetches info from #3)
function insertorg($new){
	require 'connection.php';
	$sql = "SELECT * FROM organizations WHERE agency='$new[0]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Already exists!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else{
		$sql = "INSERT INTO organizations VALUES (NULL,'$new[0]','$new[1]','$new[2]','$new[3]')";
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
}

//#5: Function to display form for allocate products
function formalloc(){
	require 'connection.php';
	?>
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<form role="form" action="" method="post">
	<div class="form-group">
	<label>Product No:</label>
	<input class="form-control" type="number" name="pno" required>
	</div>
	<div class="form-group">
	<label>Product Code:</label>
	<?php
	//Fetch product codes
	$sql = "SELECT pcode FROM products";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="pcode" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['pcode'].">".$row['pcode']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Products Found.</option></select>';
	}
	mysqli_free_result($result);
	?>
	</div>
	<div class="form-group">
	<label>User:</label>
	<?php
	//Fetch users
	$sql = "SELECT name,username FROM users";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="user" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['username'].">".$row['name']." / ".$row['username']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Users Found.</option></select>';
	}
	mysqli_free_result($result);
	?>
	</div>
	<button type="submit" class="btn btn-success btn-circle btn-lg" name="alloc"><i class="fa fa-check"></i></button>
	<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
	</form>
	</div>
	</div>
<?php
}

//#6: Function to Allocate Products (Fetches info from #5)
function insertalloc($new){
	require 'connection.php';
	$sql = "SELECT quantity,allocated FROM products WHERE pcode='$new[1]'";
	$result = mysqli_query($conn, $sql);
	$err=0;
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result)) {
			  if($row['quantity']==$row['allocated'])
				  $err=1;
			  else if($row['quantity']<$new[0])
				  $err=2;
			  
		}
	}
	else
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " No such Product Code found!"
},{
	type: 'danger'
});
</script>
		<?php
	}
	if($err==1)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " All products for this Product Code have been allocated!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else if($err==2)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Product number needs to be lesser than total quantity!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else {
	$sql = "SELECT * FROM allocated WHERE pcode='$new[1]' and pno=$new[0]";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Already allocated!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else{
		$sql = "INSERT INTO allocated VALUES (NULL,$new[0],'$new[1]','$new[2]')";
		if (mysqli_query($conn, $sql)) {
			//echo "<div id='alert'>New record created successfully</div>";
			$sql2="UPDATE products SET allocated=allocated+1 WHERE pcode='$new[1]'";
			if (mysqli_query($conn, $sql2)) {	
			?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Successfully Allocated!"
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
	}	
}

//#7: Function to Display Form for Deallocate products
function formdealloc(){
	require 'connection.php';
	$sql = "SELECT * FROM allocated";
	$result = mysqli_query($conn, $sql);
	echo '<div class="row"><div class="col-lg-6 col-lg-offset-3">';
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="dataTable_wrapper"><table class="table table-striped table-bordered table-hover my-table">';
		echo '<thead><tr><th>ID</th><th>Product Code</th><th>Product No</th><th>User</th></tr></thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<tr><td>".$row['ID']."</td><td>".$row['pcode']."</td><td>".$row['pno']."</td><td>".$row['user']."</td></tr>";
		}
		?>
		</tbody></table></div>
		</br>
		<form role="form" action="" method="post">
		<div class="form-group">
		<label>Enter ID to deallocate</label>
		<input class="form-control" type="number" name="id" required>
		</div>
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="dealloc"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>		
		<?php
	}
	else {
		echo 'No Allocated products!';
	}
	echo '</div></div>';
	mysqli_free_result($result);
}

//#8: Function to Deallocate Products (Fetches info from #7)
function deletealloc($new){
	require 'connection.php';
	$sql = "SELECT * FROM allocated WHERE id=$new";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		$sql2 = "DELETE FROM allocated WHERE id=$new";
		if (mysqli_query($conn, $sql2)) {
			$sql3="SELECT pcode from allocated WHERE id=$new";
			$result2=mysqli_query($conn, $sql3);
			if (mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_assoc($result)) {
					$pco=$row['pcode'];
				}
				$sql4="UPDATE products SET allocated=allocated-1 WHERE pcode='$pco'";
				if (mysqli_query($conn, $sql4)) {
					$err=0;
				}
				else $err=1;
			}
			else $err=1;		
		}
		else $err=1;
	}
	else $err=2;
	if($err==0)
	{
		?>
		<script>
			$.notify({
				icon: 'glyphicon glyphicon-ok',
				message: " Deallocated successfully."
			},{
				type: 'success'
			});
		</script>
		<?php

	}
	elseif($err==1)
	{
		?>
		<script>
			$.notify({
				icon: 'glyphicon glyphicon-frown-o',
				message: " Internal server error."
			},{
				type: 'danger'
			});
		</script>
		<?php
	}
	else
	{
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

//#9: Function to Add Users
function formaddu($posaddu){
	require 'connection.php';
if ($posaddu=="admin"||$posaddu=="user")
{
?>
<div class="col-lg-6">

				<form role="form" action="" method="post">
		<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" required>
		</div>
		<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" required>
		</div>
		<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password" required>
		</div>
		<input type="hidden" name="pos" value="<?php echo $posaddu; ?>">
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="addus"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
</div>
<?php
}
elseif($posaddu=="org")
{
	?>
<div class="col-lg-6">

				<form role="form" action="" method="post">
<div class="form-group">
	<label>Organisation Name</label>
	<?php
	//Fetch Organizations
	$sql = "SELECT agency FROM organizations";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="name" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['agency'].">".$row['agency']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No Organisation Found.</option></select>';
	}
	mysqli_free_result($result);
	?>	
	</div>
	<div class="form-group">
					<p class="form-control-static"><i><b>Note:</b></i> Organisations should be already registered. You can register organisations <a href="
http://localhost/sail/tools.php#addorganisations">here</a>.</p>
</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" required>
		</div>
		<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password" required>
		</div>
		<input type="hidden" name="pos" value="<?php echo $posaddu; ?>">
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="addus"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
		
</div>
<?php
}
else
{
	echo 'Please select a valid position.';
}
}

//#10: Addition of users
function insaddu($new)
{
	require 'connection.php';
	$sql = "SELECT * FROM users WHERE username='$new[1]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: " Username already exists!"
},{
	type: 'warning'
});
</script>
		<?php
	}
	else
	{
	$sql = "INSERT INTO users VALUES ('$new[0]','$new[1]','$new[2]','$new[3]')";
	if (mysqli_query($conn, $sql)) {
		//echo "<div id='alert'>New record created successfully</div>";
		?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-ok',
	message: "Successfully Added!"
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
	message: "Error! Please check your values."
},{
	type: 'danger'
});
</script>
<?php
	}
	}
}

//#11: Delete Users
function formdelus($myus){
	require 'connection.php';
	?>
	<div class="col-lg-6">
				<form role="form" action="" method="post">
<div class="form-group">
	<label>Choose User to Delete</label>
	<?php
	//Fetch Users
	$sql = "SELECT * FROM users WHERE username<>'$myus'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo '<select class="form-control" name="username" required><option></option>';
		while($row = mysqli_fetch_assoc($result)) {
			  echo "<option value=".$row['username'].">".$row['name']." / ".$row['username']." / ".$row['position']."</option>";
		}
		echo '</select>';
	}
	else {
		echo '<select class="form-control" required><option></option><option>No User Found.</option></select>';
	}
	mysqli_free_result($result);	
	?>
		</div>
		<div class="form-group">
	<label>Enter YOUR password</label>
	<input type="password" class="form-control" name="password" required>
		</div>
		<button type="submit" class="btn btn-success btn-circle btn-lg" name="delus"><i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i></button>
		</form>	
</div>
	<?php
}

//#12: Deletion of users
function remdelu($new,$myus)
{
	require 'connection.php';
	$sql = "SELECT * FROM users WHERE username='$new[0]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		$sql2 = "SELECT password FROM users WHERE username='$myus'";
		$result2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_assoc($result2);
		if($new[1]==$row2['password'])
		{
			$sql3 = "DELETE FROM users WHERE username='$new[0]'";
			if (mysqli_query($conn, $sql3))
			{
				$err=0;
			}
			else
			{$err=3;//Error deleting
		}
		}
		else{
			$err=2;//Password mismatch
		}
	
	}
	else
	{$err=1;//No such username found
	}
if($err==0)
{
	?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-ok',
	message: "Deleted Successfully."
},{
	type: 'success'
});
</script>
<?php
}
elseif($err==1)
{
	?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: "Error! No such username found."
},{
	type: 'warning'
});
</script>
<?php
}
elseif($err==2)
{
	?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: "Password doesn't match!."
},{
	type: 'danger'
});
</script>
<?php
}
else
{
	?>
		<script>
$.notify({
	icon: 'glyphicon glyphicon-warning-sign',
	message: "Error! Please check your values."
},{
	type: 'danger'
});
</script>
<?php
}
	
	}
?>

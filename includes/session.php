<?php
session_start();
require 'connection.php';
$user_check=$_SESSION['username'];
$sql="select username,name,position from users where username='$user_check'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$login_session =$row['username'];
$nickname=$row['name'];
$position=$row['position'];
if(!isset($login_session)){
header('Location: main.php');
}
?>
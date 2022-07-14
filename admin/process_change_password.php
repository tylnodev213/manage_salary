<?php 
$new_password= $_POST["new_password"] ?? '';
include 'conn.php';
$sql="UPDATE admin SET password='$new_password' where username='admin'";
mysqli_query($connect,$sql);
include 'dis-conn.php';
header('Location: index.php');
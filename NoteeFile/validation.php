<?php

session_start();

$con = mysqli_connect('localhost', 'root', "");

mysqli_select_db($con, 'userregistration');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = " select * from usertable where name = '$name' && password = '$pass'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	$result = mysqli_fetch_assoc($result);
	$_SESSION['username'] = $name;
	$_SESSION["user_id"] = $result["id"];
	header('location:room.php');
}else{
	header('location:wrongpassword.php');
}

?>
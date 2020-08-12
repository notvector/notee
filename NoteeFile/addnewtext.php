<?php

session_start();
header('location:home.php');

$con = mysqli_connect('localhost', 'root', "");

mysqli_select_db($con, 'userregistration');

$text = $_POST['textToStore'];


$txt=" insert into storedtext(text) values ('$text')";
mysqli_query($con, $txt);
header('location:home.php');


?>



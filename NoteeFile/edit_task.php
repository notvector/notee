<?php
session_start();
// add validation redirect here

if(empty($_GET["task-id"]) || !(isset($_GET["task-id"]))  ){
	header('Location: room.php');
	die;
}

require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" ) {

	
	// validate fields
	if(empty($_POST["task_name"]) || !(isset($_POST["task_name"]))){
		header('Location: '.$_SERVER['PHP_SELF']."?task-id=".$_GET["task-id"]);
		die;
	}
	if(empty($_POST["task_text"]) || !(isset($_POST["task_text"]))){
		header('Location: '.$_SERVER['PHP_SELF']."?task-id=".$_GET["task-id"]);
		die;
	}

	$s = "UPDATE tasks SET name='".$_POST["task_name"]."', task_text='".$_POST["task_text"]."' WHERE username = '".$_SESSION['username']."' AND id=".$_GET["task-id"];
	$result = mysqli_query($con, $s);

	header('Location: room.php');
	die;
}

$s = "SELECT * FROM tasks WHERE username = '".$_SESSION['username']."' AND id=".$_GET["task-id"];
$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num < 1){
	header("Location: room.php");
	die;
}

$task = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
	<title>App</title>
	<title>App</title>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="cust.css" />
</head>
<body>
	<br/>

	<div class="card">
	  <div class="card-body">
	  	<h5 class="card-title" style="text-align: center;"><?=strtoupper($task['name']);?></h5>
	    <form  method="POST">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Title</label>
		    <input type="text" name="task_name" value="<?=$task['name']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Text</label>
		    <textarea name="task_text" class="form-control" id="exampleFormControlTextarea1" rows="20"><?=$task['task_text']?></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Save</button>
		  <input type="button" class="btn btn-outline-primary" onclick="window.location.href='room.php'" value="Cancel" />
		</form>



	  </div>
	</div>

</body>
</html>
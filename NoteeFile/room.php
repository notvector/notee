<?php
	session_start();

	// add validation redirect here

	require 'db_config.php';

	if( $_SERVER['REQUEST_METHOD'] === "POST" ){
		
		if($_POST["action"] === "add-task"){
			// validate fields
			if(empty($_POST["task_name"]) || !(isset($_POST["task_name"]))){
				header('Location: '.$_SERVER['PHP_SELF']."?error=Task%20Name%20empty");
				die;
			}
			if(empty($_POST["task_text"]) || !(isset($_POST["task_text"]))){
				$_POST["task_text"] = "";
			}

			// indert the record in the DB
			$s = "INSERT INTO tasks(name, task_text, username) VALUES ( '".$_POST["task_name"]."', '".$_POST["task_text"]."', '".$_SESSION["username"]."' )";
			mysqli_query($con, $s);
			header('Location: '.$_SERVER['PHP_SELF']);
			die;
		}
		if($_POST["action"] === "remove-task"){
			if(empty($_POST["task_id"]) || !(isset($_POST["task_id"]))){
				header('Location: '.$_SERVER['PHP_SELF']."?error=Invalid Task ID");
				die;
			}
			$s = "DELETE FROM tasks WHERE id=".$_POST["task_id"]." AND username='".$_SESSION["username"]."'";
			mysqli_query($con, $s);
		}	
	}

$s = "select * from tasks where username = '".$_SESSION['username']."'";

$all_tasks = mysqli_query($con, $s);


?>
<!DOCTYPE html>
<html>
<head>
	<title>App</title>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="cust.css?v=3" />
</head>
<body>
			  		




<div class="card">



  <div class="card-body">

<div class="logout-btn">
	<a class="float-right" href="logout.php" style="text-decoration: none; font-size: 18px;color: black;"> LOGOUT </a>
</div>

    <h2 class="card-title" style="text-align: center;"><?=strtoupper($_SESSION['username']);?></h2>
	
	<form action="" method="post">
	  <div class="form-row" >
	    <div class="col-md-3">
	      <input type="text" name="task_name" class="form-control" placeholder="Title" required>
	    </div>
	    <div class="col-md-7">
	      <textarea name="task_text" class="form-control" rows="1" placeholder="Text" required></textarea> 
	    </div>
	    <div class="col-md-2">
	    	<input type="hidden" name="action" value="add-task">
	      <center><button type="submit" class="btn btn-primary" style="width: 100%;">Add</button></center>
	    </div>
	  </div>
	</form>

	<!-- tasks list -->
	<br/>
	<ul class="list-group">
	  
		<?php while ($row = mysqli_fetch_assoc($all_tasks) ) {?>
		  <li class="list-group-item">
			<div class="row">
				<div class="col-md-3">
					
						<?=$row["name"];?>
					
				</div>
				<div class="col-md-7">
					<a href="edit_task.php?task-id=<?=$row['id'];?>">
						<?=substr($row["task_text"], 0, 70) ;?>
					</a>
				</div>
				<div class="col-md-2">
					
					<form action="" method="post">
						<input type="hidden" name="task_id" value='<?=$row["id"];?>'>
								<input type="hidden" name="action" value='remove-task'>	
						<center><button type="submit" class="btn btn-outline-danger btn-sm" style="width: 100%;">Remove</button></center>
					</form>
				</div>
			</div>
		  </li>

		<?php } ?>
	
	</ul>

  </div>
</div>

</body>
</html>
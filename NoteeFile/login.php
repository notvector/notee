<html>
<head>
		<title> User Login And Registration </title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">

		<div class="title">
			<h2>Notee, the simplest way to write notes.</h2>
		</div>
		
		<div class="login-box">
			<div class = "row">
				<div class="col-md-6 login-left">
					<h2> Enter Room </h2>
					<form action="validation.php" method="post">
						<div class="form-group">
							<label>Room Name</label>
							<input type="text" name="user" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>

						<button type="submit" class="btn btn-primary"> Login </button>

					</form>
				</div>


				<div class="col-md-6 login-right">
					<h2> Create Room </h2>
					<form action="registration.php" method="post">
						<div class="form-group">
							<label>Room Name</label>
							<input type="text" name="user" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>

						<button type="submit" class="btn btn-primary"> Register </button>

					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<h6>Made by Victor Shin (victorshin1230@gmail.com)</h6>
		</div>
	</div>

</body>
</html>
<?php
	include("db/config.php");
	session_start();

	if (isset($_POST['username']) and isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$stmt = $db->prepare("SELECT password FROM users WHERE username = ?");
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if (!$result) {
			$error = $db->error;
		} else {
			$count = $result->num_rows;
			// If result matched $username and $password, $count must be 1
			if ($count == 1) {
				$_SESSION['current_user'] = $username;
				header("location: welcome.php");
			} else {
				$error = "Your username or password is invalid";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hacklight meetup</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
	<?php if (isset($error)) {
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error.'</div>';
	} ?>

		<div class="container">
			<form action="" method="post" class="form-login">
				<h1>Hacklight meetup</h1>
				<h3>Please log in</h2>
				<label for="inputUsername" class="sr-only">Username</label>
				<input type="text" name="username" id="inputUsername" class="form-control" value="admin" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
				<div class="form-group" style="margin-top:10px;">
					<a  href="/index_like.php">Check username availability</a>
				</div>
			</form>
		</div>
	</body>
</html>
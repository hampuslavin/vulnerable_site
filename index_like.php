<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hacklight meetup</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>


<?php
	include("db/config.php");
	//session_start();

	if (isset($_POST['username'])) {
		$username = $_POST['username'];

		$query = "SELECT * from users where username='".$_POST['username']."'";
		$debug_query = "SELECT * from users where username='<code>".$_POST['username']."</code>'";
		$result = $db->query($query);

		if (!$result) {
			$error = $db->error;
		} else {
			$count = $result->num_rows;
			// If result matched $username and $password, $count must be 1
			if ($count == 1) {
				$info = "The username exists!";
				$success = true;	
			} else {
				$info = "The username doesn't exist!";
				$success = false;
			}
		}
	}
?>
	<?php if (isset($error)) {
		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error.'</div>';
	} ?>

	<? if(isset($query) && $_POST['debug']) : ?>
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<? echo $debug_query ?>
		</div>
	<? endif; ?>
	<? if(isset($info)) : ?>
		<div class="alert alert-<? echo $success ? 'success' : 'danger' ?> alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<? echo $info ?>
		</div>
	<? endif; ?>
	
		<div class="container">
			<form action="" method="post" class="form-login">
				<h1>Hacklight meetup</h1>
				<label for="inputUsername" class="sr-only">Username</label>
				<input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
				<button style="margin-top:10px;" class="btn btn-lg btn-primary btn-block" type="submit">Check if user name is available</button>
				<div class="form-group" style="margin-top:10px;">
					<a  href="/admin_login.php">Admin login</a>
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" checked name="debug" id="inputDebug">
					<label class="form-check-label" for="exampleCheck1">Cheat</label>
				</div>
			</form>
		</div>
	</body>
</html>
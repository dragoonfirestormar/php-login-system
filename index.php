<?php
	session_start();
	if (isset($_SESSION['loggedin'])) {
		header('Location: home.php');
		exit;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" name="loginSubmit" value="Login">
			</form>
			<form action="maker.php">
				<button class="alternative">Register First</button>
			</form>
			<?php
				$fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(strpos($fullURL, "password=incorrect") == true){
					echo "<div class=\"isa_error\">";
					echo "<i class=\"fa fa-times-circle\">";
					echo "</i>Invalid Password.</div>";
				}
				if(strpos($fullURL, "username=incorrect") == true){
					echo "<div class=\"isa_warning\">";
					echo "<i class=\"fa fa-exclamation-circle\">";
					echo "</i>Username does'nt exists.</div>";
				}
			?>
		</div>
	</body>
</html>
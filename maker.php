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
		<title>Registration</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Registration</h1>
			<form action="create.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
                <input type="text" name="username" placeholder="Username*" id="username" required>
                <label for="email">
					<i class="fa fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email*" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password*" id="password" required>
                <label for="password">
					<i class="fa fa-key"></i>
				</label>
				<input type="password" name="password_again" placeholder="Repeat Password*" id="password" required>
				<input type="submit" name="registerSubmit" value="Register">
            </form>
            <form action="index.php">
				<button class="alternative">Already Registered?</button>
            </form>
            <?php
				$fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(strpos($fullURL, "username=incorrect") == true){
					echo "<div class=\"isa_error\">";
					echo "<i class=\"fa fa-times-circle\">";
					echo "</i>Username Already Taken.</div>";
				}
				if(strpos($fullURL, "fields=empty") == true){
					echo "<div class=\"isa_warning\">";
					echo "<i class=\"fa fa-exclamation-circle\">";
					echo "</i>Username does'nt exists.</div>";
                }
                if(strpos($fullURL, "password=incorrect") == true){
					echo "<div class=\"isa_warning\">";
					echo "<i class=\"fa fa-exclamation-circle\">";
					echo "</i>Passwords does'nt matche.</div>";
                }
                if(strpos($fullURL, "registration=sucess") == true){
					echo "<div class=\"isa_success\">";
					echo "<i class=\"fa fa-exclamation-circle\">";
					echo "</i>Sucessfully Registered.</div>";
				}
			?>
		</div>
	</body>
</html>
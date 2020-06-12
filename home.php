<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<div>
				<p>Welcome back, <?=$_SESSION['name']?>!</p>
			</div>
			<div>
				<?php
				$msg="";
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$image = $_FILES['image']['tmp_name'];
					if(!empty($_FILES['image']['tmp_name'])) {
						$img = file_get_contents($image);
						include('db.php');
						$sql = "UPDATE `accounts` SET `img`=? WHERE id = ".$_SESSION['id'] ;
						$stmt = mysqli_prepare($con,$sql);
						mysqli_stmt_bind_param($stmt, "s",$img);
						mysqli_stmt_execute($stmt);
						$check = mysqli_stmt_affected_rows($stmt);
						if($check==1){
							$msg = 'Image Successfullly Uploaded';
						}else{
							$msg = 'Error uploading image';
						}
						mysqli_close($con);
					} else {
						$msg = 'None file was selected';
					}
					
				}
				?>
				<p>Upload an image to change Display Picture:</p>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="image" class="custom-file"/>
					<button class="btn">Upload a file</button>

				</form>

				<?php
					echo $msg;
				?>
				
				
			</div>

			<div>
				<p>COMMENTS</p>
				<table>
					
				<?php
					include('db.php');
					$stmt = $con->prepare('SELECT cmt_id, person, person_id, content FROM comments ORDER BY `cmt_id` DESC LIMIT 5'); //WHERE id > ?
					//$stmt->bind_param('i', $id);
					$stmt->execute();
					$stmt->bind_result($cmt_id, $person, $person_id, $content);
					$persons = array();
					$contents = array();
					for($i=0;$i<5;$i++){
						$stmt->fetch();
						$persons[$i]=$person;
						$contents[$i]=$content;
					}
					$persons=array_reverse($persons);$contents=array_reverse($contents);
					for($i=0;$i<5;$i++){
						echo "<tr>\n";
						echo "<td>" . $persons[$i] . ":</td>\n";
						echo "<td>" . $contents[$i] . "</td>\n";
						echo "</tr>\n	";
					}
					$stmt->close();
				?>
				</table>
		
				<form action="merica.php" method="POST">
				<textarea type="text" name="comment" placeholder="Comment" id="comment" rows="1" cols="20" required style = "position:relative;  top:6px;"></textarea>
				<input type="submit" name="commentSubmit" value="Post">
				</form>
			</div>
		</div>
		
	</body>
</html> 
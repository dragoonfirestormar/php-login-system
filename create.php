<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['registerSubmit'])){
        exit("NOT LEGIT");
    } else{
        include_once('db.php');
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        if (!isset($_POST['username'], $_POST['password'], $_POST['password_again'], $_POST['email'])) {
            header('Location: maker.php?fields=empty');
            exit;
        }
        if($_POST['password']!=$_POST['password_again']){
            header('Location: maker.php?password=incorrect');
            exit;
        }
        if ($stmt = $con->prepare('SELECT id FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                header('Location: maker.php?username=incorrect');
                exit;
            } else {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $newstmt = $con->prepare('INSERT INTO `accounts`(`username`, `password`, `email`) VALUES (?,?,?)');
                mysqli_stmt_bind_param($newstmt, "sss", $_POST['username'], $hash , $_POST['email']);
                mysqli_stmt_execute($newstmt);
                header('Location: maker.php?registration=sucess?');
            }
            $stmt->close();
            $newstmt->close();
        }
    }
} else{
    exit("Why are you?");
}
?>
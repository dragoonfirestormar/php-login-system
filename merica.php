
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['commentSubmit'])){
        exit("NOT LEGIT");
    } else{
        include_once('db.php');
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        if (!isset($_POST['comment'])) {
            header('Location: maker.php?fields=empty');
            exit;
        }
        if ($newstmt = $con->prepare('INSERT INTO `comments`(`person`, `person_id`, `content`) VALUES (?,?,?)')) {
            mysqli_stmt_bind_param($newstmt, "sss", $_SESSION['name'], $_SESSION['id'], $_POST['comment']);
            mysqli_stmt_execute($newstmt);
            header('Location: home.php');
            $newstmt->close();
        }
    }
} else{
    exit("Why are you?");
}
?>
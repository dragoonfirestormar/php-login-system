<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['loginSubmit'])) {
        exit("NOT LEGIT");
    } else {
        include_once('db.php');
        if ( mysqli_connect_errno() ) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        if ( !isset($_POST['username'], $_POST['password']) ) {
            exit('Please fill both the username and password fields!');
            header('Location: index.php?login=empty');
        }
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                if (password_verify($_POST['password'], $password)) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    header('Location: home.php');
                } else {
                    header('Location: index.php?password=incorrect');
                }
            } else {
                header('Location: index.php?username=incorrect');
            }
            $stmt->close();
        }
    }
}
?>
<?php
session_start();
// only for logged users!
if (!isset($_SESSION['logged'])){
header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome <?php echo $_SESSION['login']; ?></title>
</head>
<body>
    <h2>
    <?php
        // show welcome message;
        if(isset($_SESSION['login'])){
            echo 'Welcome: '.$_SESSION['login'];
        }
    ?>
    </h2>
    <h3>Simply manage Your own task list.</h3>
    <a href="./logout.php">LogOut</a>
</body>
</html>
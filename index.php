<?php
session_start();
// check if logged; Yes - redirect to member page;
if (isset($_SESSION['logged'])){
    if ($_SESSION['logged'] == true){
        header('location: ./memberpage.php');
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8">
    <title>Task Manager - JS/PHP/MYSQL</title>
</head>

<body>
    <h1>
        <?php
            if (!isset($_SESSION['registered']) && !isset($_SESSION['login'])){
                echo 'Personalised Task Manager';
            }
            // message for registered users;
            if (isset($_SESSION['registered'])){
                echo $_SESSION['registered'].$_SESSION['newLogin'];
                unset($_SESSION['registered']);
                unset($_SESSION['newLogin']);
            }
            if (isset($_SESSION['login'])){
                echo 'See You soon '.$_SESSION['login'];
                unset($_SESSION['login']);
                session_destroy();
            } // message for strangers;
        ?>
    </h1>
    <h3>
        <?php
        if(isset($_SESSION['newUser'])){
            echo $_SESSION['newUser'];
            unset($_SESSION['newUser']);
        }
        
        ?>
    </h3>
    <form action="./login.php" method="POST">
        <input type="text" placeholder="User name" name="login">
        <input type="password" placeholder="Password" name="password">
        <p>
            <?php
            // show error only when login/password is empty;
            if (isset($_SESSION['emptyFields'])){
                echo $_SESSION['emptyFields'];
                unset($_SESSION['emptyFields']);
            }
            ?>
        </p>
        <p>
            <?php
            // show error only when login and password does not match;
            if (isset($_SESSION['errorLogin'])){
                echo $_SESSION['errorLogin'];
                unset($_SESSION['errorLogin']);
            }
           ?> 
        </p>
        <input type="submit" name="submit" placeholder="LogIn">
    </form>
    <a href="./newaccount.php">Register</a>
</body>

</html>

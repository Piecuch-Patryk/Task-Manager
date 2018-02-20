<?php
// do something on submit only;
if (isset($_POST['submit'])){
    session_start();
    $login = $_POST['login'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $email = $_POST['email'];
    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $password;
    $_SESSION['pass2'] = $passwordRepeat;
    $_SESSION['email'] = $email;
    $flag = true;
    // all fields required!
    if ($login == '' || $password == '' || $passwordRepeat = '' || $email == ''){
        $flag = false;
        $_SESSION['fieldEmpty'] = 'All fields required.';
    }
    // validate login;
    $loginSafety = ctype_alnum($login);
    if ($login == ''){
        $_SESSION['loginError'] = 'Type login.';
    }
    if ($login != ''){
        if (!$loginSafety){
            $flag = false;
            $_SESSION['loginError'] = 'Login can contain letters and digits only.';
        }
    }
    // validate email;
    $emailSafety = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$emailSafety) {
        $flag = false;
        $_SESSION['emailError'] = 'Invalid e-mail format.';
    }
    // validate passwords;
    // both passwords must be the same and contain only digits and letters;
    if ($password == ''){
        $flag = false;
        $_SESSION['passError'] = 'Type password.';
    }
    if ($password != ''){
        if (!ctype_alnum($password)) {
            $flag = false;
            $_SESSION['passError'] = 'Password can contain letters and digits only.';
        } else {
            if ($_POST['password'] != $_POST['passwordRepeat']) {
                $flag = false;
                $_SESSION['passRepeatError'] = 'Repeat password correctly.';
            }
        }
    }
    if ($flag){
        // connect to data base;
        require_once('./dbconnect.php');
        try {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            // if any faults;
            if ($connection->connect_errno != 0){
                throw new Exception($connection->error);
            } else {
                // search current email in db;
                $result = $connection->query(sprintf("SELECT email FROM users where email='$email'", mysqli_escape_string($connection, $email)));
                // no faults? carry on;
                if (!$result) {
                    throw new Exception($connection->error);
                }
                $numberRows = $result->num_rows;
                // check if the given email exist in db;
                if ($numberRows > 0){
                    $_SESSION['emailError'] = 'Email already occurs in data base.';
                } else {
                    // if all good, create new account in db;
                    // hash password;
                    $passHash = password_hash($password, PASSWORD_DEFAULT);
                    $insert = $connection->query("INSERT INTO users VALUES (DEFAULT, '$login', '$passHash', '$email')");
                    if (!$insert) {
                        throw new Exception($connection->error);
                    }else {
                        $_SESSION['newLogin'] = $login;
                        $_SESSION['registered'] = 'Your account has been created! Welcome: ';
                        $_SESSION['newUser'] = 'Simply login using Your new account.';
                        header('location: ./index.php');
                    }
                }
            }
            // close db connection;
            $connection->close();
        }
        catch (Exception $e) {
            echo 'server error'.'</br>';
            echo $e;
        }    
    }
}    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8">
    <title>Task Manager - register new account!</title>
</head>
<body>
   <h1>Register Your free account!</h1>
   <a href="./index.php">Main page</a>
   <?php
    if(isset($_SESSION['fieldEmpty'])){
        echo $_SESSION['fieldEmpty'];
        unset($_SESSION['fieldEmpty']);
    }
    ?>
   <form method="POST">
       <input type="text" name="login" placeholder="User name" autocomplete="login" value=<?php
              if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
              } 
              ?>>
       <?php
       if(isset($_SESSION['loginError'])){
           echo $_SESSION['loginError'];
           unset($_SESSION['loginError']);
       }
       ?>
       <input type="email" name="email" placeholder="E-mail" autocomplete="email" value=<?php
              if(isset($_SESSION['email'])){
                  echo $_SESSION['email'];
                  unset($_SESSION['email']);
              } 
              ?>>
       <?php
       if(isset($_SESSION['emailError'])){
           echo $_SESSION['emailError'];
           unset($_SESSION['emailError']);
       }
       ?>
       <input type="password" name="password" placeholder="Password" autocomplete="new-password">
       <?php
       if(isset($_SESSION['passError'])){
           echo $_SESSION['passError'];
           unset($_SESSION['passError']);
       }
       ?>
       <input type="password" name="passwordRepeat" placeholder="Repeat password" autocomplete="new-password">
       <?php
       if(isset($_SESSION['passRepeatError'])){
           echo $_SESSION['passRepeatError'];
           unset($_SESSION['passRepeatError']);
       }
       ?>
       <button type="submit" name="submit">Register</button>
   </form>
    
</body>
</html>
<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
// do something on submit only;
if (isset($_POST['submit'])){
    session_start();
    $login = $_POST['login'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $email = $_POST['email'];
    $_SESSION['pass'] = $password;
    $_SESSION['pass2'] = $passwordRepeat;
    $_SESSION['email'] = $email;
    $flag = true;
    
    $redirectLocation = 'Location: ../register-new-account/';
    // all fields required!
    if ($login == '' || $password == '' || $passwordRepeat = '' || $email == ''){
        $flag = false;
        $_SESSION['fieldEmpty'] = 'All fields required.';
    }
    // validate login;
    $loginSafety = ctype_alnum($login);
    if ($login == ''){
        $_SESSION['loginError'] = 'Type login.';
        header($redirectLocation);
    }
    if ($login != ''){
        if (!$loginSafety){
            $flag = false;
            $_SESSION['loginError'] = 'Login can contain letters and digits only.';
            header($redirectLocation);
        }
    }
    // validate email;
    $emailSafety = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$emailSafety) {
        $flag = false;
        $_SESSION['emailError'] = 'Invalid e-mail format.';
        header($redirectLocation);
    }
    // validate passwords;
    // both passwords must be the same and contain only digits and letters;
    if ($password == ''){
        $flag = false;
        $_SESSION['passError'] = 'Type password.';
        header($redirectLocation);
    }
    if ($password != ''){
        if (!ctype_alnum($password)) {
            $flag = false;
            $_SESSION['passError'] = 'Password can contain letters and digits only.';
            header($redirectLocation);
        } else {
            if ($_POST['password'] != $_POST['passwordRepeat']) {
                $flag = false;
                $_SESSION['passRepeatError'] = 'Repeat password correctly.';
                header($redirectLocation);
            }
        }
    }
    // validate captcha;
    
    // secret code from google;
    $secretCode = '6LfRB0gUAAAAAGrF7v-R-Qq9Jv__ZUE4u-HL-xiU';
    
    // verify with google;
    $checkCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretCode.'&response='.$_POST['g-recaptcha-response']);
    $captchaAnswer = json_decode($checkCaptcha);
    if($captchaAnswer->success != 1){
        $flag = false;
        $_SESSION['e_captcha'] = 'Aren\'t You a bot, right?';
        header($redirectLocation);
    }
    if ($flag){
        // connect to data base;
        require_once('../db/dbconnect.php');
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
                    header($redirectLocation);
                    die();
                } else {
                    // if all good, create new account in db;
                    // hash password;
                    $passHash = password_hash($password, PASSWORD_DEFAULT);
                    $insert = $connection->query("INSERT INTO users VALUES (DEFAULT, '$login', '$passHash', '$email')");
                    if (!$insert) {
                        throw new Exception($connection->error);
                    }else {
                        $_SESSION['newLogin'] = $login;
                        $_SESSION['registered'] = 'Your account has been created!';
                        $_SESSION['newUser'] = 'Simply login using Your new account.';
                        header('location: ../');
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
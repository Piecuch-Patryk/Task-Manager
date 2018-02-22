<?php
session_start();
// check if the form has been sent; No - redirect to index.php;
if (!isset($_POST['submit'])){
    header('location: ./index.php');
    exit();
}
$login = $_POST['login'];
$password = $_POST['password'];
// hash password;
$passHash = password_hash($login, PASSWORD_DEFAULT);
// login and password can not be empty;
if ($login == '' || $password == ''){
    $_SESSION['emptyFields'] = 'All fields required!';
    header('location: ./index.php');
    exit();
}
// connect with data base;
require_once('./dbconnect.php');
// the way to report any faults;
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    // any faults? No - carry on;
    if ($connection->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        // never trust user inputs!
        $login = htmlentities($login, ENT_QUOTES, 'UTF-8');
        // search for the user name in db;
        $result = $connection->query(sprintf("SELECT * FROM users WHERE user='$login'", mysqli_escape_string($connection, $login)));
        // No faults? carry on;
        if(!$result){
            throw new Exception($connection->error);
        }
        // check if given username exist; No - redirect to index.html with error message;
        if ($result->num_rows > 0){
            // get all data from db as an array;
            $row = $result->fetch_assoc();
            $_SESSION['result'] = $result;
            // verify password; Yes - logged in! No - redirect to index.php;
            if (password_verify($password, $row['pass'])) {
                // *** LOGGED IN ***
                $_SESSION['id'] = $row['id'];
                $_SESSION['task'] = $row['task'];
                // close data base query;
                $result->close();
                $_SESSION['logged'] = true;
                $_SESSION['login'] = $login;
                header('location: ./memberpage.php');
            } else {
                $_SESSION['errorLogin'] = 'Login or Password incorrect';
                header('location: ./index.php');
            }
        } else {
            $_SESSION['errorLogin'] = 'Login or Password incorrect!';
            header('location: ./index.php');
        }
        // close db connection;
        $connection->close();
    }
} catch (Exception $e) {
    echo 'server error';
    echo $e;
}
?>

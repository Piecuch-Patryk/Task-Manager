<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
session_start();
// check if logged; Yes - redirect to member page;
if (isset($_SESSION['logged'])){
    if ($_SESSION['logged'] == true){
        header('location: ./logged-in/');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task Manager - JS/PHP/MYSQL</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--styles-->
    <link rel="stylesheet" href="./styles-all-pages/mainpage.css">
    <link rel="stylesheet" href="./styles-all-pages/main.css">
</head>

<body class="d-flex flex-wrap">
    <div class="main-bg">
        <header class="col-12 text-center text-light py-3 py-md-5">
            <?php
                // message for strangers;
                if (!isset($_SESSION['registered']) && !isset($_SESSION['login'])){
                    echo '<h1>Personalised Task Manager</h1>';
                }
            ?>
            <h3><?php
                    // message for new registered users;
                    if (isset($_SESSION['registered'])){
                        echo 'Welcome: '.$_SESSION['newLogin'].'</br>'.$_SESSION['registered'].'</br>';
                        unset($_SESSION['registered']);
                        unset($_SESSION['newLogin']);
                    }
                    if(isset($_SESSION['newUser'])){
                        echo $_SESSION['newUser'];
                        unset($_SESSION['newUser']);
                    }
                    // good bye message;
                    if (isset($_SESSION['login'])){
                        echo 'See You soon '.$_SESSION['login'];
                        unset($_SESSION['login']);
                        session_destroy();
                    }
                ?></h3>
        </header>
        <main class="container m-auto px-3">
            <form action="./login.php" method="POST" name="loginForm" class="container-fluid mt-5 mb-4 p-0">
                <!--username field-->
                <div class="form-group m-0 text-center">
                    <input autocomplete="username" type="text" placeholder="User name" name="login" class="form-control-sm border-0">
                    <p class="error-form m-0 text-danger"><?php
                        // show error only when login/password is empty;
                        if (isset($_SESSION['emptyFields'])){
                            echo $_SESSION['emptyFields'];
                            unset($_SESSION['emptyFields']);
                        }
                        ?></p>
                </div>
                <!--password field-->
                <div class="form-group m-0 text-center">
                    <input autocomplete="current-password" type="password" placeholder="Password" name="password" class="form-control-sm border-0">
                    <p class="error-form m-0 text-danger">
                       <?php
                        // show error only when login/password is empty;
                        if (isset($_SESSION['emptyFields'])){
                            echo $_SESSION['emptyFields'];
                            unset($_SESSION['emptyFields']);
                        }
                        ?>
                        </p>
                </div>
                <!--submit btn-->
                <div class="row text-center">
                    <div class="col-6 col-md-4 col-lg-3 m-auto">
                        <button type="submit" name="submit" class="btn btn-info btn-sm w-100 text-light">LogIn</button>
                        <p class="error-form m-0 text-danger font-size-1"><?php
                            // show error only when login or password does not match;
                            if (isset($_SESSION['errorLogin'])){
                                echo $_SESSION['errorLogin'];
                                unset($_SESSION['errorLogin']);
                            }
                            ?></p>
                    </div>
                </div>
            </form>
            <!--end form-->
            <div class="row py-1">
                <div class="col-7 col-md-4 m-auto text-center">
                    <a href="./register-new-account/" class="btn btn-info btn-sm d-block">Register free account!</a>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-7 col-md-4 m-auto text-center">
                    <a href="./demo-connect/" class="btn btn-secondary btn-sm d-block">Show demo Version.</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

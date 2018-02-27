<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task Manager - register new account!</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--styles-->
    <link rel="stylesheet" href="../styles-all-pages/registerstyles.css" type="text/css">
    <link rel="stylesheet" href="../styles-all-pages/main.css">
    <!--re-captcha-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="register-bg">
    <header>   
        <h1 class="text-center py-4">Register Your free account!</h1>
    </header>
    <main class="container">
        <form method="POST" action="./register.php" class="form py-md-5 text-center">
            <!--error field-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                    <p class="error-form text-center text-danger m-0"><?php
                        if(isset($_SESSION['fieldEmpty'])){
                            echo $_SESSION['fieldEmpty'];
                            unset($_SESSION['fieldEmpty']);
                        }
                        ?></p>
                </div>
            </div>
            <!--new login-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                <input type="text" name="login" placeholder="User name" autocomplete="login" class="form-control pr-0" value=<?php
                if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
                } 
                ?>><p class="error-form text-center text-danger py-0 m-0"><?php
                    if(isset($_SESSION['loginError'])){
                       echo $_SESSION['loginError'];
                       unset($_SESSION['loginError']);
                    }
                    ?></p>
                </div>
            </div>
            <!--new email-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                    <input type="email" name="email" placeholder="E-mail" autocomplete="email" class="form-control" value=<?php
                          if(isset($_SESSION['email'])){
                              echo $_SESSION['email'];
                              unset($_SESSION['email']);
                          } 
                          ?>><p class="error-form text-center text-danger py-0 m-0"><?php
                    if(isset($_SESSION['emailError'])){
                       echo $_SESSION['emailError'];
                       unset($_SESSION['emailError']);
                    }
                    ?></p>
                </div>
            </div>
            <!--new password-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                    <input type="password" name="password" placeholder="Password" autocomplete="new-password" class="form-control ">
                    <p class="error-form text-center text-center text-danger py-0 m-0"><?php
                    if(isset($_SESSION['passError'])){
                       echo $_SESSION['passError'];
                       unset($_SESSION['passError']);
                    }
                    ?></p>
                </div>
            </div>
            <!--new password repeat-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                    <input type="password" name="passwordRepeat" placeholder="Repeat password" autocomplete="new-password" class="form-control ">
                    <p class="error-form text-center text-danger py-0 m-0"><?php
                       if(isset($_SESSION['passRepeatError'])){
                           echo $_SESSION['passRepeatError'];
                           unset($_SESSION['passRepeatError']);
                       }
                       ?></p>
                </div>
            </div>
            <!--re-captcha-->
            <div class="row">
                <div class="col-8 ml-auto mr-0">
                    <div class="d-sm-inline-block captcha">
                        <div class="g-recaptcha" data-sitekey="6LfRB0gUAAAAAGcngaFzFU9yZB9yS0C_G288hTMa"></div>
                    </div>
                    <p class="error-form text-center text-danger py-0 m-0 mb-2"><?php
                        if(isset($_SESSION['e_captcha'])){
                            echo $_SESSION['e_captcha'];
                            unset($_SESSION['e_captcha']);
                        }
                       ?></p>
                </div>
            </div>
            <!--submit btn-->
            <div class="row text-center">
                <div class="col-8 ml-auto mr-0">
                    <div class="col-md-6 m-auto">
                        <button type="submit" name="submit" class="btn form-control btn-info">Register</button>
                    </div>
                </div>
            </div>
            <!--back to main page-->
            <div class="row">
                <div class="col-8 ml-auto mr-0 text-center py-3">
                   <a href="../" class="text-light border-bottom border-light pb-1">Main page</a> 
                </div>
            </div>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../scripts/main.js"></script>
    
</body>
</html>
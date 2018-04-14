<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
session_start();
// only for logged users!
if (!isset($_SESSION['logged'])){
header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome <?php echo $_SESSION['login']; ?></title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--styles-->
    <link rel="stylesheet" href="../styles-all-pages/memberstyles.css" type="text/css">
    <link rel="stylesheet" href="../styles-all-pages/main.css" type="text/css">
    <!--font awesome-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="bg-member bg-secondary">
    <header class="container text-light text-center">
        <div class="row m-0">
            <div class="col-9 px-0">
                <h4 class="pt-2">
                <?php
                    // show welcome message with user's login;
                    if(isset($_SESSION['login'])){
                        echo 'Welcome: '.'<span id="login-title" class="text-info">'.$_SESSION['login'].'</span>';
                    }
                ?>
                </h4>
                <p>Simply manage Your own task list.</p>
            </div>
            <div class="col-3 text-right p-0">
                <a href="./logout.php" class="text-info">LogOut</a>
            </div>
       </div>
   </header>
   <main>
        <form class="container form text-center p-3 app-container">
            <div class="row">
                <input class="col-10 col-lg-8 form-cotroler mx-auto border-0 task-input" placeholder="New task (max. 50 characters)" type="text" id="taskText">
                <p class="col-10 col-lg-8 mt-1 mb-0 mx-auto text-danger error-form fault"></p>
            </div>
            <div class="col-lg-8 m-auto d-flex justify-content-around pb-2 text-secondary validity-box">
                <span class="radio-span">
                    <input type="radio" name="validity" id="validity-1" value="important">
                    <label for="validity-1">Important</label>    
                </span>
                <span class="radio-span">
                    <input type="radio" name="validity" id="validity-2" value="work">
                    <label for="validity-2">Work</label>
                </span>
                <span class="radio-span">
                    <input type="radio" name="validity" id="validity-3" value="home">
                    <label for="validity-3">Home</laebel>
                </span>
            </div>
            <div class="d-flex justify-content-center">
                <input value="Add new task" type="button" id="new" class="btn btn-success btn new-task-btn mr-5">
                <input value="Reset current task" type="reset" id="reset" class="btn btn-danger reset-btn ml-5">
            </div>
        </form>
    <!--tasks container-->
        <div class="container-fluid tasks-list"></div>
       
    <!--end app container -->
    </main>
    <!--footer-->
    <?php include('../footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <!--app modules-->
    <script src="../scripts/modules/tasks.js" type="text/javascript"></script>
    <script src="../scripts/modules/create-list.js" type="text/javascript"></script>
    <script src="../scripts/modules/new-task.js" type="text/javascript"></script>
    <script src="../scripts/modules/reset.js" type="text/javascript"></script>
    <script src="../scripts/modules/validity.js" type="text/javascript"></script>
    <script src="../scripts/modules/delete-toggle.js" type="text/javascript"></script>
    <!-- run app script    -->
    <script src="../scripts/app.js" type="text/javascript"></script>
    <script src="../scripts/main.js" type="text/javascript"></script>
</body>
</html>
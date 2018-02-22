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
    <!--styles-->
    <link rel="stylesheet" href="./styles.css" type="text/css">
    <!--font awesome-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
    <h3 class="fault"></h3>
    <section class="app-container">
        <form>
            <input class="task-input" placeholder="New task (max. 50 characters)" type="text" id="taskText">
            <div class="validity-box">
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
            <input value="Add new task" type="button" id="new" class="new-task-btn">
            <input value="Reset current task" type="reset" id="reset" class="reset-btn">
        </form>
        <div class="tasks-list"></div>
    </section>
    <!--end app container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <!--app modules-->
    <script src="./scripts/modules/tasks.js" type="text/javascript"></script>
    <script src="./scripts/modules/create-list.js" type="text/javascript"></script>
    <script src="./scripts/modules/new-task.js" type="text/javascript"></script>
    <script src="./scripts/modules/reset.js" type="text/javascript"></script>
    <script src="./scripts/modules/validity.js" type="text/javascript"></script>
    <script src="./scripts/modules/delete-toggle.js" type="text/javascript"></script>
    <!-- run app script    -->
    <script src="./scripts/app.js" type="text/javascript"></script>
</body>
</html>
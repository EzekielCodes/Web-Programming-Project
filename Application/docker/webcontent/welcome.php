<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = $_SESSION["id"];

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <h2>Search for your next travel location in iceland</h2><br>
    <!-- <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["id"]); ?></b>. This is your id.</h1> -->
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="addmaps.php" class="btn btn-warning">View Maps</a>
        <a href="savedMaps.php" class="btn btn-warning">Saved Maps</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome! This your personal link manager system.</h1>
    </div>
    <p>
        <a href="../api/display.php" class="btn btn-primary">List all your links</a>
        <a href="../api/filter-form.html" class="btn btn-primary">Filter all your links by category</a>
        <!-- <a href="../api/delete-form.html" class="btn btn-primary">Delete link</a> -->
        <a href="../api/add.html" class="btn btn-primary">Add a link</a>
        <!-- <a href="../api/update-form.html" class="btn btn-primary">Update a link</a> -->
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>

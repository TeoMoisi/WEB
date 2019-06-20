<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$usr = $_SESSION["username"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$URL = mysqli_real_escape_string($conn, $_REQUEST['URL']);
$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
$category = mysqli_real_escape_string($conn, $_REQUEST['category']);


//echo htmlspecialchars($usr);
// $sql = "CREATE TABLE IF NOT EXISTS $usr (
//   id INT(6) UNSIGNED AUTO_INCREMENT,
//   URL VARCHAR(30),
//   description VARCHAR(20),
//   category VARCHAR(20)
// )";
$sql = "INSERT INTO links (URL, description, category, usr)
VALUES ('$URL', '$description', '$category', '$usr')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<div>
  <a href="../login/welcome.php" class="btn btn-success">Go back to the main page</a>
<div>
</html>

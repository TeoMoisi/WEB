<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<?php
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

$id = mysqli_real_escape_string($conn, $_REQUEST['id']);
$URL = mysqli_real_escape_string($conn, $_REQUEST['URL']);
$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
$category = mysqli_real_escape_string($conn, $_REQUEST['category']);

$sql = "UPDATE links
SET URL='$URL', description='$description', category='$category'
WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "A new record modified successfully!\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<div>
  <a href="../login/welcome.php" class="btn btn-success">Go back to the main page</a>
<div>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <script src="../scripts/jquery-2.1.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<body>
<?php

$id = $_POST["id"];

echo '$id';
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



//$URL = mysqli_real_escape_string($conn, $_REQUEST['URL']);

$sql = "DELETE FROM links WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully!\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<div>
  <a href="../login/welcome.php" class="btn btn-success">Go back to the main page</a>
<div>

</body>
</html>

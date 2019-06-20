<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<title>Add Record Form</title>
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
  //
  // $sql = "DELETE FROM links WHERE id = '$id'";
  //
  // if ($conn->query($sql) === TRUE) {
  //     echo "Record deleted successfully!\n";
  // } else {
  //     echo "Error: " . $sql . "<br>" . $conn->error;
  // }

  $conn->close();
  ?>
  <br>
<form action="update.php" method="post">
    <p class="form-group">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($id); ?>">
    </p>
    <p class="form-group">
        <label for="URL">URL:</label>
        <input type="text" name="URL" id="URL">
    </p>
    <p class="form-group">
        <label for="desc">Description:</label>
        <input type="text" name="description" id="desc">
    </p>
    <p class="form-group">
        <label for="category">Category:</label>
        <input type="text" name="category" id="category">
    </p>
    <input type="submit" value="Submit">
</form>

<br><br>
<div>
  <a href="../login/welcome.php" class="btn btn-success">Changed your mind? Go back to the main page</a>
<div>
</body>
</html>

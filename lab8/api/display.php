<!DOCTYPE html>
<html lang="en">
<head>
  <script src="../scripts/jquery-2.1.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/style.css">


  <script>
    $(document).ready(function () {
      $(".btn-danger").click(function () {
        console.log($(this).attr('id'));
        $.ajax({
          type: "POST",
          url: "delete.php",
          data: {id: $(this).attr('id')},
          success: function (data, status) {
            $("body").html(data);
          }
        });
      });


      $(".btn-primary").click(function () {
        console.log($(this).attr('id'));
        $.ajax({
          type: "POST",
          url: "update-form.php",
          data: {id: $(this).attr('id')},
          success: function (data, status) {
            $("body").html(data);
          }
        });
      });
    });
  </script>
</head>

<body>

<?php

    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $usr = $_SESSION["username"];


    //$usr = mysqli_real_escape_string($conn, $_SESSION["username"]);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // if(mysqli_num_rows(mysqli_query("SHOW TABLES LIKE $usr"))==0) {
    //   $sql = "CREATE TABLE IF NOT EXISTS $usr (
    //     id INT(6) UNSIGNED AUTO_INCREMENT,
    //     URL VARCHAR(30),
    //     description VARCHAR(20),
    //     category VARCHAR(20)
    //   )";
    //
    //   $stmt = $conn->prepare($sql);
    //   $stmt->execute();
    // }

    // $sql_cmd = "CREATE TABLE `".$usr."` (
    //   id INT(6) UNSIGNED AUTO_INCREMENT,
    //   URL VARCHAR(30),
    //   description VARCHAR(20),
    //   category VARCHAR(20)
    // )";
    //
    // if ($conn->query($sql_cmd) === TRUE) {
    //   echo "success";
    // }
    //
    // $stm = $conn->prepare($sql_cmd);
    // $stm->execute();

    $sql = "SELECT * FROM links where usr='$usr'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $URL, $description, $category, $usr);

  //echo htmlspecialchars($usr);
?>
  <div class="container">
<?php
  echo "<div class=\"jumbotron\">";
  echo  "<h1>Hello, $usr! These are all your links:</h1>";
  echo  "<p>A link has an id, an URL, a description and a category.</p> ";
  echo "</div>";
	echo "<table class=\"table\"border='1'><thead class=\"thead-dark\"><tr><th scope=\"col\">ID</th><th scope=\"col\">URL</th><th scope=\"col\">Description</th><th scope=\"col\">Category</th><th scope=\"col\">Delete</th><th scope=\"col\">Update</th></tr></thead><tbody>";

	while($stmt->fetch()){
		echo "<tr id='$id'>";
    echo "<td scope=\"row\">" . $id . "</td>";
		echo "<td \"row\">" . $URL . "</td>";
		echo "<td \"row\">" . $description . "</td>";
		echo "<td \"row\">" . $category . "</td>";
    echo "<td><button class=\"btn btn-danger\" id='$id'>Delete</button></td>";
    echo "<td><button class=\"btn btn-primary\" id='$id'>Update</button></td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

    $stmt->close();
	$conn->close();
?>

<div>
  <a href="../login/welcome.php" class="btn btn-success">Go back to the main page</a>
</div>
</div>
</body>
</html>

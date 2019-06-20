
<!DOCTYPE html>
<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->

</head>
<body>
    <?php

        session_start();

        // Check if the user is logged in, if not then redirect him to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login.php");
            exit;
        }

        $usr = $_SESSION["username"];

        $category = $_GET["category"];

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 2;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mysql";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //$category = mysqli_real_escape_string($conn, $_REQUEST['category']);


        $total_pages_sql = "SELECT COUNT(*) FROM links where category='$category' and usr='$usr'";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM links where category='$category' and usr='$usr' LIMIT $offset, $no_of_records_per_page";
        //$res_data = mysqli_query($conn,$sql);
        //while($row = mysqli_fetch_array($res_data)){
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $stmt->bind_result($id, $URL, $description, $category, $usr);
          ?>
            <div class="container">
          <?php
          	echo "<table class=\"table\"border='1'><thead class=\"thead-dark\"><tr><th scope=\"col\">ID</th><th scope=\"col\">URL</th><th scope=\"col\">Description</th><th scope=\"col\">Category</th></tr></thead><tbody>";


            echo "<div class=\"jumbotron\">";
            echo  "<h1>These are all your filtered links:</h1>";
            echo  "<p>A links has an id, an URL, a description and a category.</p> ";
            echo "</div>";

          	while($stmt->fetch()){
          		echo "<tr>";
              echo "<td scope=\"row\">" . $id . "</td>";
          		echo "<td \"row\">" . $URL . "</td>";
          		echo "<td \"row\">" . $description . "</td>";
          		echo "<td \"row\">" . $category . "</td>";
          		echo "</tr>";
          	}

          	echo "</tbody></table>";

              $stmt->close();
          	$conn->close();
          ?>

    <ul class="pagination">
        <li><a class="clickable" param="1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="prev" param="<?php if($pageno <= 1){ echo '#'; } else { echo ($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="next" param="<?php if($pageno >= $total_pages){ echo '#'; } else { echo ($pageno + 1); } ?>">Next</a>
        </li>
        <li><a class="last" param="<?php echo $total_pages; ?>">Last</a></li>
    </ul>

    <div>
      <a href="../login/welcome.php" class="btn btn-success">Go back to the main page</a>
    <div>
</body>
</html>

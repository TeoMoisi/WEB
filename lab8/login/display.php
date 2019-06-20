<?php


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM links";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $URL, $description, $category);

	echo "<table border='1'><tr><th>ID</th><th>URL</th><th>Description</th><th>Category</th></tr>";

	while($stmt->fetch()){
		echo "<tr>";
    echo "<td>" . $URL . "</td>";
		echo "<td>" . $id . "</td>";
		echo "<td>" . $description . "</td>";
		echo "<td>" . $category . "</td>";
		echo "</tr>";
	}

	echo "</table>";

    $stmt->close();
	$conn->close();
?>

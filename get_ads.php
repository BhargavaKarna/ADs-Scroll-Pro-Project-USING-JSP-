<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertisement_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM advertisements";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='advertisement'>";
        echo "<h3>Title: " . $row["title"] . "</h3>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<p>Contact Number: " . $row["contactno"] . "</p>";
        echo "<img src='". $row["image"] . "' alt='Advertisement Image'>";
        echo "</div>";
    }
} else {
    echo "No advertisements found";
}

$conn->close();
?>
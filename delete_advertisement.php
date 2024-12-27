<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Check if advertisement ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_advertisements.php");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertisement_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete advertisement from the database
$adId = $_GET['id'];
$sql = "DELETE FROM advertisements WHERE id=$adId";

if ($conn->query($sql) === TRUE) {
    echo "Advertisement deleted successfully";
} else {
    echo "Error deleting advertisement: " . $conn->error;
}

$conn->close();
?>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_database";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: user_dashboard.php");
} else {
    echo "Invalid username or password";
}
$conn->close();
?>
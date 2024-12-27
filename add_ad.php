<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertisement_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$contactno = $_POST['contactno'];
$description = $_POST['description'];

// Check if file is uploaded successfully and if there were no errors
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    // Upload image code here
} else {
    $image = ''; // Or set a default image here if no image is uploaded
}

$sql = "INSERT INTO advertisements (title, contactno, description, image) VALUES ('$title', '$contactno', '$description', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "Advertisement added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<a href="view_advertisements.php">View Advertisements</a> | <a href="add_advertisement.php">Add Another Advertisements</a>

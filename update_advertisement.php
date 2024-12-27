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

// Retrieve advertisement details from the database
$adId = $_GET['id'];
$sql = "SELECT * FROM advertisements WHERE id=$adId";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Advertisement not found";
    exit();
}

$row = $result->fetch_assoc();
$title = $row['title'];
$description = $row['description'];
$contactno = $row['contactno'];
$image = $row['image'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $contactno = $_POST['contactno'];
    // Update advertisement in the database
    $sql = "UPDATE advertisements SET title='$title', description='$description', contactno='$contactno' WHERE id=$adId";

    if ($conn->query($sql) === TRUE) {
        echo "Advertisement updated successfully";
    } else {
        echo "Error updating advertisement: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Advertisement</title>
    <link rel="stylesheet" href="pro.css">
</head>
<body>
    <h2>Update Advertisement</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$adId"; ?>" method="post">
        <input type="text" name="title" placeholder="Title" value="<?php echo $title; ?>" required><br>
        <input type="text" name="contactno" placeholder="Contact Number" value="<?php echo $contactno; ?>" required><br>
        <textarea name="description" placeholder="Description" required><?php echo $description; ?></textarea><br>
        <input type="submit" value="Update Advertisement">
    </form>
</body>
</html>

<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Check if 15 minutes have passed since last activity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 90000)) {
    // 90000 seconds = 2.5hours 
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: login.html");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Display user dashboard content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="pro.css">
</head>
<body>
    <div>
        <span>Welcome, <?php echo $_SESSION['username']; ?></span>
        <right><a href="logout.php">Logout</a>
    </div>
    <a href="view_advertisements.php">View Advertisements</a><br>
    <a href="add_advertisement.php">Add Advertisements</a>
</body>
</html>

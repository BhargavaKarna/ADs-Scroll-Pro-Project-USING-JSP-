<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Advertisements</title>
    <link rel="stylesheet" href="pro.css">
    <style>
        .advertisement {
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .advertisement img {
            width: 100px;
            margin-right: 20px;
        }
        .advertisement .actions {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <h2>Advertisements</h2>
    <?php
    session_start();
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
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

    // Retrieve advertisements from the database
    $sql = "SELECT * FROM advertisements";
    $result = $conn->query($sql);

    // Display advertisements
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='advertisement'>";
            echo "<div>";
            echo "<h3>".$row['title']."</h3>";
            echo "<p>".$row['description']."</p>";
            echo "<p>Contact Number: ".$row['contactno']."</p>";
            echo "</div>";
            echo "<img src='".$row['image']."' alt='Advertisement Image'>";
            echo "<div class='actions'>";
            echo "<button onclick='updateAd(".$row['id'].")'>Update</button>";
            echo "<button onclick='deleteAd(".$row['id'].")'>Delete</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No advertisements found</p>";
    }

    $conn->close();
    ?>
    <script>
        function updateAd(adId) {
            // Redirect to update advertisement page with adId as parameter
            window.location.href = "update_advertisement.php?id=" + adId;
        }

        function deleteAd(adId) {
            // Redirect to delete advertisement page with adId as parameter
            window.location.href = "delete_advertisement.php?id=" + adId;
        }
    </script>
</body>
</html>

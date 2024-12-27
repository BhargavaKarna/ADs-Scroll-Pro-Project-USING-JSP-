<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Advertisement</title>
    <link rel="stylesheet" href="pro.css">
</head>
<body>
    <h2>Add Advertisement</h2>
    <form action="add_ad.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <input type="text" name="contactno" placeholder="Contact Number" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="file" name="image" required><br>
        <input type="submit" value="Add Advertisement">
    </form>
</body>
</html>
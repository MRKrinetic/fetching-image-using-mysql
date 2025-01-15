<?php
// Database connection
$host = "localhost";
$user = "photo";
$password = "1234";
$dbname = "photogallery";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch photos from the database
$sql = "SELECT photo_name, photo_path, uploaded_at FROM Photos ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
</head>
<body>
    <h2>Photo Gallery</h2>
    <?php if ($result->num_rows > 0): ?>
        <div style="display: flex; flex-wrap: wrap;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div style="margin: 10px;">
                    <img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="<?php echo htmlspecialchars($row['photo_name']); ?>" width="200">
                    <p><?php echo htmlspecialchars($row['photo_name']); ?></p>
                    <p>Uploaded at: <?php echo htmlspecialchars($row['uploaded_at']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No photos found.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>

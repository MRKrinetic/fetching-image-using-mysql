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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    $photoName = basename($_FILES["photo"]["name"]);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $photoName;
    
    // Move the uploaded file to the server's upload directory
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        // Insert photo details into the database
        $stmt = $conn->prepare("INSERT INTO Photos (photo_name, photo_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $photoName, $targetFile);
        
        if ($stmt->execute()) {
            echo "Photo uploaded successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Failed to upload photo.";
    }
}

$conn->close();
?>

<!-- HTML form to upload a photo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo</title>
</head>
<body>
    <h2>Upload Photo</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="photo" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>

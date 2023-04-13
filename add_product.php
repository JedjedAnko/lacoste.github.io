<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$title = $_POST['title'];
$sales = $_POST['sales'];
$stocks = $_POST['stock'];
$price = $_POST['price'];
$image = $_FILES['image']['name'];

// Upload image file
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    header("location: dashboard2.php");
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Insert product into database
$sql = "INSERT INTO products (`title`, `sales`, `stock`, `price`, `image`) VALUES ('$title','$sales','$stocks' ,'$price', '$image')";
if (mysqli_query($conn, $sql)) {
    echo "Product added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
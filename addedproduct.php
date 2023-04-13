<!DOCTYPE html>
<html>

<head>
	<title>My Online Store - View Products</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="container">
		<h1>My Online Store - View Products</h1>
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

		// Select all products from the database
		$sql = "SELECT * FROM products";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Output data of each row
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<div class='product'>
			        		<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>
			        		<h3>" . $row['name'] . "</h3>
                            <p>" . $row['sales'] . "</p>
                            <p>" . $row['stock'] . "</p>
			        		<span>$" . $row['price'] . "</span>
			        	</div>";

			}
		} else {
			echo "No products found.";
		}

		// Close database connection
		mysqli_close($conn);
		?>
	</div>
</body>

</html>
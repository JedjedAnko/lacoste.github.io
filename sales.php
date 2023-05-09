<!DOCTYPE html>
<html>
<head>
	<title>Highcharts Chart with Dynamic Data from MySQL Database using PHP</title>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<style>
		#container {
			width: 80%;
			height: 500px;
			margin: 0 auto;
		}
	</style>
</head>
<body>
	<div id="container"></div>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Retrieve data from the database
			<?php
			// Database credentials
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "product";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Retrieve sales and stock data from the products table
			$sql = "SELECT id, title, sales, stock FROM products";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// Create arrays to hold the sales and stock data
				$sales = array();
				$stock = array();
				$product = array();
				while ($row = mysqli_fetch_assoc($result)) {
					$sales[] = (int)$row['sales'];
					$stock[] = (int)$row['stock'];
					$product[] = $row['title'];
				}
			} else {
				echo "No results found.";
			}
			?>

			// Generate the chart using Highcharts
			Highcharts.chart('container', {
				chart: {
					type: 'bar',
					height: 350
				},
				title: {
					text: 'Sales and Stock by Product'
				},
				xAxis: {
					categories: <?php echo json_encode($product); ?>,
					title: {
						text: 'Product'
					}
				},
				yAxis: [{
					min: 0,
					title: {
						text: 'Sales',
						align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				}, {
					title: {
						text: 'Stock',
						align: 'high'
					},
					opposite: true
				}],
				series: [{
					name: 'Sales',
					data: <?php echo json_encode($sales); ?>
				}, {
					name: 'Stock',
					data: <?php echo json_encode($stock); ?>,
					yAxis: 1
				}],
				responsive: {
					rules: [{
						condition: {
							maxWidth: 80 // Set the maximum width at which the chart will resize
						},
						chartOptions: {
							chart: {
								height: 250 // Set the new height of the chart
							}
						}
					}]
				}
			});
		});
	</script>
</body>
</html>

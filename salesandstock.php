<div id="container"></div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
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

  mysqli_close($conn);
  ?>

  // Generate the chart using Highcharts
  Highcharts.chart('container', {
      chart: {
          type: 'bar',
          height: 400 // Set the initial height of the chart
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
                  maxWidth: 500 // Set the maximum width at which the chart will resize
              },
              chartOptions: {
                  chart: {
                      height: 300 // Set the new height of the chart
                  }
              }
          }]
      }
  });
</script>

<?php
include 'session_chk.php';
include 'conn.php';

if (!isSessionActive()) {
  header("location: login.php");
}
?>

<?php
// Check if the user has submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the product ID and quantity from the form data
  $product_id = $_POST["product_id"];
  $quantity = $_POST["quantity"];

  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "product");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Insert a new order record into the database
  $sql = "INSERT INTO orders (product_id, quantity) VALUES ('$product_id', '$quantity')";
  if (mysqli_query($conn, $sql)) {
    echo "Order placed successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="buyproduct.css" />
  <title>Lacoste | Products</title>
</head>

<body>
  <div class="menu-btn">
    <i class="fas fa-bars fa-2x"></i>
  </div>

  <div class="container">
    <!-- Nav -->
    <nav class="main-nav">
      <img src="https://lacoste.com.ph/media/logo/default/default-logo-desktop_1_1.svg" alt="Microsoft" class="logo" />

      <div class="dropdown">
        <button class="dropbtn">Welcome,
          <?php echo $_SESSION['userSession']; ?>
        </button>
        <div class="dropdown-content">
          <a href="#">Profile</a>
          <a href="#">Settings</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </nav>
    <style>
      .dropbtn {
        background-color: #35483c;
        color: white;
        padding: 16px;
        font-size: 12px;
        border: none;
        cursor: pointer;
      }

      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        z-index: 1;
      }

      .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      /* Optional styling for the active link */
      .dropdown-content a.active {
        background-color: #4CAF50;
        color: white;
      }
    </style>
    
    <header class="showcase">
      <h2>Surface Deals</h2>
      <p>Select Surfaces are on sale now - save while supplies last</p>
      <a href="#" class="btn">
        Buy Now <i class="fas fa-chevron-right"></i>
      </a>
    </header>

    <!-- Home cards 1 -->
    <section class="home-cards">
      <?php
      // Connect to the database
      $conn = mysqli_connect("localhost", "root", "", "product");

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Fetch product data from the database
      $sql = "SELECT * FROM products";
      $result = mysqli_query($conn, $sql);

      // Loop through the product data and display each product in its own section
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div>';
        echo '<img src="uploads/' . $row["image"] . '" alt="' . $row["title"] . '" />';
        echo '<h3>' . $row["title"] . '</h3>';
        echo '<a href="demo.php">Buy Now <i class="fas fa-chevron-right"></i></a>';
        echo '</div>';
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </section>


    <!-- Carbon -->
    <section class="carbon dark">
      <div class="content">
    </section>

    <!-- Follow -->
    <section class="follow">
      <p>Follow Lacoste</p>
      <a href="https://facebook.com">
        <img src="https://i.ibb.co/LrVMXNR/social-fb.png" alt="Facebook" />
      </a>
      <a href="https://twitter.com">
        <img src="https://i.ibb.co/vJvbLwm/social-twitter.png" alt="Twitter" />
      </a>
      <a href="https://linkedin.com">
        <img src="https://i.ibb.co/b30HMhR/social-linkedin.png" alt="Linkedin" />
      </a>
    </section>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-inner">
      <div><i class="fas fa-globe fa-2x"></i> English (Philippines)</div>
      <ul>
        <li><a href="#" style="  color: #fff;">&copy; Lacoste 2020</a></li>
      </ul>
    </div>
  </footer>
</body>
<script>
  document
    .querySelector(".menu-btn")
    .addEventListener("click", () =>
      document.querySelector(".main-menu").classList.toggle("show")
    );
</script>

</html>
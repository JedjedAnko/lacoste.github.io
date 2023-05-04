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
    </nav>

    <!-- Showcase -->
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
        echo '<a href="demofuck.php">Buy Now <i class="fas fa-chevron-right"></i></a>';
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
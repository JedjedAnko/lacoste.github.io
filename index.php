<link rel="stylesheet" href="demoindex.css" />
<script src="demoindex.js"></script>

<header id="header">
  <img src="https://lacoste.com.ph/media/logo/default/default-logo-desktop_1_1.svg" id="header-img" />

  <div class="user-details">
    <span><i class="fa fa-user"></i></span>
    <span><i class="fa fa-shopping-bag"></i></span>
    <nav>
      <form action="login.php"><button>Login</button></form>
    </nav>

  </div>
</header>

<main>
  <div class="block one">
    <p class="d2">Lacoste</p>
    <p class="d2">Men shoes</p>
    <p class="d3">Starts From ₱2500</p>
  </div>
  <div id="block1">
    <img src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/7/4/745cma0052_21g_06.jpg" />
  </div>

  <div class="block two">
    <button>
      <i class="fa fa-play"></i>
      <img src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/7/4/745sma0116_042_01.jpg" />
    </button>
    <button>
      <i class="fa fa-play"></i>
      <img src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/7/4/745cma0052_21g_06.jpg" />
    </button>
  </div>

  <div class="block three" id="speed">
    <p class="d1">
      At the crossroads of fashion and sport, Active sneakers blend codes and
      connect worlds. Hybrid silhouettes that reveal the Crocodile's full
      creativity.
    </p>
    <p class="d2">THE SNEAKER SHOP.</p>
    <p class="d3">Within the different collections of various shoes for men.</p>
  </div>
  <style>
    .home-cards {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 20px;
      margin-bottom: 40px;
    }

    .home-cards img {
      width: 100%;
      margin-bottom: 20px;
    }

    .home-cards h3 {
      margin-bottom: 5px;
    }

    .home-cards a {
      display: inline-block;
      padding-top: 10px;
      color: #0067b8;
      text-transform: uppercase;
      font-weight: bold;
    }

    .home-cards a:hover i {
      margin-left: 10px;
    }
  </style>
  <div id="block3">
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
        echo '<h3>&#8369;' . $row["price"] . '</h3>';
        echo '<a href="demo.php">Buy Now <i class="fas fa-chevron-right"></i></a>';
        echo '</div>';
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </section>

    <div class="block seven" id="oxygenos">
      <p class="d2">LE CLUB LACOSTE</p>
      <p class="d3">You can be part of the legend</p>
    </div>
    <div id="block7">
      <img src="https://static.wixstatic.com/media/5c7601_970262412ba543828e06903a1e72e309~mv2.png/v1/fit/w_978%2Ch_1000%2Cal_c/file.png" />
      <img src="https://th.bing.com/th/id/OIP.XX9hi2ObDF8yWjZhU_oi8QHaLH?pid=ImgDet&w=1940&h=2910&rs=1" />
      <img src="https://i.pinimg.com/736x/b5/4e/7d/b54e7d7d6bd862a246ea636766d96d21--style-men-mens-style.jpg" />
    </div>

    <div id="modal">
      <span>&times;</span>
      <div class="video-wrapper">
        <iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/GcXUi1Xj9i8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <div class="video-wrapper">
        <iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/IQSYW2aiVvk?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
</main>

<footer>
  <div class="bottom">
    <p><span>🇬🇧</span> Philippines (English / GBP)</p>
    <p>
      <span class="phone-number"><i class="fa fa-phone"></i> +6396388225411</span>, 9:30am - 3:00am, Monday to Sunday
    </p>
    <hr />
    <span>© 1933 - 2023 Lacoste. All Rights Reserved</span>
    <a href="#" target="_blank">Privacy Policy</a>
    <a href="#" target="_blank">User Agreement</a>
    <a href="#" target="_blank">Terms of Sales</a>
  </div>
</footer>
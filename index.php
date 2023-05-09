<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css">
  <title>Lacoste</title>
</head>

<body>
  <button class="nav-toggle" data-menustate="closed">
    <svg class="icon icon--menu" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 0h24v24H0z" fill="none" />
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
    <svg class="icon icon--close" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
      <path d="M0 0h24v24H0z" fill="none" />
    </svg>
  </button>
  <nav class="nav" data-state="closed">
    <a href="login.php" style="--delay: 0.35s">Login</a>
    <a href="buyproduct.php" style="--delay: 0.45s">Products</a>
    <a href="contact.html" style="--delay: 0.5s">Contact</a>
  </nav>
  <header class="header" data-menustate="closed">
    <div class="grid-item grid-item--primary">
      <img
        src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/4/5/45sma0111_147_02.jpg"
        class="object-fit" alt="chair" />
      <a href="#" class="logo">
        <h1>Lacoste</h1>
      </a>
    </div>
    <div class="grid-item grid-item--secondary grid-item--content">
      <article class="article article--align-right">
        <article class="article article--align-right">
          <h5 class="rotate rotate--right">Made in<br />Philippines</h5>
        </article>
        <article class="article">
          <h4><span>1933</span> <span>2023</span></h4>
          <h2>Our Shoes</h2>
          <p>
            Within the different collections of various shoes for men.
          </p>
        </article>
    </div>
    <div class="grid-item grid-item--secondary">
      <img
        src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/4/5/45sma0095_042_03.jpg"
        class="object-fit" alt="chair" />
    </div>
    <div class="grid-item grid-item--tertiary">
      <img
        src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/7/4/745sma0116_042_01.jpg"
        class="object-fit" alt="chair" />
    </div>
    <div class="grid-item grid-item--tertiary grid-item--content">
      <article class="article">
        <p>
          Lacoste the footwear you want to buy
        </p>
      </article>
    </div>
    <div class="grid-item grid-item--tertiary">
      <img
        src="https://lacoste.com.ph/media/catalog/product/cache/26fe6a6398e2195b866f326b17d6b664/7/4/745cma0052_21g_06.jpg"
        class="object-fit" alt="chair" />
    </div>
  </header>

  <div class="loading-overlay">
    <span class="loading-overlay__content h1">Lacoste</span>
  </div>
</body>
<script>
  document.body.children[0].addEventListener("click", (event) => {
    const nav = document.querySelector("nav");
    const header = document.querySelector("header");

    if (event.target.dataset.menustate == "closed") {
      event.target.dataset.menustate =
        nav.dataset.state =
        header.dataset.menustate =
        "open";
    } else {
      event.target.dataset.menustate =
        nav.dataset.state =
        header.dataset.menustate =
        "closed";
    }
  });
</script>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zild Coffee - Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      width: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f1ea;
      scroll-behavior: smooth;
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 0.8rem 1.5rem;
      height: 120px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar.scrolled {
      background-color: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(15px);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      transition: background-color 0.3s, box-shadow 0.3s, backdrop-filter 0.3s;
    }

    .navbar.scrolled .nav-link,
    .navbar.scrolled .input-group-text {
      color: #000 !important;
    }

    .navbar.scrolled .form-control::placeholder {
      color: #333;
    }

    .navbar.scrolled .navbar-brand span {
      color: #000;
    }

    .navbar-brand img {
      height: 50px;
      border-radius: 50%;
    }

    .navbar-brand span {
      font-size: 1.8rem;
      font-weight: bold;
      color: #c19a6b;
      margin-left: 8px;
    }

    .navbar-nav .nav-item {
      margin: 0 20px;
    }

    .navbar-nav .nav-link {
      padding: 0.8rem 1rem;
      color: #fff;
      transition: color 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: #c19a6b;
    }

    .search-container {
      flex-grow: 1;
      display: flex;
      justify-content: center;
    }

    .search-container .input-group {
      max-width: 500px;
      width: 100%;
    }

    .form-control {
      border-radius: 30px;
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      border: none;
      padding: 12px 20px;
      backdrop-filter: blur(5px);
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.25);
      box-shadow: 0 0 10px #c19a6b;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .input-group-text {
      background: transparent;
      border: none;
      color: #fff;
    }
    .menu-section {
      padding-top: 140px;
      margin-bottom: 50px;
    }

    .btn-custom {
      width: 300px;
      height: 200px;
      background-size: cover;
      background-position: center;
      border-radius: 20px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 2rem;
      text-decoration: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
    }

    .btn-custom::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .btn-custom span {
      z-index: 2;
    }

    .btn-custom:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 40px 0 20px;
      text-align: center;
      margin-top: 80px;
    }

    @media (max-width: 768px) {
      .btn-custom {
        width: 90%;
        height: 180px;
        font-size: 1.5rem;
      }
    }
  </style>

  <script>
    window.addEventListener('scroll', function () {
      const navbar = document.querySelector('.navbar');
      const logo = document.querySelector('.navbar-brand img');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        logo.src = "images/zild-logo-dark.png";
      } else {
        navbar.classList.remove('scrolled');
        logo.src = "images/zild coffee.jpg";
      }
    });
  </script>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#hero">
      <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="Zild Coffee Logo">
      <span>Zild Cafe</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="search-container">
        <form class="d-flex input-group" data-menu-search>
          <input class="form-control" name="q" type="search" placeholder="Search menu items" aria-label="Search menu items">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
        </form>
      </div>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/index.html"><i class="fas fa-home"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about.html"><i class="fas fa-info-circle"></i> About</a></li>
        <li class="nav-item"><a class="nav-link" href="/team.html"><i class="fas fa-users"></i> Team</a></li>
        <li class="nav-item"><a class="nav-link" href="/blog.html"><i class="fas fa-blog"></i> Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="/men.html"><i class="fas fa-mug-hot"></i> Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container menu-section">
  <h1 class="text-center mb-4 menu-title">Our MENU</h1>
  <p class="text-center" style="font-size: 2rem; margin-bottom: 30px;">Explore our amazing Drinks and Snacks.</p>
  <div class="d-flex justify-content-center flex-wrap gap-5">
    <a href="/drinks.html" class="btn btn-custom" style="background-image: url({{ asset('site/images/SHAKE.jpg') }});">
      <span>DRINKS</span>
    </a>
    <a href="/foods.html" class="btn btn-custom" style="background-image: url({{ asset('site/images/SNACKS.jpg') }});">
      <span>SNACKS</span>
    </a>
  </div>
</div>

<section class="container mt-4" data-menu-search-section hidden>
  <h2 class="text-center mb-3">Search results</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4" data-menu-search-results></div>
  <p class="text-center mt-3" data-menu-search-empty hidden>No menu items match your search.</p>
</section>

<div class="footer_widget pt-80 pb-130">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4 order-md-1 order-lg-1">
        <div class="footer_about mt-45">
          <h4 class="footer_title">About Us</h4>
          <p>"Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments."
          </p>
          <ul class="social">
            <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>

            <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>

          </ul>
        </div>
      </div>

      <div class="col-lg-3 order-md-3 order-lg-2">
        <div class="footer_link_wrapper d-flex flex-wrap">
          <div class="footer_link mt-45">
            <h4 class="footer_title">Opening Hours</h4>
            <ul>
              <li>Mon-Fri: 2:00 P.M - 10.00 P.M</li>
              <li>Sat - Sun: 12:00 P.M - 11:00 P.M</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-3 order-md-2 order-lg-3">
        <div class="footer_link mt-45">
          <h4 class="footer_title">Quick Links</h4>
          <ul>
            <li><a href="/privacy-policy.html">Privacy Policy</a></li>
            <li><a href="/term-service.html">Terms of Service</a></li>
            <li><a href="/term of use.html">Terms of Use</a></li>
            <li><a href="/cookie-privacy.html">Cookie Policy</a></li>

          </ul>
        </div>
      </div>

      <div class="col-lg-3 order-md-4 order-lg-4">
        <div class="footer_contact mt-45">
          <h4 class="footer_title">Contact Us</h4>
          <ul>
            <li>Email: <a href="ZildCafe@gmail.com">contact@ZildCafe.com</a></li>
            <li>Phone: <a href="tel:+1234567890">0930 558 4612</a></li>
            <li>Address: Steady ready, Sta.Rosa, Concepcon, Tarlac</li>
          </ul>
        </div>
      </div>
    </div>
  </div><br><br>

  <div class="container">
    <div class="copyright text-center">
      <p>Designed and Developed by <a href="https://www.facebook.com/daniella.nogoy.33"
          rel="nofollow text-decoration-none">Daniella</a></p>
    </div>
  </div>

</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('site/assets/scroll.js') }}?v=5"></script>
<script src="{{ asset('site/assets/database-site.js') }}?v=4"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>

</html>
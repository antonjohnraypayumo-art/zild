<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Blog - Zild Coffee</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account" />

  <style>
    :root {
      --button-color: #c19a6b;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #be8237;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      scroll-behavior: smooth;
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 0.8rem 1.5rem;
      height: 120px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999;
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

    .navbar-nav .nav-link {
      color: #fff !important;
    }

    .navbar-nav .nav-link:hover {
      color: #c19a6b !important;
    }

    .search-container {
      flex-grow: 1;
      display: flex;
      justify-content: center;
    }

    .form-control {
      border-radius: 30px;
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      border: none;
      padding: 12px 20px;
      backdrop-filter: blur(5px);
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .input-group-text {
      background: transparent;
      border: none;
      color: #fff;
    }

    .btn-custom {
      background-color: var(--button-color);
      color: #fff;
    }

    #hero {
      background: url({{ asset('site/images/background zild.jpg') }}) no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
    }

    #hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(21, 19, 19, 0.4);
      z-index: -1;
    }

    .hero-content h1 {
      color: #ffe8cc;
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }

    .hero-content p {
      font-size: 1.5rem;
      opacity: 0.9;
      max-width: 700px;
      margin-inline: auto;
    }

    .section {
      padding: 100px 20px;
    }

    .section h2 {
      margin-bottom: 20px;
      color: #4a3f35;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
      object-fit: cover;
      height: 250px;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.2rem;
      }

      .hero-content p {
        font-size: 1.1rem;
      }

      .navbar {
        height: auto;
        padding: 1rem;
      }

      .navbar-brand span {
        font-size: 1.3rem;
      }

      .form-control {
        font-size: 0.9rem;
      }

      .card-img-top {
        height: 200px;
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
        <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="Zild Coffee Logo" />
        <span>Zild Cafe</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="search-container my-2 my-lg-0">
          <form class="d-flex input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
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

  <section id="blog" class="section text-center bg-white">
    <div class="container">
      <h2 class="display-4 fw-bold">Our Blog</h2>
      <p>Stay updated with the latest news, tips, and stories from Zild Coffee.</p>
      <div class="row" data-database-blog>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <img src="{{ asset('site/images/coffeejelly.jpg') }}" class="card-img-top img-fluid" alt="Blog Post 1" />
            <div class="card-body">
              <h5 class="card-title">The Art of Brewing Coffee</h5>
              <p class="card-text">Discover the techniques and secrets behind brewing the perfect cup at home.</p>
              <a href="/readmore1.html" class="btn btn-custom">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <img src="{{ asset('site/images/burger.jpg') }}" class="card-img-top img-fluid" alt="Blog Post 2" />
            <div class="card-body">
              <h5 class="card-title">Coffee and Health</h5>
              <p class="card-text">Learn about the health benefits of coffee and how it boosts your well-being.</p>
              <a href="/readmore2.html" class="btn btn-custom">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mx-auto">
          <div class="card h-100">
            <img src="{{ asset('site/images/strawberry jam.jpg') }}" class="card-img-top img-fluid" alt="Blog Post 3" />
            <div class="card-body">
              <h5 class="card-title">Sustainable Coffee Practices</h5>
              <p class="card-text">Explore how we source coffee sustainably and support local farmers.</p>
              <a href="/readmore3.html" class="btn btn-custom">Read More</a>
            </div>
          </div>
        </div>
      </div>
      <a href="/blog3.html" class="btn btn-custom mt-3">View All Posts</a>
    </div>
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


  

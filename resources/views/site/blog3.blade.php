<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Blog - Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account">
  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      background-color: #666;
    }

    .section {
      padding: 0;
      background-color: #c19a6b;
    }

    .section h2 {
      font-weight: bold;
      font-size: 3rem;
      margin-bottom: 20px;
      color: #030303;
    }

    .section p {
      color: #000;
      font-size: 1.2rem;
      margin-bottom: 40px;
    }

    .card-img-top {
      width: 100%;
      height: auto;
      max-height: 600px;
      object-fit: contain;
      display: block;
      border-radius: 8px;
    }

    .text-container {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      color: #fff;
      text-align: left;
      z-index: 1;
      background-color: #ad6f35;
      width: 50%;
      padding: 20px;
      border-radius: 8px;
      opacity: 1;
    }

    .btn-custom {
      background-color: #5a3e1d;
      color: #fff;
      border-radius: 30px;
      padding: 10px 30px;
      font-size: 1.2rem;
      transition: background-color 0.3s, transform 0.3s;
    }

    .btn-custom:hover {
      background-color: #4a3f35;
      transform: scale(1.1);
    }

    .row {
      margin-bottom: 50px;
      position: relative;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
      margin-top: 60px;
    }

    .footer_widget {
      padding-top: 80px;
      padding-bottom: 130px;
    }

    .footer_about h4,
    .footer_link h4,
    .footer_contact h4 {
      font-size: 1.5rem;
      font-weight: bold;
      color: #c19a6b;
    }

    .footer_about p {
      color: #fff;
    }

    .social {
      list-style-type: none;
      padding: 0;
    }

    .social li {
      display: inline-block;
      margin-right: 10px;
    }

    .social li a {
      color: #f1f0ef;
      font-size: 1.5rem;
    }

    .footer_link ul,
    .footer_contact ul {
      list-style-type: none;
      padding: 0;
    }

    .footer_link ul li,
    .footer_contact ul li {
      margin-bottom: 10px;
    }

    .footer_link ul li a,
    .footer_contact ul li a {
      color: #f0e9e9;
      text-decoration: none;
    }

    .footer_contact ul li a:hover {
      color: #fff;
    }

    .copyright {
      margin-top: 20px;
      font-size: 1rem;
      color: #fff;
    }

    .copyright a {
      color: #c19a6b;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .section h2 {
        font-size: 2.5rem;
      }

      .btn-custom {
        font-size: 1rem;
        padding: 8px 20px;
      }

      .text-container {
        position: static;
        transform: none;
        width: 100%;
        margin-top: 20px;
      }

      .row .col-md-6 {
        margin-bottom: 20px;
      }
    }

    @media (min-width: 1200px) {
      .text-container {
        width: 40%;
      }
    }

    a.btn-custom {
      margin-bottom: 50px;
    }
    .navbar-brand img {
      height: 40px;
      width: auto;
    }

    .navbar-brand span {
      font-size: 1.5rem;
      color: #c19a6b;
    }
  </style>
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
          <form class="d-flex input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
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

  <section id="blog" class="section text-center">
    <div class="container">
      <h2>Our Blog</h2>
      <p>Stay updated with the latest news, tips, and stories from Zild Coffee.</p>

      <div class="row mb-4">
        <div class="col-md-6">
          <img src="{{ asset('site/images/coffeejelly.jpg') }}" class="card-img-top" alt="Blog Post 1">
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <div class="text-container">
            <h5 class="card-title">The Art of Brewing Coffee</h5>
            <p class="card-text">Discover the techniques and secrets behind brewing the perfect cup of coffee at home.</p>
            <a href="/readmore1.html" class="btn btn-custom">Read More</a>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-6 order-md-2">
          <img src="{{ asset('site/images/burger.jpg') }}" class="card-img-top" alt="Blog Post 2">
        </div>
        <div class="col-md-6 order-md-1 d-flex align-items-center">
          <div class="text-container">
            <h5 class="card-title">Burger and Health</h5>
            <p class="card-text">Learn about the health benefits of Burger and how it can enhance your well-being.</p>
            <a href="/readmore2.html" class="btn btn-custom">Read More</a>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-6">
          <img src="{{ asset('site/images/strawberry jam.jpg') }}" class="card-img-top" alt="Blog Post 3">
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <div class="text-container">
            <h5 class="card-title">Sustainable Coffee Practices</h5>
            <p class="card-text">Explore how we source our Strawberry Jam sustainably and support local farmers.</p>
            <a href="/readmore3.html" class="btn btn-custom">Read More</a>
          </div>
        </div>
      </div>

      <a href="/blog.html" class="btn btn-custom">View All Posts</a>
    </div>
  </section>

  <div class="footer_widget pt-80 pb-130">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="footer_about mt-45">
            <h4 class="footer_title">About Us</h4>
            <p>"Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments."</p>
            <ul class="social">
              <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
              <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="footer_link mt-45">
            <h4 class="footer_title">Opening Hours</h4>
            <ul>
              <li>Mon-Fri: 2:00 P.M - 10.00 P.M</li>
              <li>Sat - Sun: 12:00 P.M - 11:00 P.M</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="footer_link mt-45">
            <h4 class="footer_title">Quick Links</h4>
            <ul>
              <li><a href="/privacy-policy.html">Privacy Policy</a></li>
              <li><a href="/terms-of-service.html">Terms of Service</a></li>
              <li><a href="/terms-of-use.html">Terms of Use</a></li>
              <li><a href="/cookie-policy.html">Cookie Policy</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="footer_contact mt-45">
            <h4 class="footer_title">Contact Us</h4>
            <ul>
              <li>Email: <a href="mailto:ZildCafe@gmail.com">contact@ZildCafe.com</a></li>
              <li>Phone: <a href="tel:+1234567890">0930 558 4612</a></li>
              <li>Address: Steady ready, Sta.Rosa, Concepcion, Tarlac</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright text-center">
        <p>Designed and Developed by <a href="https://www.facebook.com/daniella.nogoy.33" rel="nofollow">Daniella</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

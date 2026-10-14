<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zild Coffee - About</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      width: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f1ea;
      scroll-behavior: smooth;
      background-color: rgb(190, 152, 74);
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
      transition: 0.3s;
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

    #hero {
  background: url({{ asset('site/images/background-zild.jpg') }}) no-repeat center center/cover;
  background-attachment: fixed;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  position: relative;
  color: #fff;
  z-index: 1;
}

#hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgb(139, 111, 55);
  z-index: -1;
}


.hero-content h1 {
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: #ffe8cc;
}

.hero-content p {
  font-size: 1.5rem;
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

    .section p {
      font-size: 1.3rem;
      margin-bottom: 30px;
      color: #666;
      max-width: 700px;
      margin-inline: auto;
    }

    .about-container {
      margin-top: 120px;
      padding: 0 100px;
    }

    .card-body.bg-dark {
      background-color: #3b2e2a !important;
    }

    .btn-custom {
      background-color: #c19a6b;
      color: #fff;
      border: none;
      font-weight: 600;
    }

    .btn-custom:hover {
      background-color: #a67c52;
      color: #fff;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
      margin-top: 60px;
    }

    .about-container .card-body {
      padding: 2rem 2rem;
    }

    .about-container .card-body h5 {
      font-size: 1.5rem;
    }

    .about-container .card-body p {
      font-size: 1.1rem;
      line-height: 1.6;
      max-height: 100%;
    }
    @media (max-width: 768px) {
      .about-container .card-body h5 {
        font-size: 1.4rem;
      }

      .about-container .card-body p {
        font-size: 1rem;
      }

      .about-container {
        padding: 0 20px;
      }

      .hero-content h1 {
        font-size: 2.5rem;
      }

      .hero-content p {
        font-size: 1.2rem;
      }

      .section h2 {
        font-size: 2rem;
      }
    }
     @keyframes slideInLeft {
      from {
        transform: translateX(-100%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideInRight {
      from {
        transform: translateX(100%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
    .about-container .row img {
      opacity: 0;
      transition: transform 1s ease-out, opacity 1s ease-out;
    }

    .about-container .row img.slide-in {
      opacity: 1;
    }

    .about-container .row:nth-child(1) img.slide-in {
      animation-name: slideInLeft;
      animation-duration: 1s;
      animation-timing-function: ease-out;
    }

    .about-container .row:nth-child(2) img.slide-in {
      animation-name: slideInRight;
      animation-duration: 1s;
      animation-timing-function: ease-out;
    }

  </style>

  <script>
    window.addEventListener('scroll', function () {
      const navbar = document.querySelector('.navbar');
      const logo = document.querySelector('.navbar-brand img');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        if (logo) logo.src = "images/zild coffee.jpg";
      } else {
        navbar.classList.remove('scrolled');
        if (logo) logo.src = "images/zild coffee.jpg";
      }
    });
     function triggerAnimation() {
      const images = document.querySelectorAll('.about-container .row img');

      images.forEach((img, index) => {
        setTimeout(() => {
          img.classList.add('slide-in');
        }, index * 500); 
      });
    }

    window.onload = function () {
      triggerAnimation();
      setInterval(triggerAnimation, 3000);
    };
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

  <div class="about-container py-5">
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <img src="{{ asset('site/images/owner zild.jpg') }}" alt="Owners of Zild Cafe" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <div class="card-body bg-dark text-white rounded p-4 shadow">
          <h5 class="card-title">Meet the Visionaries</h5>
          <p class="card-text">
            Behind every great brew is a greater story. Mr. Christian Ver Tiamzon and Mrs. Jenifer Tiamzon, the
            passionate duo behind Zild Cafe, turned their love for coffee and community into a local gem. They opened
            their first cafe in 2015, starting with just a small shop and a handful of loyal customers. Today, they’ve
            built a community of coffee lovers who return not just for the perfect cup, but for the warm, inviting
            atmosphere they’ve carefully cultivated.
          </p>
          <p class="card-text">
            Every detail — from the menu to the ambiance — reflects their commitment to quality and heartwarming
            experiences. Their dedication is reflected in every cup of coffee brewed, and their love for the community
            is embedded in every interaction with their customers.
          </p>
          <a href="/discovery.html" class="btn btn-custom w-100 mt-3">Discover Our Story</a>

        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2">
        <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="Zild Cafe Logo" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6 order-md-1">
        <div class="card-body bg-dark text-white rounded p-4 shadow">
          <h5 class="card-title">A Logo That Speaks</h5>
          <p class="card-text">
            Our logo isn’t just a design — it’s a symbol of warmth, care, and craftsmanship. The earthy tones and
            minimalist elegance represent the essence of Zild Cafe: welcoming, soulful, and crafted with love. The logo
            was designed with a focus on simplicity and warmth, so that when you see it, you feel the cozy environment
            we strive to create in every corner of our cafe.
          </p>
          <a href="/discovery2.html" class="btn btn-custom w-100 mt-3">Discover Our Story</a>

        </div>
      </div>
    </div>
  </div>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team - Zild Coffee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 0.8rem 1.5rem;
      height: 120px;
      position: fixed;
      top: 0;
      width: 100%;
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
      background: url({{ asset('site/images/background zild.jpg') }}) no-repeat center center/cover;
      background-attachment: fixed;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      color: #fff;
      z-index: 1;
      overflow: hidden;
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
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #ffe8cc;
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

    .section p {
      font-size: 1.3rem;
      margin-bottom: 30px;
      color: #666;
      max-width: 700px;
      margin-inline: auto;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
      margin-top: 60px;
    }


    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.5rem;
      }

      .hero-content p {
        font-size: 1.2rem;
      }

      .btn-custom {
        font-size: 1rem;
      }

      .section h2 {
        font-size: 2rem;
      }
    }
  </style>

<script>
  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
  const logo = document.querySelector('.navbar-brand img');

window.addEventListener('scroll', function () {
  const navbar = document.querySelector('.navbar');
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
  <section class="team-section text-white">
    <div class="container">
      <h2 class="fs-1 fw-bold text-center">Our Passionate Team</h2><br>
      <div class="slider">
        <div class="slides" data-database-team>
          <div class="slide active">
            <img src="{{ asset('site/images/chris2.jpg') }}" alt="Team Member 1">
            <h3>Christian Ver</h3>
            <p>Owner & CEO</p>
            <p class="text-start">Christian is the visionary behind Zild Coffee. With a deep passion for coffee and community, he founded
              the shop to bring people together through high-quality brews and a cozy atmosphere.</p>
          </div>
          <div class="slide">
            <img src="{{ asset('site/images/jen2.jpg') }}" alt="Team Member 2">
            <h3>Jenifer</h3>
            <p>Wife of CEO</p>
            <p class="text-start">Jenifer supports the heart of Zild Coffee, helping with daily operations and ensuring a warm, welcoming
              atmosphere for everyone.</p>
          </div>
          <div class="slide">
            <img src="{{ asset('site/images/maila.jpg') }}" alt="Team Member 3">
            <h3>Maila Bacani</h3>
            <p>Helper</p>
            <p class="text-start">Maila is the reliable helping hand at Zild Coffee, assisting in daily tasks and making sure everything
              stays neat and organized.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f1ea;
      scroll-behavior: smooth;
    }

    header {
      background-color: #f0f0f0;
      color: #333;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

.team-section {
  padding: 0; 
  height: 100vh; 
  background-color: #242424; 
  display: flex; 
  justify-content: center; 
  align-items: center;
}

.slider {
  position: relative;
  max-width: 800px; 
  width: 100%;
  overflow: hidden;
}

.slides {
  display: flex;
  transition: transform 0.5s ease;
}

.slide {
  min-width: 100%;
  box-sizing: border-box;
  text-align: center;
}

.slide img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin-bottom: 15px;
}

@media (max-width: 768px) {
  .slide h3 {
    font-size: 1.2rem; 
  }
  .slide p {
    font-size: 1rem; 
  }
}


    .slider {
      position: relative;
      max-width: 600px;
      margin: auto;
      overflow: hidden;
    }

    .slides {
      display: flex;
      transition: transform 0.5s ease;
    }

    .slide {
      min-width: 100%;
      box-sizing: border-box;
      text-align: center;
    }

    .slide img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 15px;
    }

    .btn-custom {
      background-color: #c19a6b;
      color: #fff;
      border-radius: 30px;
      padding: 10px 20px;
      transition: background-color 0.3s;
    }

    .btn-custom:hover {
      background-color: #a67c52;
    }
  </style>

  <script>
    let currentSlide = 0; 
    const slides = document.querySelectorAll('.slide'); 

    function showSlide(index) {
      slides.forEach((slide) => {
        slide.style.display = 'none';
      });
      slides[index].style.display = 'block';
    }

    function changeSlide() {
      currentSlide++;
      if (currentSlide >= slides.length) {
        currentSlide = 0;
      }
      showSlide(currentSlide);
    }

    setInterval(changeSlide, 3000);

    showSlide(currentSlide);
  </script>

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
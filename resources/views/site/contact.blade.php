<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zild Coffee - Home</title>
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
      scroll-behavior: smooth;
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 0.8rem 1rem;
      height: 120px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
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
      margin: 0 10px;
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
      display: flex;
      justify-content: center;
      flex-grow: 1;
    }

    .search-container .input-group {
      max-width: 400px;
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
      background-color: #be8237;
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
      margin-bottom: 30px;
    }

    .section h2 {
      margin-bottom: 30px;
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

      .navbar-nav .nav-item {
        margin: 0 5px;
      }
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
</body>
</html>

  
  <section id="contact" class="section">
    <div class="container">
      <h2 class="text-center mb-5" style="font-size: 2.5rem; font-weight: 700; color: #4a3f35;">Find Us on the Map</h2>
  
      <div class="contact_map">
        <div class="gmap_canvas">
          <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3235.05445285107!2d120.61267567342136!3d15.368372890331093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396c11894c21d83%3A0x5b466628aa2b596c!2sZild%20Cafe!5e0!3m2!1sen!2sph!4v1744009965179!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </section>
  
    
    <style>

.contact_map {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    opacity: 0;
    transform: translateX(100%);
    animation: slideIn 1s forwards; 
}

@keyframes slideIn {
    0% {
        transform: translateX(100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

        
    
        .gmap_canvas {
            max-width: 100%;
            width: 1000px; 
        }
    
        iframe {
            width: 100%; 
            height: 450px; 
        }
body {
  background-color: rgb(190, 152, 74); 
}
.contact-info {
    margin-bottom: 60px; 
}
#contact {
  margin-top: 100px;
}

#contact h2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #4a3f35;
  margin-bottom: 50px;
}

.contact-item {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    padding: 5px;
    margin-bottom: 20px; 
    height: 220px; 
}

.contact-item i {
    color: #c19a6b;
    margin-bottom: 20px;
}

.contact-item h4 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #4a3f35;
    margin-bottom: 15px;
}

.contact-item p {
    font-size: 1.2rem;
    color: #666;
}


@media (max-width: 768px) {
    .contact-item {
        height: auto;
        margin-bottom: 30px; 
    }
}

footer {
  background-color: #333; 
  color: #fff;
  padding: 10px 0;
  text-align: center;
  margin-top: 60px;
}

.footer_widget {
  background-color: #333;
  padding: 40px 0;
  color: #fff;
}


.footer_contact ul {
  list-style: none;
  padding: 0;
}

.footer_contact li {
  margin-bottom: 10px;
}


    </style>
  
      <h2 class="text-center mb-5" style="font-size: 2.5rem; font-weight: 700; color: #4a3f35;">Contact Us</h2>
  
      <div class="contact-info mt-5">
        <div class="row text-center">
          <div class="col-md-4">
            <div class="contact-item p-4" style="background-color: #fff; border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
              <i class="fas fa-phone-alt fa-3x mb-3" style="color: #c19a6b;"></i>
              <h4 class="mb-3" style="font-size: 1.5rem; font-weight: 600; color: #4a3f35;">Phone</h4>
              <p style="font-size: 1.2rem; color: #666;">0930 558 4612</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-item p-4" style="background-color: #fff; border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
              <i class="fas fa-envelope fa-3x mb-3" style="color: #c19a6b;"></i>
              <h4 class="mb-3" style="font-size: 1.5rem; font-weight: 600; color: #4a3f35;">Email</h4>
              <p style="font-size: 1.2rem; color: #666;">@ZildCafe.com</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-item p-4" style="background-color: #fff; border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
              <i class="fas fa-map-marker-alt fa-3x mb-3" style="color: #c19a6b;"></i>
              <h4 class="mb-3" style="font-size: 1.5rem; font-weight: 600; color: #4a3f35;">Address</h4>
              <p style="font-size: 1.2rem; color: #666;">Steady Ready, Sta.Rosa, Concepcion, Tarlac</p>
            </div>
          </div>
        </div>
      </div>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>

</html>
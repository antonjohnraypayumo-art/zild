<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Cart - Zild Coffee</title>
  <style>
    body {
      background-image: url({{ asset('site/images/background zild.jpg') }});
      background-size: cover;
      background-position: center;
      color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .cart-container {
      background: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 60px;
      flex-grow: 1;
    }

    .footer_widget {
      background-color: rgba(0, 0, 0, 0.85);
      padding-top: 80px;
      padding-bottom: 40px;
      color: #fff;
    }

    .footer_widget a {
      color: #c19a6b;
      text-decoration: none;
    }

    .footer_widget a:hover {
      text-decoration: underline;
    }

    .footer_title {
      font-weight: bold;
      margin-bottom: 15px;
    }

    .copyright {
      border-top: 1px solid #444;
      padding-top: 15px;
      margin-top: 30px;
      font-size: 0.9rem;
      color: #ccc;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    ul.social li {
      display: inline-block;
      margin-right: 10px;
    }

    ul.social i {
      font-size: 1.2rem;
      color: #fff;
    }

    ul.social i:hover {
      color: #c19a6b;
    }
    @media (max-width: 768px) {
      .cart-container {
        margin-top: 20px;
        padding: 15px;
      }

      .table td, .table th {
        padding: 0.5rem;
      }

      .text-end {
        text-align: center !important;
      }

      .btn {
        width: 100%;
        margin: 5px 0;
      }

      .footer_widget .social {
        justify-content: center;
        margin-top: 15px;
      }

      .footer_widget ul {
        padding-left: 0;
        text-align: center;
      }

      .footer_widget .col-md-4 {
        margin-bottom: 20px;
      }
    }

    @media (max-width: 576px) {
      .footer_widget .social i {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="Zild Coffee Logo" width="40" height="40" class="me-2 rounded-circle" />
        Zild Coffee
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container mt-5 cart-container">
    <h1 class="text-center mb-4">Your Cart</h1>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Refresh Drinks</td>
            <td>₱110.00</td>
            <td><input type="number" value="1" class="form-control w-50" /></td>
            <td>₱110.00</td>
            <td><button class="btn btn-danger btn-sm">Remove</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <h3 class="text-end">Total: ₱110.00</h3>
    <div class="text-center mt-3">
      <a href="/drinks.html" class="btn btn-secondary">Back to Menu</a>
      <a href="/checkout.html" class="btn btn-success">Proceed to Checkout</a>
    </div>
  </div>

  <div class="footer_widget">
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
              <li>Mon-Fri: 2:00 P.M - 10:00 P.M</li>
              <li>Sat-Sun: 12:00 P.M - 11:00 P.M</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
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

        <div class="col-lg-3 col-md-4">
          <div class="footer_contact mt-45">
            <h4 class="footer_title">Contact Us</h4>
            <ul>
              <li>Email: <a href="mailto:ZildCafe@gmail.com">contact@ZildCafe.com</a></li>
              <li>Phone: <a href="tel:+1234567890">0930 558 4612</a></li>
              <li>Address: Steady Ready, Sta. Rosa, Concepcion, Tarlac</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="copyright text-center mt-4">
        <p>Designed and Developed by <a href="https://www.facebook.com/daniella.nogoy.33" rel="nofollow">Daniella</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('site/assets/scroll.js') }}?v=5"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
  <title>Checkout - Zild Coffee</title>
  <style>
    body {
      background-image: url({{ asset('site/images/background%20zild.jpg') }});
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    .checkout-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(7, 7, 7, 0.3);
      max-width: 560px;
      width: 100%;
      margin: 80px auto;
    }

    h2 {
      font-weight: 700;
      color: #6c4f3d;
      margin-bottom: 30px;
      font-family: 'Playfair Display', serif;
    }

    .form-control, .form-select {
      border-radius: 50px;
      padding: 14px 20px;
      font-size: 1rem;
      background-color: #fdfdfd;
      border: 1px solid #ddd;
    }

    .btn-main {
      background-color: #6c4f3d;
      color: white;
      border-radius: 50px;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(12, 12, 12, 0.3);
      transition: all 0.3s ease-in-out;
    }

    .btn-main:hover {
      background-color: #090808;
    }

    .btn-main:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .account-summary {
      margin: 0 0 22px;
      padding: 14px 16px;
      border-left: 3px solid #6c4f3d;
      background: #f5f0e9;
      color: #51483f;
      text-align: left;
      font-size: 0.9rem;
    }

    .account-summary strong { display: block; margin-bottom: 3px; color: #30271f; }

    .checkout-address { min-height: 46px; height: auto; white-space: normal; }

    .nav-buttons {
      margin-top: 20px;
    }

    .nav-buttons a {
      margin: 5px;
      border-radius: 50px;
      padding: 10px 20px;
      transition: all 0.3s ease-in-out;
    }

    .nav-buttons a:hover {
      background-color: #6c4f3d;
      color: white;
    }

    footer {
      background-color: #0b0b0b;
      color: #fff;
      padding: 50px 0 20px;
      margin-top: 60px;
    }

    .footer_title {
      font-weight: 600;
      margin-bottom: 15px;
    }

    .footer_about p,
    .footer_contact li,
    .footer_link ul li {
      font-size: 0.9rem;
    }

    .social li {
      display: inline;
      margin-right: 10px;
    }

    .social a {
      color: white;
      font-size: 1.2rem;
    }

    .footer_link ul li a:hover {
      text-decoration: underline;
      color: #d0b49f;
    }

    .copyright {
      border-top: 1px solid rgba(255,255,255,0.2);
      padding-top: 15px;
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

  <div class="checkout-container text-center">
    <h2>Checkout</h2>
    <div class="account-summary" data-checkout-account>
      <strong data-checkout-customer>Loading account…</strong>
      <span data-checkout-phone></span>
    </div>
    <form data-database-checkout>
      <div class="mb-3">
        <label class="form-label fw-semibold text-muted">Saved delivery address</label>
        <div class="form-control checkout-address shadow-sm text-start mb-0" data-checkout-address>Loading your saved address…</div>
      </div>
      <div class="mb-4 text-start">
        <p class="form-label fw-semibold text-muted mb-1">Saved map pin</p>
        <p class="small text-muted mb-0" data-checkout-location-status role="status" aria-live="polite">Loading your saved delivery pin…</p>
        <p class="small text-muted mt-2 mb-0">To change your delivery location, go to Manage account.</p>
      </div>
      <div class="mb-4 text-start">
        <label for="payment-method" class="form-label fw-semibold text-muted">Select Payment Method</label>
        <select class="form-select shadow-sm" name="payment_method" id="payment-method" required>
          <option value="cod">Cash on Delivery</option>
          <option value="paymaya">PayMaya</option>
          <option value="gcash">GCash</option>
          <option value="credits">Credits</option>
        </select>
      </div>

      <div class="nav-buttons d-flex justify-content-center mt-4">
        <a href="/men.html" class="btn btn-outline-secondary">Back to Menu</a>
        <button type="submit" class="btn btn-success">Place Order</button>
      </div>
      <p class="small text-muted mt-2 mb-0" data-checkout-requirements role="status" aria-live="polite">Your saved delivery location will be used for this order.</p>
      <p class="mt-3 mb-0" data-checkout-status role="status" aria-live="polite"></p>
    </form>
  </div>

  <footer>
    <div class="container">
      <div class="row text-start">
        <div class="col-md-3 mb-4">
          <h4 class="footer_title">About Us</h4>
          <p>"Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments."</p>
          <ul class="social">
            <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
            <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
          </ul>
        </div>

        <div class="col-md-3 mb-4">
          <h4 class="footer_title">Opening Hours</h4>
          <ul>
            <li>Mon-Fri: 2:00 P.M - 10:00 P.M</li>
            <li>Sat - Sun: 12:00 P.M - 11:00 P.M</li>
          </ul>
        </div>

        <div class="col-md-3 mb-4">
          <h4 class="footer_title">Quick Links</h4>
          <ul>
            <li><a href="/privacy-policy.html" class="text-white">Privacy Policy</a></li>
            <li><a href="/terms-of-service.html" class="text-white">Terms of Service</a></li>
            <li><a href="/terms-of-use.html" class="text-white">Terms of Use</a></li>
            <li><a href="/cookie-policy.html" class="text-white">Cookie Policy</a></li>
          </ul>
        </div>

        <div class="col-md-3 mb-4">
          <h4 class="footer_title">Contact Us</h4>
          <ul>
            <li>Email: <a href="mailto:ZildCafe@gmail.com" class="text-white">contact@ZildCafe.com</a></li>
            <li>Phone: <a href="tel:+639305584612" class="text-white">0930 558 4612</a></li>
            <li>Address: Steady Ready, Sta. Rosa, Concepcion, Tarlac</li>
          </ul>
        </div>
      </div>
      <div class="copyright text-center mt-4">
        <p>Designed and Developed by <a href="https://www.facebook.com/daniella.nogoy.33" class="text-white" rel="nofollow">Daniella</a></p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('site/assets/database-site.js') }}?v=8"></script>
</body>
</html>

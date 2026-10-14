<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url({{ asset('site/images/background\ zild.jpg') }}) no-repeat center center/cover;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .section-container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
    }

    .card {
      background: rgba(0, 0, 0, 0.85);
      border: none;
      border-radius: 20px;
      color: #fff;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.8);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 1);
    }

    .card-img-top {
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      height: 300px;
      object-fit: cover;
    }

    .card-title {
      color: #c19a6b;
      font-size: 1.75rem;
      margin-bottom: 15px;
    }

    .card-text {
      font-size: 1rem;
      color: #e0e0e0;
    }

    .story-button {
      background: #c19a6b;
      color: #fff;
      border-radius: 30px;
      padding: 10px 20px;
      border: none;
      transition: background 0.3s ease;
      font-weight: 500;
    }

    .story-button:hover {
      background: #a87a4a;
    }
  </style>
</head>
<body>
  <div class="section-container">
    <div class="row justify-content-center g-4">
      <div class="col-md-6">
        <div class="card h-100">
          <img src="{{ asset('site/images/owner_zild.jpg') }}" class="card-img-top" alt="Owner">
          <div class="card-body text-center">
            <h5 class="card-title">The Owners of Zild Cafe</h5>
            <p class="card-text">
              Mr. Christian Ver Tiamzon & Mrs. Jenifer Tiamzon are the proud owners of Zild Coffee, a cozy and vibrant coffee shop built on their shared passion for exceptional coffee and warm hospitality.
            </p>
            <button class="btn story-button w-75 mt-3" onclick="window.location.href='read.html'">Read Our Journey</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card h-100">
          <img src="{{ asset('site/images/zild_coffee.jpg') }}" class="card-img-top" alt="Zild Coffee Logo">
          <div class="card-body text-center">
            <h5 class="card-title">The Meaning Behind Our Logo</h5>
            <p class="card-text">
              Our logo embodies warmth and passion. The rich coffee tones and minimalist design reflect our promise: every cup is brewed with love, and every guest feels right at home.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

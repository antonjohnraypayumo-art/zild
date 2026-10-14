<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meet the Visionaries - Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account">
  <style>
    .hero-container {
      background: url({{ asset('site/images/owner zild.jpg') }}) no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
      color: #fff;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); 
    }
    .hero-content {
      z-index: 1;
      padding: 20px;
      max-width: 90%;
      width: 100%;
      max-width: 800px;
    }
    h1 {
      font-size: 4rem; 
    }

    .typing-text {
      display: inline-block;
      font-size: 2rem; 
      font-weight: bold;
      color: #c19a6b;
      white-space: nowrap;
      overflow: hidden;
      border-right: 3px solid #c19a6b;
      width: 0;
      animation: typing 4s steps(40) 1s forwards, blink-caret 0.75s step-end infinite;
    }

    @keyframes typing {
      0% {
        width: 0;
      }
      100% {
        width: 100%;
      }
    }

    @keyframes blink-caret {
      50% {
        border-color: transparent;
      }
    }

    p {
      font-size: 1.5rem;
    }
    .btn-custom {
      background-color: #c19a6b;
      color: #fff;
      border-radius: 30px;
      padding: 12px 35px; 
      font-size: 1.4rem; 
      transition: background-color 0.3s;
    }

    .btn-custom:hover {
      background-color: #4a3f35;
    }

    @media (max-width: 768px) {
      h1 {
        font-size: 2.5rem;
      }

      .typing-text {
        font-size: 1.5rem; 
      }

      p {
        font-size: 1.2rem; 
      }

      .btn-custom {
        padding: 10px 30px; 
        font-size: 1.2rem; 
      }
    }

    @media (max-width: 576px) {
      h1 {
        font-size: 2rem; 
      }

      .typing-text {
        font-size: 1.2rem; 
      }

      p {
        font-size: 1rem; 
      }

      .btn-custom {
        padding: 8px 25px; 
        font-size: 1rem;
      }
    }
  </style>
</head>

<body>

  <div class="hero-container">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="mb-4">Meet the Visionaries</h1>
      <div class="typing-text">Behind every great brew is a greater story...</div>
      <p class="mt-3">
        Mr. Christian Ver Tiamzon and Mrs. Jenifer Tiamzon, the passionate duo behind Zild Cafe, turned their love for coffee and community into a local gem. They opened their first cafe in 2015, starting with just a small shop and a handful of loyal customers.
      </p>
      <p>
        Today, they’ve built a community of coffee lovers who return not just for the perfect cup, but for the warm, inviting atmosphere they’ve carefully cultivated.
      </p>
      <a href="/about.html" class="btn btn-custom w-100 mt-3">Back</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

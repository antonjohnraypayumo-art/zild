<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A Logo That Speaks - Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('site/style.css') }}?v=account">
  <style>
    .hero-container {
      background: url({{ asset('site/images/zild coffee.jpg') }}) no-repeat center center/cover;
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
      <h1 class="mb-4">A Logo That Speaks</h1>
      <div class="typing-text">Our logo isn’t just a design — it’s a symbol of warmth, care, and craftsmanship...</div>
      <p class="mt-3">
        Our logo wasn’t just created; it was carefully crafted to represent the essence of Zild Cafe. The earthy tones and minimalist elegance reflect the welcoming, soulful, and loving environment we aim to create for all our visitors.
      </p>
      <p>
        It’s not just a logo; it’s a symbol of who we are, a representation of the heart and soul that goes into every cup and every interaction. When you see it, you should feel the warmth and care we put into every detail.
      </p>
      <a href="/discovery.html" class="btn btn-custom mt-4">Back</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

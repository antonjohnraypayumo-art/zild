<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thank You - Zild Coffee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins&display=swap" rel="stylesheet"/>
  <style>
    body {
      background: url({{ asset('site/images/background%20zild.jpg') }}) no-repeat center center/cover;
      color: #fff;
      height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .thank-you-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      padding: 50px 40px;
      border-radius: 25px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
      text-align: center;
      max-width: 500px;
      width: 90%;
      animation: fadeIn 1s ease-in-out;
      position: relative;
    }

    .thank-you-container h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.7rem;
      color: #f4a261;
      margin-bottom: 20px;
    }

    .thank-you-container p {
      font-size: 1.2rem;
      color: #f1f1f1;
      margin-bottom: 20px;
    }

    .thank-you-container .quote {
      font-style: italic;
      color: #ccc;
      font-size: 1rem;
      margin-bottom: 30px;
    }

    .btn-primary, .btn-secondary {
      border-radius: 30px;
      padding: 12px 30px;
      font-size: 1.1rem;
      font-weight: bold;
      transition: transform 0.2s ease-in-out, background-color 0.3s;
      margin: 5px;
    }

    .btn:hover {
      transform: scale(1.05);
    }

    .btn-primary {
      background-color: #f4a261;
      border: none;
    }

    .btn-primary:hover {
      background-color: #e76f51;
    }

    .btn-secondary {
      background-color: #2a9d8f;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #264653;
    }

    .coffee-icon {
      font-size: 3rem;
      color: #f4a261;
      margin-bottom: 10px;
      animation: steam 2s infinite ease-in-out;
    }

    @keyframes steam {
      0% { transform: translateY(0px); opacity: 1; }
      50% { transform: translateY(-10px); opacity: 0.7; }
      100% { transform: translateY(0px); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .confetti {
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
    }

    .confetti span {
      position: absolute;
      width: 10px;
      height: 10px;
      background: #f4a261;
      opacity: 0.7;
      animation: confetti-fall 5s linear infinite;
      border-radius: 50%;
    }

    @keyframes confetti-fall {
      0% { transform: translateY(-100px) rotate(0deg); }
      100% { transform: translateY(100vh) rotate(360deg); }
    }

    @media (max-width: 576px) {
      .btn {
        display: block;
        width: 100%;
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="thank-you-container">
    <div class="coffee-icon">☕</div>
    <h1>Thank You!</h1>
    <p>We appreciate your support and can't wait for you to enjoy your coffee.</p>
    <p data-order-confirmation>Your order has been successfully placed and is now being prepared with love and care.</p>
    <div class="quote">“Behind every successful day is a good cup of coffee.”</div>
    <a href="/index.html" class="btn btn-primary">Back to Home</a>
    <a href="/contact.html" class="btn btn-secondary">Send Another Message</a>

    <div class="confetti">
      <span style="left:10%; animation-delay:0s;"></span>
      <span style="left:30%; animation-delay:0.5s;"></span>
      <span style="left:50%; animation-delay:1s;"></span>
      <span style="left:70%; animation-delay:1.5s;"></span>
      <span style="left:90%; animation-delay:2s;"></span>
    </div>
  </div>

</body>
</html>

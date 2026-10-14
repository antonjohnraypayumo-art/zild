<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Coffee Jelly Frappee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* General Styles */
    html, body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom right, #3b2f2f, #6a4f32);
      color: #fefefe;
    }

    header {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 20px 10px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    header h1 {
      font-size: 2em;
      color: #d4af37;
      margin: 0;
    }

    .blog-post {
      background-color: #fff;
      color: #333;
      border-radius: 10px;
      padding: 20px;
      max-width: 900px;
      margin: 20px auto;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .blog-post img {
      width: 100%;
      max-width: 300px;
      height: auto;
      border-radius: 10px;
      object-fit: contain;
      flex-shrink: 0;
    }

    .text-content {
      flex: 1;
    }

    .text-content h2 {
      color: #b8860b;
      border-bottom: 1px solid #b8860b;
      padding-bottom: 3px;
      margin: 15px 0 10px;
      font-size: 1.3rem;
    }

    .text-content p {
      font-size: 0.95rem;
      color: #444;
      margin-bottom: 10px;
    }

    .btn {
      display: inline-block;
      padding: 8px 18px;
      background-color: #d4af37;
      color: #000;
      text-decoration: none;
      font-weight: bold;
      border-radius: 20px;
      transition: all 0.3s ease;
      margin-top: 15px;
    }

    .btn:hover {
      background-color: #b8860b;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .blog-post {
        flex-direction: column;
      }

      .blog-post img {
        width: 100%;
        height: auto;
        max-width: 100%;
      }

      header h1 {
        font-size: 1.5em;
      }

      .text-content h2 {
        font-size: 1.1rem;
      }

      .text-content p {
        font-size: 0.9rem;
      }

      .btn {
        padding: 7px 15px;
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Burger</h1>
  </header>

  <section class="blog-post">
    <img src="{{ asset('site/images/burger.jpg') }}" alt="Coffee Jelly Frappee">

    <div class="text-content">
      <p>Our signature burger is a hearty and juicy delight stacked high with a perfectly grilled beef patty, fresh lettuce, ripe tomatoes, crispy pickles, and creamy cheese. All tucked between warm, toasted buns and drizzled with our special house sauce, it’s the ultimate comfort food for any craving.</p>

      <h2>Premium Ingredients</h2>
      <p>We use 100% pure beef, farm-fresh veggies, and a secret blend of spices to deliver a rich, satisfying flavor in every bite. No shortcuts, just real goodness.</p>
      
      <h2>Flavor Explosion</h2>
      <p>Every layer is crafted to balance texture and taste—from the soft bun to the crisp toppings and savory patty. It's a burst of flavor you won’t forget.</p>
      
      <h2>Why You’ll Love It</h2>
      <p>Whether you’re dining in or grabbing on the go, our burger is guaranteed to hit the spot. It’s not just a meal—it’s an experience.</p>
      

      <a href="/blog.html" class="btn"><i class="fas fa-arrow-left"></i> Back to Blog</a>
    </div>
  </section>

</body>
</html>

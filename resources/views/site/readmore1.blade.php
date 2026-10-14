<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Coffee Jelly Frappee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
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
        max-width: 100%;
        height: auto;
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
    <h1>Coffee Jelly Frappee</h1>
  </header>

  <section class="blog-post">
    <img src="{{ asset('site/images/coffeejelly.jpg') }}" alt="Coffee Jelly Frappee">

    <div class="text-content">
      <p>Coffee Jelly is a unique dessert that combines the bold flavors of coffee with a fun, chewy texture. In this post, we'll take a closer look at the origins of coffee jelly, the process of making it, and why it’s a favorite treat for coffee lovers.</p>

      <h2>The Making of Coffee</h2>
      <p>Coffee Jelly is made by brewing strong coffee and combining it with agar-agar or gelatin to create a firm, jelly-like texture.</p>

      <h2>Flavored Profile</h2>
      <p>The flavor of coffee jelly is a perfect balance between the bitterness of coffee and the smoothness of cream.</p>

      <h2>Conclusion</h2>
      <p>Coffee Jelly is more than just a fun dessert; it’s an exciting way to enjoy coffee in a new form.</p>

      <a href="/blog.html" class="btn"><i class="fas fa-arrow-left"></i> Back to Blog</a>
    </div>
  </section>

</body>
</html>

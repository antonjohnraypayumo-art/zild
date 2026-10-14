<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Art of Brewing Coffee</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> 
</head>
<style>
    body {
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            margin: 0; 
            padding: 0; 
            background-color: #f8f5f0; 
        }
        header {
            background-color: #f0f0f0;
            color: #333; 
            padding: 20px; 
            text-align: center; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }

        .blog-post {
            padding: 30px; 
            max-width: 800px; 
            margin: 20px auto; 
            background-color: #fff; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            transition: transform 0.3s; 
        }

        .blog-post:hover {
            transform: translateY(-5px); 
        }

        /* Image Styles */
        .blog-post img {
            width: 100%; 
            height: auto; 
            border-radius: 10px; 
            margin-bottom: 20px;
        }
        h1, h2 {
            color: #333; 
        }

        h1 {
            margin-bottom: 20px; 
            font-size: 2.5em;
        }

        h2 {
            margin-top: 20px; 
            margin-bottom: 10px; 
            font-size: 1.8em; 
            border-bottom: 2px solid #007bff; 
            padding-bottom: 5px; 
        }
        p {
            margin-bottom: 15px; 
            color: #555; 
            font-size: 1.1em; 
        }
        .btn {
            display: inline-block; 
            padding: 10px 20px; 
            background-color: #007bff; 
            color: #fff; 
            text-decoration: none; 
            border-radius: 5px; 
            transition: background-color 0.3s, transform 0.3s; 
            margin-top: 20px; 
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05); 
        }
    </style>
</style>
<body>
    <header>
        <h1>BURGER</h1>
    </header>
    <section class="blog-post">
        <div class="container">
            <img src="{{ asset('site/images/burger.jpg') }}" alt="The Art of Brewing Coffee" class="img-fluid">
            <p>The burger is one of the most beloved comfort foods worldwide. In this post, we’ll explore the art of making the perfect burger, the essential ingredients that go into it, and how to customize it to suit your taste.</p>
            <h2>THE PERFECT PATTY</h2>
            <p>The foundation of any great burger is the patty. Whether made from beef, chicken, or plant-based alternatives, the key to a juicy and flavorful patty lies in the right seasoning and cooking technique. A well-seasoned patty, cooked to perfection, is the heart of a delicious burger.</p>
            <h2>THE BUN</h2>
            <p>The right bun is essential to the perfect burger. Soft yet sturdy enough to hold all the ingredients, a toasted bun adds a touch of warmth and flavor that complements the savory fillings.</p>
            <h2>COCLUSION</h2>
            <p>The burger is a versatile and satisfying dish that has stood the test of time. Whether you prefer it classic or loaded with toppings, a good burger is always a crowd-pleaser. With the right ingredients and a little creativity, you can make a burger that’s perfect for any occasion.</p>
            <a href="/blog.html" class="btn btn-custom">Back to Blog</a>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet the Owner - Zild Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url({{ asset('site/images/background zild.jpg') }}) no-repeat center center/cover;
            color: #fff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 0;
        }

        .navbar .nav-links {
            margin-left: auto;
        }

        .navbar a {
            color: #c19a6b;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #fff;
        }

        .container {
            padding: 50px 20px;
            max-width: 600px;
            margin: auto;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
            text-align: center;
        }

        h1 {
            color: #c19a6b;
            margin-bottom: 20px;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }

        .owner-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #c19a6b;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            line-height: 1.6;
        }

        footer {
            background: #111;
            padding: 10px 0;
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="nav-links">
                <a href="/index.html">Home</a>
                <a href="/men.html">Menu</a>
                <a href="/contact.html">Contact</a>
                <a href="/blog.html">Blog</a>
                <a href="/about.html">About</a>
                <a href="/owner.html">Owner</a>
                <a href="/cart.html">Cart</a>
                <a href="/feedback.html">Feedback</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Meet the Owner</h1>
        <img src="{{ asset('site/images/owner zild.jpg') }}" alt="Zild Coffee Owner" class="owner-photo">
        <p>Hi! I'm Zild, the heart and soul behind Zild Coffee. My passion for crafting the perfect cup of coffee inspired me to create a space where everyone can savor rich flavors, warm ambiance, and a sense of community. Every bean tells a story — and I can't wait to share it with you.</p>
    </div>

    <div class="footer_widget pt-80 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 order-md-1 order-lg-1">
                    <div class="footer_about mt-45">
                        <h4 class="footer_title">About Us</h4>
                        <p>"Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments."</p>
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
                            <li><a href="/terms-of-service.html">Terms of Service</a></li>
                            <li><a href="/terms-of-use.html">Terms of Use</a></li>
                            <li><a href="/cookie-policy.html">Cookie Policy</a></li>
                           
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
        </div>
      </div>
      
      <div class="footer_copyright">
        <div class="container">
            <div class="copyright text-center">
                <p>Designed and Developed by <a href="https://www.facebook.com/daniella.nogoy.33" rel="nofollow">Daniella</a></p>
            </div> 
        </div> 
      </div> 
      </section>
      
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
      </body>
      </html>
      
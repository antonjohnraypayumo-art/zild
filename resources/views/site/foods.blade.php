<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zild Coffee - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('site/style.css') }}?v=account" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    html, body {
    height: 100%;
    width: 100%;
    font-family: 'Arial', sans-serif;
    background-color: #f4f1ea;
    overflow: auto; 
}

    .navbar {
      background-color: rgba(0, 0, 0, 0.8);
      padding: 0.8rem 1.5rem;
    }
    .navbar-brand img {
      height: 50px;
      border-radius: 50%;
    }
    .navbar-brand span {
      font-size: 1.8rem;
      font-weight: bold;
      color: #c19a6b;
      margin-left: 8px;
    }
    .navbar-nav .nav-item {
      margin: 0 10px;
    }
    .navbar-nav .nav-link {
      padding: 0.8rem 1rem;
      color: #fff;
    }
    .navbar-nav .nav-link i {
      margin-right: 5px;
    }

    .search-container {
      flex-grow: 1;
      display: flex;
      justify-content: center;
    }
    .search-container .input-group {
      width: 65%;
    }
    .search-container .form-control {
      padding: 12px 20px;
      border: none;
      border-radius: 30px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      backdrop-filter: blur(5px);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      transition: 0.3s ease-in-out;
    }
    .search-container .form-control::placeholder {
      color: #ddd;
    }
    .search-container .form-control:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 15px rgba(193, 154, 107, 0.8);
    }
    .search-container .input-group-text {
      background: transparent;
      border: none;
      color: #fff;
      padding: 0 15px;
    }
    #hero {
      position: relative;
      background: url({{ asset('site/images/coffee-bg.jpg') }}) no-repeat center center/cover;
      height: calc(100vh - 56px); 
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      position: absolute;
      bottom: 0;
      width: 100%;
      margin-bottom: auto;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#hero">
        <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="Zild Coffee Logo">
        <span>Zild Cafe</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="search-container">
                    <form class="d-flex input-group" data-menu-search>
                        <input class="form-control" name="q" type="search" placeholder="Search menu items" aria-label="Search menu items">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </form>
        </div>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/index.html"><i class="fas fa-home"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/about.html"><i class="fas fa-info-circle"></i> About</a></li>
          <li class="nav-item"><a class="nav-link" href="/team.html"><i class="fas fa-users"></i> Team</a></li>
          <li class="nav-item"><a class="nav-link" href="/blog.html"><i class="fas fa-blog"></i> Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="/men.html"><i class="fas fa-mug-hot"></i> Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>



    <div class="container mt-5">
        <h1 class="text-center mb-4" style="font-family: 'Playfair Display', serif; font-size: 3.5rem; color: #FFD700; letter-spacing: 3px; text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9), 0 0 15px #FF8C00; font-style: italic;">Our Menu</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4" data-database-menu="snacks">
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/burger.jpg') }}" class="card-img-top" alt="Burger" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Burger</h5>
                        <p class="card-text">Juicy patty, fresh veggies, and sauces in a soft bun.</p>
                        <p class="fw-bold">PHP 110.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionBurger()">Add to Cart</button>
                    </div>
                </div>
            </div>
        
            <div id="burgerSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="burger-size" class="form-select mb-2">
                    <option value="regular" selected>Regular</option>
                    <option value="double">with Cheese</option>
                    <option value="triple">with Egg and Cheese</option>
                </select>
                <button class="btn btn-success" onclick="addToCartBurger()">Confirm</button>
                <button class="btn btn-danger" onclick="closeBurgerModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionBurger() {
                    document.getElementById('burgerSizeModal').style.display = 'block';
                }
            
                function closeBurgerModal() {
                    document.getElementById('burgerSizeModal').style.display = 'none';
                }
            
                function addToCartBurger() {
                    const size = document.getElementById('burger-size').value;
                    window.location.href = `cart12.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/footlong.jpg') }}" class="card-img-top" alt="Hotdog Sandwich" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Hotdog Sandwich</h5>
                        <p class="card-text">Grilled sausage in a bun with toppings like ketchup, mustard, and onions.</p>
                        <p class="fw-bold">PHP 89.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionHotdog()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="hotdogSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="hotdog-size" class="form-select mb-2">
                    <option value="regular" selected>Regular</option>
                    <option value="footlong">Footlong</option>
                </select>
                <button class="btn btn-success" onclick="addToCartHotdog()">Confirm</button>
                <button class="btn btn-danger" onclick="closeHotdogModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionHotdog() {
                    document.getElementById('hotdogSizeModal').style.display = 'block';
                }
            
                function closeHotdogModal() {
                    document.getElementById('hotdogSizeModal').style.display = 'none';
                }
            
                function addToCartHotdog() {
                    const size = document.getElementById('hotdog-size').value;
                    window.location.href = `cart13.html?size=${size}`;
                }
            </script>
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/fries.avif') }}" class="card-img-top" alt="Fries" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Fries</h5>
                        <p class="card-text">Crispy, golden potato sticks — salty and delicious.</p>
                        <p class="fw-bold">PHP 75.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionFries()">Add to Cart</button>
                    </div>
                </div>
            </div>

            <div id="friesSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="fries-size" class="form-select mb-2">
                    <option value="small">Small</option>
                    <option value="medium" selected>Medium</option>
                    <option value="large">Large</option>
                </select>
                <button class="btn btn-success" onclick="addToCartFries()">Confirm</button>
                <button class="btn btn-danger" onclick="closeFriesModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionFries() {
                    document.getElementById('friesSizeModal').style.display = 'block';
                }
            
                function closeFriesModal() {
                    document.getElementById('friesSizeModal').style.display = 'none';
                }
            
                function addToCartFries() {
                    const size = document.getElementById('fries-size').value;
                    window.location.href = `cart14.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/nachos.jpg') }}" class="card-img-top" alt="Nachos" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Nachos</h5>
                        <p class="card-text">Crispy tortilla chips topped with cheese, salsa, and other tasty toppings.</p>
                        <p class="fw-bold">PHP 119.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionNachos()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="nachosSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="nachos-size" class="form-select mb-2">
                    <option value="solo">Solo</option>
                    <option value="regular" selected>Regular</option>
                    <option value="party">Party</option>
                </select>
                <button class="btn btn-success" onclick="addToCartNachos()">Confirm</button>
                <button class="btn btn-danger" onclick="closeNachosModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionNachos() {
                    document.getElementById('nachosSizeModal').style.display = 'block';
                }
            
                function closeNachosModal() {
                    document.getElementById('nachosSizeModal').style.display = 'none';
                }
            
                function addToCartNachos() {
                    const size = document.getElementById('nachos-size').value;
                    window.location.href = `cart15.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/tuna pie.jpg') }}" class="card-img-top" alt="Tuna Pie" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Tuna Pie</h5>
                        <p class="card-text">Crispy crust filled with creamy, savory tuna filling.</p>
                        <p class="fw-bold">PHP 49.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionTuna()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="tunaSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="tuna-size" class="form-select mb-2">
                    <option value="regular" selected>Regular</option>
                    <option value="jumbo">Jumbo</option>
                </select>
                <button class="btn btn-success" onclick="addToCartTuna()">Confirm</button>
                <button class="btn btn-danger" onclick="closeTunaModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionTuna() {
                    document.getElementById('tunaSizeModal').style.display = 'block';
                }
            
                function closeTunaModal() {
                    document.getElementById('tunaSizeModal').style.display = 'none';
                }
            
                function addToCartTuna() {
                    const size = document.getElementById('tuna-size').value;
                    window.location.href = `cart16.html?size=${size}`;
                }
            </script>

<div class="col">
    <div class="card h-100">
        <img src="{{ asset('site/images/chicken.jpg') }}" class="card-img-top" alt="Chicken Pop" width="100%" height="500px">
        <div class="card-body">
            <h5 class="card-title">Chicken Pop</h5>
            <p class="card-text">Bite-sized, crispy, and juicy fried chicken snacks.</p>
            <p class="fw-bold">php 99.00</p>
            
            <button class="btn btn-primary" onclick="showSizeSelection('chicken')">Add to Cart</button>
        </div>
    </div>
</div>

<div id="chickenSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
    <h5>Select a Size</h5>
    <select id="chicken-size" class="form-select mb-2">
        <option value="small">Small</option>
        <option value="medium" selected>Medium</option>
        <option value="large">Large</option>
    </select>
    <button class="btn btn-success" onclick="addToCart('chicken', 'cart17.html')">Confirm</button>
    <button class="btn btn-danger" onclick="closeSizeModal('chicken')">Cancel</button>
</div>

<script>
    function showSizeSelection(item) {
        document.getElementById(`${item}SizeModal`).style.display = 'block';
    }

    function closeSizeModal(item) {
        document.getElementById(`${item}SizeModal`).style.display = 'none';
    }

    function addToCart(item, cartPage) {
        const size = document.getElementById(`${item}-size`).value;
        window.location.href = `${cartPage}?size=${size}`;
    }
</script>
            
<div class="col">
    <div class="card h-100">
        <img src="{{ asset('site/images/pasta.webp') }}" class="card-img-top" alt="Carbonara Pasta" style="width: 100%; height: 500px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">Pasta (Carbonara)</h5>
            <p class="card-text">Creamy Italian pasta dish made with eggs, cheese, pancetta, and pepper — rich, savory, and comforting.</p>
            <p class="fw-bold">PHP 120.00</p>
            <button class="btn btn-primary" onclick="showSizeSelectionPasta()">Add to Cart</button>
        </div>
    </div>
</div>

<div id="pastaSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
    <h5>Select a Size</h5>
    <select id="pasta-size" class="form-select mb-2">
        <option value="regular" selected>Regular</option>
        <option value="large">Large</option>
        <option value="family">Family Size</option>
    </select>
    <button class="btn btn-success" onclick="addToCartPasta()">Confirm</button>
    <button class="btn btn-danger" onclick="closePastaModal()">Cancel</button>
</div>

<script>
    function showSizeSelectionPasta() {
        document.getElementById('pastaSizeModal').style.display = 'block';
    }

    function closePastaModal() {
        document.getElementById('pastaSizeModal').style.display = 'none';
    }

    function addToCartPasta() {
        const size = document.getElementById('pasta-size').value;
        window.location.href = `cart18.html?size=${size}`;
    }
</script>
<script src="{{ asset('site/assets/database-site.js') }}?v=4"></script>

</div>
</div>
    </div>
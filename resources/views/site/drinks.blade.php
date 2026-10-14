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
        <div class="row row-cols-1 row-cols-md-3 g-4" data-database-menu="drinks">
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/chocolate frappee.jpg') }}" class="card-img-top" alt="Chocolate Frappee" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Chocolate Frappee</h5>
                        <p class="card-text">Rich, chocolatey indulgence blended to perfection.</p>
                        <p class="fw-bold">PHP 169.00</p>
                        
                        <button class="btn btn-primary" onclick="showChocoSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div id="chocoSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="choco-size" class="form-select mb-2">
                    <option value="small">Tall</option>
                    <option value="medium" selected>Grande</option>
                    <option value="large">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addChocoToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeChocoModal()">Cancel</button>
            </div>
            
            <script>
                function showChocoSizeSelection() {
                    document.getElementById('chocoSizeModal').style.display = 'block';
                }
            
                function closeChocoModal() {
                    document.getElementById('chocoSizeModal').style.display = 'none';
                }
            
                function addChocoToCart() {
                    const size = document.getElementById('choco-size').value;
                    window.location.href = `cart2.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/matcha latte.jpg') }}" class="card-img-top" alt="Matcha latte" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Strawberry Matcha</h5>
                        <p class="card-text">Creamy matcha green tea layered with sweet strawberry.</p>
                        <p class="fw-bold">PHP 139.00</p>
                        
                        <button class="btn btn-primary" onclick="showMatchaSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="matchaSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="matcha-size" class="form-select mb-2">
                    <option value="small">Tall</option>
                    <option value="medium" selected>Grande</option>
                    <option value="large">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addMatchaToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeMatchaModal()">Cancel</button>
            </div>
            
            <script>
                function showMatchaSizeSelection() {
                    document.getElementById('matchaSizeModal').style.display = 'block';
                }
            
                function closeMatchaModal() {
                    document.getElementById('matchaSizeModal').style.display = 'none';
                }
            
                function addMatchaToCart() {
                    const size = document.getElementById('matcha-size').value;
                    window.location.href = `cart3.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/refresh drink.jpg') }}" class="card-img-top" alt="Refresh Drink" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Refresh Drink</h5>
                        <p class="card-text">Cool, fruity, and revitalizing — the perfect thirst quencher.</p>
                        <p class="fw-bold">PHP 110.00</p>
                        
                        <button class="btn btn-primary" onclick="showRefreshSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="refreshSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="refresh-size" class="form-select mb-2">
                    <option value="small">Tall</option>
                    <option value="medium" selected>Grande</option>
                    <option value="large">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addRefreshToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeRefreshModal()">Cancel</button>
            </div>
            
            <script>
                function showRefreshSizeSelection() {
                    document.getElementById('refreshSizeModal').style.display = 'block';
                }
            
                function closeRefreshModal() {
                    document.getElementById('refreshSizeModal').style.display = 'none';
                }
            
                function addRefreshToCart() {
                    const size = document.getElementById('refresh-size').value;
                    window.location.href = `cart4.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/stawberry biscoff.jpg') }}" class="card-img-top" alt="Strawberry Biscoff" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Caramel Frappee</h5>
                        <p class="card-text">Sweet strawberry blended with a buttery cookie twist.</p>
                        <p class="fw-bold">PHP 189.00</p>
                        
                        <button class="btn btn-primary" onclick="showCaramelSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="caramelSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="caramel-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addCaramelToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeCaramelModal()">Cancel</button>
            </div>
            
            <script>
                function showCaramelSizeSelection() {
                    document.getElementById('caramelSizeModal').style.display = 'block';
                }
            
                function closeCaramelModal() {
                    document.getElementById('caramelSizeModal').style.display = 'none';
                }
            
                function addCaramelToCart() {
                    const size = document.getElementById('caramel-size').value;
                    window.location.href = `cart5.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/strawberry jam.jpg') }}" class="card-img-top" alt="Strawberry Jam" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Strawberry Jam</h5>
                        <p class="card-text">Sweet, tangy strawberry goodness in every sip.</p>
                        <p class="fw-bold">PHP 179.00</p>
                        
                        <button class="btn btn-primary" onclick="showStrawberryJamSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="strawberryJamSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="strawberry-jam-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addStrawberryJamToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeStrawberryJamModal()">Cancel</button>
            </div>
            
            <script>
                function showStrawberryJamSizeSelection() {
                    document.getElementById('strawberryJamSizeModal').style.display = 'block';
                }
            
                function closeStrawberryJamModal() {
                    document.getElementById('strawberryJamSizeModal').style.display = 'none';
                }
            
                function addStrawberryJamToCart() {
                    const size = document.getElementById('strawberry-jam-size').value;
                    window.location.href = `cart6.html?size=${size}`;
                }
            </script>
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/espresso.jpg') }}" class="card-img-top" alt="Iced Espresso" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Iced Espresso</h5>
                        <p class="card-text">Chilled espresso served over ice — bold and refreshing.</p>
                        <p class="fw-bold">PHP 119.00</p>
                        
                        <button class="btn btn-primary" onclick="showEspressoSizeSelection()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="espressoSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="iced-espresso-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addEspressoToCart()">Confirm</button>
                <button class="btn btn-danger" onclick="closeEspressoModal()">Cancel</button>
            </div>
            
            <script>
                function showEspressoSizeSelection() {
                    document.getElementById('espressoSizeModal').style.display = 'block';
                }
            
                function closeEspressoModal() {
                    document.getElementById('espressoSizeModal').style.display = 'none';
                }
            
                function addEspressoToCart() {
                    const size = document.getElementById('iced-espresso-size').value;
                    window.location.href = `cart7.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/machiatto.jpg') }}" class="card-img-top" alt="Caramel Macchiato" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Caramel Macchiato</h5>
                        <p class="card-text">Espresso, steamed milk, vanilla, and caramel drizzle.</p>
                        <p class="fw-bold">PHP 129.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionMacchiato()">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div id="macchiatoSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="caramel-macchiato-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addToCartMacchiato()">Confirm</button>
                <button class="btn btn-danger" onclick="closeMacchiatoModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionMacchiato() {
                    document.getElementById('macchiatoSizeModal').style.display = 'block';
                }
            
                function closeMacchiatoModal() {
                    document.getElementById('macchiatoSizeModal').style.display = 'none';
                }
            
                function addToCartMacchiato() {
                    const size = document.getElementById('caramel-macchiato-size').value;
                    window.location.href = `cart8.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/blueberry.jpg') }}" class="card-img-top" alt="Blueberry Frappee" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Blueberry Frappee</h5>
                        <p class="card-text">Creamy, blended drink with blueberries, ice, and milk.</p>
                        <p class="fw-bold">PHP 189.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionBlueberry()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="blueberrySizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="blueberry-frappee-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addToCartBlueberry()">Confirm</button>
                <button class="btn btn-danger" onclick="closeBlueberryModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionBlueberry() {
                    document.getElementById('blueberrySizeModal').style.display = 'block';
                }
            
                function closeBlueberryModal() {
                    document.getElementById('blueberrySizeModal').style.display = 'none';
                }
            
                function addToCartBlueberry() {
                    const size = document.getElementById('blueberry-frappee-size').value;
                    window.location.href = `cart9.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/matcha.jpg') }}" class="card-img-top" alt="Matcha Latte" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Matcha Latte</h5>
                        <p class="card-text">Smooth, earthy matcha blended with steamed milk.</p>
                        <p class="fw-bold">PHP 129.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionMatcha()">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div id="matchaSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="matcha-latte-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addToCartMatcha()">Confirm</button>
                <button class="btn btn-danger" onclick="closeMatchaModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionMatcha() {
                    document.getElementById('matchaSizeModal').style.display = 'block';
                }
            
                function closeMatchaModal() {
                    document.getElementById('matchaSizeModal').style.display = 'none';
                }
            
                function addToCartMatcha() {
                    const size = document.getElementById('matcha-latte-size').value;
                    window.location.href = `cart10.html?size=${size}`;
                }
            </script>
            
            
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('site/images/coffeejelly.jpg') }}" class="card-img-top" alt="Java Chip with Coffee Jelly" width="100%" height="500px">
                    <div class="card-body">
                        <h5 class="card-title">Java Chip with Coffee Jelly</h5>
                        <p class="card-text">Blended coffee, chocolate chips, and coffee jelly for a rich, chewy treat.</p>
                        <p class="fw-bold">PHP 189.00</p>
                        
                        <button class="btn btn-primary" onclick="showSizeSelectionJavaChip()">Add to Cart</button>
                    </div>
                </div>
            </div>
        
            <div id="javaChipSizeModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; box-shadow:0 4px 8px rgba(0,0,0,0.2); border-radius:10px; z-index:10;">
                <h5>Select a Size</h5>
                <select id="javachip-coffeejelly-size" class="form-select mb-2">
                    <option value="tall">Tall</option>
                    <option value="grande" selected>Grande</option>
                    <option value="venti">Venti</option>
                </select>
                <button class="btn btn-success" onclick="addToCartJavaChip()">Confirm</button>
                <button class="btn btn-danger" onclick="closeJavaChipModal()">Cancel</button>
            </div>
            
            <script>
                function showSizeSelectionJavaChip() {
                    document.getElementById('javaChipSizeModal').style.display = 'block';
                }
            
                function closeJavaChipModal() {
                    document.getElementById('javaChipSizeModal').style.display = 'none';
                }
            
                function addToCartJavaChip() {
                    const size = document.getElementById('javachip-coffeejelly-size').value;
                    window.location.href = `cart11.html?size=${size}`;
                }
            </script>
            <script src="{{ asset('site/assets/database-site.js') }}?v=4"></script>
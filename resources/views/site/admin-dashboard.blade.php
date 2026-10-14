<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <title>Admin Dashboard - Zild Cafe</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --ink: #222820;
      --muted: #73786f;
      --line: #e4e7df;
      --paper: #fff;
      --canvas: #f4f6f1;
      --forest: #244c3e;
      --forest-light: #e8f0eb;
      --copper: #a95f40;
      --amber: #f4ead4;
      --danger: #9d3d36;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
      background: var(--canvas);
    }

    * { box-sizing: border-box; }
    body { min-height: 100vh; margin: 0; background: var(--canvas); }
    button, input, select { font: inherit; }
    button, a, select { -webkit-tap-highlight-color: transparent; }

    .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 248px minmax(0, 1fr); }
    .sidebar { display: flex; flex-direction: column; padding: 27px 18px; background: #203d33; color: white; }
    .brand { display: flex; align-items: center; gap: 11px; padding: 0 10px 31px; color: white; text-decoration: none; }
    .brand-mark { display: grid; width: 39px; height: 39px; place-items: center; border-radius: 50%; background: #d8a06e; color: #32271f; }
    .brand-name { font: 700 21px/1 'Playfair Display', serif; }
    .side-label { margin: 7px 10px 11px; color: #afc0b7; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .side-nav { display: grid; gap: 5px; }
    .side-nav a, .side-bottom a { display: flex; align-items: center; gap: 12px; min-height: 43px; padding: 0 12px; border-radius: 4px; color: #d7e0da; font-size: 14px; text-decoration: none; }
    .side-nav a:hover, .side-nav a.active { background: #355a4c; color: white; }
    .side-nav i { width: 17px; text-align: center; }
    .side-bottom { display: grid; gap: 5px; margin-top: auto; border-top: 1px solid #476357; padding-top: 19px; }
    .side-bottom a:hover { background: #355a4c; color: white; }

    .main { min-width: 0; }
    .topbar { display: flex; align-items: center; justify-content: space-between; gap: 20px; min-height: 76px; padding: 15px 34px; border-bottom: 1px solid var(--line); background: var(--paper); }
    .breadcrumb { color: var(--muted); font-size: 13px; }
    .top-actions { display: flex; align-items: center; gap: 12px; }
    .admin-name { color: #555d54; font-size: 13px; }
    .icon-button { display: inline-flex; align-items: center; justify-content: center; gap: 9px; min-height: 38px; padding: 0 12px; border: 1px solid var(--line); border-radius: 4px; background: white; color: var(--ink); cursor: pointer; }
    .icon-button { width: 40px; padding: 0; }
    .icon-button:hover { border-color: #9dad9f; background: #f8faf7; }
    .content { width: min(1320px, 100%); margin: 0 auto; padding: 30px 34px 50px; }
    .page-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 26px; }
    h1 { margin: 0; font: 700 31px/1.15 'Playfair Display', serif; }
    .page-heading p { margin: 7px 0 0; color: var(--muted); font-size: 14px; }
    .today { color: var(--muted); font-size: 13px; white-space: nowrap; }

    .stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 24px; border: 1px solid var(--line); background: var(--paper); }
    .stat { min-height: 127px; padding: 19px 20px; border-right: 1px solid var(--line); }
    .stat:last-child { border-right: 0; }
    .stat-label { color: var(--muted); font-size: 13px; }
    .stat-value { margin-top: 13px; font-size: 29px; font-weight: 700; line-height: 1; }
    .stat-note { margin-top: 9px; color: var(--muted); font-size: 12px; }
    .stat-icon { float: right; display: grid; width: 34px; height: 34px; place-items: center; border-radius: 4px; background: var(--forest-light); color: var(--forest); }
    .stat:nth-child(2) .stat-icon { background: var(--amber); color: #885c1b; }
    .stat:nth-child(3) .stat-icon { background: #f7e9e5; color: var(--copper); }

    .attention { display: flex; flex-wrap: wrap; gap: 11px; margin-bottom: 28px; }
    .attention-item { display: flex; align-items: center; gap: 9px; min-height: 39px; padding: 0 12px; border: 1px solid var(--line); background: #fff; color: #51574f; font-size: 13px; }
    .attention-item strong { color: var(--ink); }
    .attention-item i { color: var(--copper); }

    .section-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 0 0 13px; }
    .section-head h2 { margin: 0; font-size: 18px; font-weight: 700; }
    .filters { display: flex; flex-wrap: wrap; gap: 8px; }
    .filter-input, .filter-select { min-height: 38px; padding: 0 11px; border: 1px solid var(--line); border-radius: 4px; background: #fff; color: var(--ink); font-size: 13px; }
    .filter-input { width: min(230px, 45vw); }
    .filter-select { min-width: 145px; }
    .orders-panel { overflow: hidden; border: 1px solid var(--line); background: var(--paper); }
    .menu-panel { overflow: hidden; border: 1px solid var(--line); background: var(--paper); }
    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th { padding: 12px 14px; border-bottom: 1px solid var(--line); background: #f8f9f6; color: var(--muted); font-size: 11px; font-weight: 700; text-transform: uppercase; white-space: nowrap; }
    td { padding: 13px 14px; border-bottom: 1px solid #edf0ea; font-size: 13px; vertical-align: middle; }
    tbody tr:last-child td { border-bottom: 0; }
    .order-number { color: var(--forest); font-weight: 700; }
    .customer-name { font-weight: 600; }
    .subtext { display: block; margin-top: 3px; color: var(--muted); font-size: 11px; }
    .status-select { min-height: 31px; padding: 0 7px; border: 1px solid var(--line); border-radius: 4px; background: #fff; color: var(--ink); font-size: 12px; }
    .order-actions { display: flex; gap: 6px; }
    .order-action { min-height: 31px; padding: 0 9px; border: 1px solid; border-radius: 4px; background: #fff; font-size: 12px; font-weight: 700; cursor: pointer; }
    .order-action.confirm { border-color: #b8d0c2; color: var(--forest); }
    .order-action.confirm:hover { background: var(--forest-light); }
    .order-action.reject { border-color: #e6c4bd; color: var(--danger); }
    .order-action.reject:hover { background: #fbefec; }
    .order-action:disabled { opacity: 0.55; cursor: wait; }
    .empty-state { padding: 30px; color: var(--muted); text-align: center; }
    .lower-grid { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(260px, 0.8fr); gap: 24px; margin-top: 30px; }
    .top-products { border-top: 1px solid var(--line); background: #fff; }
    .top-product { display: flex; align-items: center; gap: 12px; padding: 13px 15px; border-bottom: 1px solid var(--line); }
    .rank { display: grid; width: 26px; height: 26px; place-items: center; background: #f2eee6; color: #74553b; font-size: 12px; font-weight: 700; }
    .product-info { flex: 1; min-width: 0; }
    .product-info strong { display: block; overflow: hidden; font-size: 13px; text-overflow: ellipsis; white-space: nowrap; }
    .product-info span { color: var(--muted); font-size: 11px; }
    .product-revenue { font-size: 13px; font-weight: 700; white-space: nowrap; }
    .menu-product { display: flex; align-items: center; gap: 10px; min-width: 190px; }
    .menu-product img { width: 42px; height: 42px; border-radius: 3px; background: #eef0ec; object-fit: cover; }
    .menu-product strong { display: block; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .availability { display: inline-flex; align-items: center; gap: 6px; color: var(--forest); font-size: 12px; font-weight: 700; }
    .availability::before { width: 7px; height: 7px; border-radius: 50%; background: #4e8a69; content: ''; }
    .availability.off { color: var(--muted); }
    .availability.off::before { background: #9ba19a; }
    .availability-control { display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
    .availability-control input { width: 34px; height: 19px; margin: 0; accent-color: var(--forest); cursor: pointer; }
    .availability-control input:disabled { cursor: wait; opacity: .55; }
    .availability-control input:focus-visible { outline: 3px solid rgb(36 76 62 / 25%); outline-offset: 2px; }
    .menu-sizes { max-width: 250px; color: var(--muted); font-size: 12px; }
    .notice { padding: 17px; border-left: 3px solid var(--copper); background: #fff; color: #555b53; font-size: 13px; line-height: 1.6; }
    .notice strong { display: block; margin-bottom: 5px; color: var(--ink); }
    .notice a { color: var(--forest); font-weight: 700; }
    [data-admin-message] { margin: 0 0 18px; color: var(--muted); font-size: 13px; }
    .access-denied { margin: 12vh auto; max-width: 460px; padding: 32px; border: 1px solid var(--line); background: #fff; text-align: center; }
    .access-denied i { margin-bottom: 12px; color: var(--danger); font-size: 27px; }
    .access-denied h1 { font-size: 26px; }
    .access-denied p { color: var(--muted); }
    .access-denied a { color: var(--forest); font-weight: 700; }

    @media (max-width: 1050px) {
      .admin-shell { grid-template-columns: 210px minmax(0, 1fr); }
      .content { padding: 25px 22px 40px; }
      .topbar { padding-inline: 22px; }
      .stats { grid-template-columns: repeat(2, 1fr); }
      .stat:nth-child(2) { border-right: 0; }
      .stat:nth-child(-n+2) { border-bottom: 1px solid var(--line); }
    }

    @media (max-width: 720px) {
      .admin-shell { display: block; }
      .sidebar { padding: 13px 15px; }
      .brand { padding: 0 4px 12px; }
      .side-label, .side-bottom { display: none; }
      .side-nav { display: flex; overflow-x: auto; gap: 5px; }
      .side-nav a { flex: 0 0 auto; min-height: 38px; padding-inline: 10px; font-size: 12px; }
      .topbar { min-height: 59px; padding: 10px 15px; }
      .admin-name { display: none; }
      .content { padding: 22px 15px 35px; }
      .page-heading { align-items: flex-start; flex-direction: column; gap: 8px; }
      h1 { font-size: 27px; }
      .lower-grid { grid-template-columns: 1fr; gap: 20px; }
      .section-head { align-items: flex-start; flex-direction: column; }
      .filters { width: 100%; }
      .filter-input { flex: 1; width: auto; }
    }

    @media (max-width: 420px) {
      .stats { grid-template-columns: 1fr 1fr; }
      .stat { min-height: 112px; padding: 14px 12px; }
      .stat-value { font-size: 24px; }
      .stat-label { font-size: 12px; }
      .stat-icon { width: 29px; height: 29px; }
      .site-link { padding-inline: 9px; font-size: 12px; }
    }
  </style>
</head>
<body>
  <div class="admin-shell" data-admin-dashboard>
    <aside class="sidebar">
      <a class="brand" href="/admin/dashboard">
        <span class="brand-mark"><i class="fa-solid fa-mug-hot" aria-hidden="true"></i></span>
        <span class="brand-name">Zild Cafe</span>
      </a>
      <p class="side-label">Workspace</p>
      <nav class="side-nav" aria-label="Admin navigation">
        <a class="active" href="/admin/dashboard"><i class="fa-solid fa-chart-line" aria-hidden="true"></i> Overview</a>
        <a href="#orders"><i class="fa-solid fa-receipt" aria-hidden="true"></i> Orders</a>
        <a href="#menu"><i class="fa-solid fa-utensils" aria-hidden="true"></i> Menu</a>
      </nav>
      <div class="side-bottom">
        <a href="/admin/login" data-admin-sign-out><i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i> Sign Out</a>
      </div>
    </aside>

    <main class="main">
      <header class="topbar">
        <span class="breadcrumb">Administration <span aria-hidden="true">/</span> Overview</span>
        <div class="top-actions">
          <span class="admin-name" data-admin-name>Checking access…</span>
          <button class="icon-button" type="button" data-admin-refresh aria-label="Refresh dashboard" title="Refresh dashboard"><i class="fa-solid fa-rotate" aria-hidden="true"></i></button>
        </div>
      </header>

      <div class="content" data-admin-content>
        <section class="page-heading">
          <div>
            <h1>Dashboard</h1>
            <p>Today’s service and order activity at a glance.</p>
          </div>
          <time class="today" data-today></time>
        </section>

        <p data-admin-message role="status" aria-live="polite">Loading admin data…</p>

        <section class="stats" aria-label="Business summary">
          <article class="stat"><span class="stat-icon"><i class="fa-solid fa-receipt" aria-hidden="true"></i></span><div class="stat-label">Orders today</div><div class="stat-value" data-stat="orders_today">—</div><div class="stat-note">Not cancelled</div></article>
          <article class="stat"><span class="stat-icon"><i class="fa-solid fa-peso-sign" aria-hidden="true"></i></span><div class="stat-label">Revenue today</div><div class="stat-value" data-stat="revenue_today">—</div><div class="stat-note">Not cancelled</div></article>
          <article class="stat"><span class="stat-icon"><i class="fa-solid fa-hourglass-half" aria-hidden="true"></i></span><div class="stat-label">Pending orders</div><div class="stat-value" data-stat="pending_orders">—</div><div class="stat-note">Awaiting action</div></article>
          <article class="stat"><span class="stat-icon"><i class="fa-solid fa-mug-hot" aria-hidden="true"></i></span><div class="stat-label">Menu products</div><div class="stat-value" data-stat="products">—</div><div class="stat-note">Catalog total</div></article>
        </section>

        <div class="attention" aria-label="Items needing attention">
          <div class="attention-item"><i class="fa-regular fa-envelope" aria-hidden="true"></i><strong data-stat="unread_messages">—</strong> unread messages</div>
          <div class="attention-item"><i class="fa-regular fa-star" aria-hidden="true"></i><strong data-stat="reviews_waiting">—</strong> reviews to approve</div>
        </div>

        <section id="menu" class="admin-menu-section">
          <div class="section-head">
            <div>
              <h2>Menu catalog</h2>
              <span class="subtext" data-menu-count>Loading products…</span>
            </div>
            <form class="filters" data-menu-filters>
              <input class="filter-input" name="search" type="search" placeholder="Search menu" aria-label="Search menu products">
              <select class="filter-select" name="category" aria-label="Filter menu by category">
                <option value="">All categories</option>
                <option value="drinks">Drinks</option>
                <option value="snacks">Snacks</option>
              </select>
              <select class="filter-select" name="availability" aria-label="Filter menu by availability">
                <option value="">All items</option>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
              </select>
              <button class="icon-button" type="submit" aria-label="Apply menu filters" title="Apply filters"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
            </form>
          </div>
          <div class="menu-panel">
            <div class="table-scroll">
              <table>
                <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Sizes</th><th>Availability</th></tr></thead>
                <tbody data-menu-rows><tr><td colspan="5" class="empty-state">Loading menu…</td></tr></tbody>
              </table>
            </div>
          </div>
        </section>

        <section id="orders">
          <div class="section-head">
            <h2>Recent orders</h2>
            <form class="filters" data-order-filters>
              <input class="filter-input" name="search" type="search" placeholder="Order, customer, phone" aria-label="Search orders">
              <select class="filter-select" name="status" aria-label="Filter orders by status">
                <option value="">All statuses</option>
                <option value="pending">Pending</option>
                <option value="preparing">Preparing</option>
                <option value="out_for_delivery">Out for delivery</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
              <button class="icon-button" type="submit" aria-label="Apply order filters" title="Apply filters"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
            </form>
          </div>
          <div class="orders-panel">
            <div class="table-scroll">
              <table>
                <thead><tr><th>Order</th><th>Customer</th><th>Placed</th><th>Total</th><th>Payment</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody data-order-rows><tr><td colspan="7" class="empty-state">Loading orders…</td></tr></tbody>
              </table>
            </div>
          </div>
        </section>

        <div class="lower-grid">
          <section>
            <div class="section-head"><h2>Top products</h2></div>
            <div class="top-products" data-top-products><p class="empty-state">Loading product activity…</p></div>
          </section>
          <aside class="notice">
            <strong>Revenue all time</strong>
            <span class="stat-value" data-stat="revenue_total">—</span>
            <span class="subtext">Total from non-cancelled orders</span>
          </aside>
        </div>
      </div>

      <section class="access-denied" data-admin-denied hidden>
        <i class="fa-solid fa-lock" aria-hidden="true"></i>
        <h1>Admin access required</h1>
        <p>Sign in with an administrator account to view this dashboard.</p>
        <a href="/admin/login?next=%2Fadmin%2Fdashboard">Go to admin sign in</a>
      </section>
    </main>
  </div>
  <script src="{{ asset('site/assets/admin-dashboard.js') }}?v=4"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <title>My Account - Zild Cafe</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root { --ink: #292820; --muted: #77756d; --line: #e5e1d8; --paper: #fff; --canvas: #f5f3ee; --coffee: #59412d; --leaf: #42694e; font-family: 'DM Sans', sans-serif; }
    * { box-sizing: border-box; }
    body { min-height: 100vh; margin: 0; background: var(--canvas); color: var(--ink); }
    .account-topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; min-height: 72px; padding: 12px max(22px, calc((100vw - 1120px) / 2)); background: #171715; color: #fff; }
    .account-brand { display: flex; align-items: center; gap: 10px; color: #fff; font: 700 20px 'Playfair Display', serif; text-decoration: none; }
    .account-brand i { color: #d7a65c; }
    .top-actions { display: flex; gap: 9px; }
    .top-actions a, .top-actions button { display: inline-flex; min-height: 38px; align-items: center; gap: 8px; padding: 0 12px; border: 1px solid rgb(255 255 255 / 25%); border-radius: 4px; background: transparent; color: #fff; font: 600 13px 'DM Sans', sans-serif; text-decoration: none; cursor: pointer; }
    .top-actions a:hover, .top-actions button:hover { background: rgb(255 255 255 / 10%); }
    main { width: min(1040px, calc(100% - 36px)); margin: 38px auto 70px; }
    .heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 23px; }
    .eyebrow { margin: 0 0 7px; color: #9a7148; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    h1 { margin: 0; font: 700 34px/1.12 'Playfair Display', serif; }
    .heading p { margin: 8px 0 0; color: var(--muted); font-size: 14px; }
    .account-grid { display: grid; grid-template-columns: minmax(250px, .75fr) minmax(0, 1.5fr); gap: 20px; align-items: start; }
    .panel { border: 1px solid var(--line); background: var(--paper); }
    .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 17px 19px; border-bottom: 1px solid var(--line); }
    .panel-head h2 { margin: 0; font-size: 16px; font-weight: 700; }
    .profile { padding: 20px; }
    .profile-mark { display: grid; width: 54px; height: 54px; margin-bottom: 14px; place-items: center; border-radius: 50%; background: #eee4d5; color: var(--coffee); font-size: 19px; font-weight: 700; }
    .profile-name { margin: 0 0 4px; font: 700 22px 'Playfair Display', serif; }
    .profile-email { overflow-wrap: anywhere; color: var(--muted); font-size: 13px; }
    .profile-details { display: grid; gap: 0; margin: 20px 0 0; }
    .profile-row { display: flex; justify-content: space-between; gap: 14px; padding: 12px 0; border-top: 1px solid #eeece6; font-size: 13px; }
    .profile-row dt { color: var(--muted); }
    .profile-row dd { margin: 0; font-weight: 600; text-align: right; overflow-wrap: anywhere; }
    .credits { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 17px; padding: 14px; background: #f3f5ef; }
    .credits span { color: #5b655a; font-size: 12px; }
    .credits strong { color: var(--leaf); font-size: 18px; }
    .orders-table { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th { padding: 11px 14px; background: #f8f7f3; color: var(--muted); font-size: 10px; text-transform: uppercase; white-space: nowrap; }
    td { padding: 13px 14px; border-top: 1px solid #eeece6; font-size: 13px; white-space: nowrap; }
    .order-ref { color: var(--coffee); font-weight: 700; }
    .order-status { display: inline-block; padding: 4px 7px; border-radius: 3px; background: #f3eee5; color: #66523a; font-size: 11px; font-weight: 700; }
    .empty { padding: 35px 20px; color: var(--muted); text-align: center; font-size: 13px; }
    [data-account-message] { min-height: 20px; margin: 0 0 12px; color: var(--muted); font-size: 13px; }
    @media (max-width: 700px) {
      .account-topbar { min-height: 60px; padding: 10px 16px; }
      .top-actions a span { display: none; }
      main { width: min(100% - 28px, 520px); margin-top: 25px; }
      .heading { align-items: flex-start; flex-direction: column; }
      h1 { font-size: 29px; }
      .account-grid { grid-template-columns: 1fr; gap: 14px; }
      .panel-head, .profile { padding-inline: 15px; }
      th, td { padding-inline: 11px; }
    }
  </style>
</head>
<body>
  <header class="account-topbar">
    <a class="account-brand" href="/index.html"><i class="fa-solid fa-mug-hot" aria-hidden="true"></i> Zild Cafe</a>
    <div class="top-actions">
      <a href="/men.html" aria-label="Browse menu"><i class="fa-solid fa-utensils" aria-hidden="true"></i><span>Menu</span></a>
      <button type="button" data-account-sign-out aria-label="Sign out"><i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i><span>Sign out</span></button>
    </div>
  </header>
  <main data-account-page>
    <section class="heading">
      <div>
        <p class="eyebrow">Customer account</p>
        <h1>My account</h1>
        <p>Profile details and order history.</p>
      </div>
    </section>
    <p data-account-message role="status" aria-live="polite">Loading account…</p>
    <div class="account-grid">
      <section class="panel" aria-labelledby="profile-heading">
        <div class="panel-head"><h2 id="profile-heading">Profile</h2></div>
        <div class="profile">
          <div class="profile-mark" data-profile-initials aria-hidden="true">…</div>
          <h2 class="profile-name" data-profile-name>Loading…</h2>
          <div class="profile-email" data-profile-email></div>
          <dl class="profile-details">
            <div class="profile-row"><dt>Phone</dt><dd data-profile-phone>—</dd></div>
            <div class="profile-row"><dt>Delivery address</dt><dd data-profile-delivery-address>—</dd></div>
            <div class="profile-row"><dt>Member since</dt><dd data-profile-created>—</dd></div>
          </dl>
          <a class="btn btn-outline-secondary btn-sm mt-3" href="/delivery-location.html?next=%2Faccount.html">Set or change delivery location</a>
          <div class="credits"><span>Account credits</span><strong data-profile-credits>—</strong></div>
        </div>
      </section>
      <section class="panel" aria-labelledby="orders-heading">
        <div class="panel-head"><h2 id="orders-heading">My orders</h2></div>
        <div class="orders-table">
          <table>
            <thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr></thead>
            <tbody data-account-orders><tr><td colspan="4" class="empty">Loading orders…</td></tr></tbody>
          </table>
        </div>
      </section>
    </div>
  </main>
  <script src="{{ asset('site/assets/account-site.js') }}?v=3"></script>
</body>
</html>

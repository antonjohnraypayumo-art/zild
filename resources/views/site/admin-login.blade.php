<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <title>Admin Sign In - Zild Cafe</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --forest: #203d33;
      --forest-deep: #172e26;
      --copper: #bd8657;
      --paper: #f8f8f4;
      --ink: #242b25;
      --muted: #757d75;
      font-family: 'DM Sans', sans-serif;
    }

    * { box-sizing: border-box; }
    body { min-height: 100vh; margin: 0; display: grid; grid-template-columns: 1.1fr 0.9fr; background: var(--paper); color: var(--ink); }
    .staff-panel { position: relative; display: flex; min-height: 100vh; flex-direction: column; justify-content: space-between; overflow: hidden; padding: 32px clamp(28px, 6vw, 86px); background: var(--forest); color: #fff; }
    .staff-brand { display: flex; align-items: center; gap: 12px; color: white; font: 700 22px 'Playfair Display', serif; text-decoration: none; }
    .staff-brand i { display: grid; width: 42px; height: 42px; place-items: center; border-radius: 50%; background: var(--copper); color: #2e241c; font-size: 17px; }
    .staff-copy { max-width: 570px; margin: 40px 0 10vh; }
    .staff-copy .eyebrow { color: #d4ac87; font-size: 12px; font-weight: 700; text-transform: uppercase; }
    .staff-copy h1 { margin: 15px 0; font: 700 clamp(40px, 5vw, 66px)/1.04 'Playfair Display', serif; }
    .staff-copy p { max-width: 430px; color: #d3ddd6; font-size: 16px; line-height: 1.7; }
    .staff-meta { color: #a9b9b0; font-size: 12px; }

    .form-side { display: flex; min-height: 100vh; flex-direction: column; justify-content: space-between; padding: 32px clamp(26px, 6vw, 82px) 24px; }
    .form-footer a { color: var(--forest); font-weight: 700; text-decoration: none; }
    .form-footer a:hover { text-decoration: underline; }
    .form-wrap { width: 100%; max-width: 400px; margin: 48px auto; animation: settle 380ms ease-out both; }
    .form-eyebrow { margin: 0 0 10px; color: #a76543; font-size: 12px; font-weight: 700; text-transform: uppercase; }
    h2 { margin: 0 0 10px; font: 700 35px/1.15 'Playfair Display', serif; }
    .form-intro { margin: 0 0 29px; color: var(--muted); font-size: 14px; line-height: 1.6; }
    label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; }
    input { width: 100%; min-height: 49px; padding: 0 13px; border: 1px solid #d9ded8; border-radius: 4px; background: white; color: var(--ink); font: inherit; }
    input:focus { border-color: var(--forest); outline: 3px solid rgb(32 61 51 / 13%); }
    .field { margin-bottom: 19px; }
    .submit { width: 100%; min-height: 49px; margin-top: 7px; border: 0; border-radius: 4px; background: var(--forest); color: white; font: 700 14px 'DM Sans', sans-serif; cursor: pointer; }
    .submit:hover { background: var(--forest-deep); }
    .submit:disabled { cursor: wait; opacity: 0.7; }
    [data-admin-login-status] { min-height: 21px; margin: 14px 0 0; color: #a13b32; font-size: 13px; }
    .form-footer { color: var(--muted); font-size: 12px; text-align: center; }

    @keyframes settle { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 760px) {
      body { display: block; }
      .staff-panel { min-height: 0; padding: 19px 22px 24px; }
      .staff-copy { margin: 36px 0 0; }
      .staff-copy h1 { font-size: 35px; }
      .staff-copy p { margin-bottom: 0; font-size: 14px; }
      .staff-meta { display: none; }
      .form-side { min-height: 62vh; padding: 22px; }
      .form-wrap { margin: 34px auto; }
      h2 { font-size: 30px; }
    }
  </style>
</head>
<body>
  <aside class="staff-panel">
    <a class="staff-brand" href="/admin/login"><i class="fa-solid fa-mug-hot" aria-hidden="true"></i><span>Zild Cafe</span></a>
    <div class="staff-copy">
      <p class="eyebrow">Staff portal</p>
      <h1>Good service starts behind the counter.</h1>
      <p>Manage incoming orders and keep today’s cafe service moving.</p>
    </div>
    <span class="staff-meta">Zild Cafe administration</span>
  </aside>
  <main class="form-side">
    <section class="form-wrap" aria-labelledby="admin-login-title">
      <p class="form-eyebrow">Administrator access</p>
      <h2 id="admin-login-title">Sign in to admin</h2>
      <p class="form-intro">Use your administrator account to open the order desk.</p>
      <form data-admin-login-form novalidate>
        <div class="field">
          <label for="admin-email">Admin email</label>
          <input id="admin-email" name="email" type="email" autocomplete="username" required>
        </div>
        <div class="field">
          <label for="admin-password">Password</label>
          <input id="admin-password" name="password" type="password" autocomplete="current-password" required>
        </div>
        <button class="submit" type="submit">Sign In to Admin</button>
        <p data-admin-login-status role="status" aria-live="polite"></p>
      </form>
    </section>
    <footer class="form-footer">Zild Cafe · Authorized staff only</footer>
  </main>
  <script src="{{ asset('site/assets/admin-auth.js') }}?v=1"></script>
</body>
</html>

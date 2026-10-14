<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In - Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      color-scheme: light;
      --coffee: #543927;
      --caramel: #bb8252;
      --cream: #f7f1e8;
      --ink: #28241f;
    }

    * { box-sizing: border-box; }

    body {
      min-height: 100vh;
      margin: 0;
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(360px, 0.9fr);
      background: var(--cream);
      color: var(--ink);
      font-family: 'DM Sans', sans-serif;
    }

    .login-image {
      position: relative;
      min-height: 100vh;
      overflow: hidden;
      background: #33271f url("{{ asset('site/images/background zild.jpg') }}") center / cover no-repeat;
    }

    .login-image::after {
      position: absolute;
      inset: 0;
      content: '';
      background: linear-gradient(180deg, rgb(25 20 17 / 8%), rgb(25 20 17 / 72%));
    }

    .brand-story {
      position: absolute;
      z-index: 1;
      right: clamp(28px, 7vw, 100px);
      bottom: clamp(38px, 8vh, 90px);
      left: clamp(28px, 7vw, 100px);
      color: #fff;
    }

    .brand-story img {
      width: 58px;
      height: 58px;
      margin-bottom: 22px;
      border: 2px solid rgb(255 255 255 / 75%);
      border-radius: 50%;
      object-fit: cover;
    }

    .brand-story h1 {
      max-width: 580px;
      margin: 0 0 12px;
      font: 700 clamp(36px, 5vw, 64px)/1.05 'Playfair Display', serif;
    }

    .brand-story p {
      max-width: 420px;
      margin: 0;
      color: #f0e6dc;
      font-size: 17px;
    }

    .login-side {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-width: 0;
      padding: 34px clamp(28px, 6vw, 88px) 26px;
    }

    .login-top {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      color: #62594f;
      font-size: 14px;
    }

    .login-footer a, .login-switch button { color: var(--coffee); font-weight: 700; }
    .login-switch { margin: 19px 0 0; color: #71675c; font-size: 14px; text-align: center; }
    .login-switch button { border: 0; padding: 0; background: none; font: inherit; cursor: pointer; }

    .login-form-wrap {
      width: 100%;
      max-width: 420px;
      margin: 45px auto;
      animation: arrive 450ms ease-out both;
    }

    .eyebrow {
      margin-bottom: 12px;
      color: var(--caramel);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1.8px;
      text-transform: uppercase;
    }

    h2 {
      margin-bottom: 9px;
      font: 700 38px/1.15 'Playfair Display', serif;
    }

    .intro { margin-bottom: 32px; color: #71675c; }

    .form-label { margin-bottom: 8px; font-size: 14px; font-weight: 700; }

    .form-control {
      min-height: 50px;
      border: 1px solid #ddd2c4;
      border-radius: 4px;
      background: #fffdf9;
    }

    .form-control:focus {
      border-color: var(--caramel);
      box-shadow: 0 0 0 3px rgb(187 130 82 / 16%);
    }

    .btn-sign-in {
      min-height: 50px;
      border: 0;
      border-radius: 4px;
      background: var(--coffee);
      color: white;
      font-weight: 700;
    }

    .btn-sign-in:hover, .btn-sign-in:focus { background: #3e2a1e; color: #fff; }
    .btn-sign-in:disabled { background: #887361; }
    .login-footer { color: #82786c; font-size: 13px; text-align: center; }

    @keyframes arrive {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 800px) {
      body { display: block; }
      .login-image { min-height: 32vh; }
      .brand-story { right: 24px; bottom: 24px; left: 24px; }
      .brand-story img { display: none; }
      .brand-story h1 { font-size: 34px; }
      .brand-story p { font-size: 14px; }
      .login-side { min-height: 68vh; padding: 24px; }
      .login-form-wrap { margin: 38px auto; }
    }
  </style>
</head>
<body>
  <aside class="login-image" aria-label="Zild Cafe">
    <div class="brand-story">
      <img src="{{ asset('site/images/zild coffee.jpg') }}" alt="">
      <h1>Zild Cafe</h1>
      <p>Coffee that hits the right notes.</p>
    </div>
  </aside>
  <main class="login-side">
    <section class="login-form-wrap">
      <div data-login-panel aria-labelledby="login-title">
        <p class="eyebrow">Welcome back</p>
        <h2 id="login-title">Sign in to your account</h2>
        <p class="intro">Use your Zild Cafe account to continue.</p>
      <form data-login-form novalidate>
        <div class="mb-3">
          <label class="form-label" for="login-email">Email address</label>
          <input class="form-control" id="login-email" name="email" type="email" autocomplete="username" required>
        </div>
        <div class="mb-4">
          <label class="form-label" for="login-password">Password</label>
          <input class="form-control" id="login-password" name="password" type="password" autocomplete="current-password" required>
        </div>
        <button class="btn btn-sign-in w-100" type="submit">Sign In</button>
        <p class="mt-3 mb-0" data-login-status role="status" aria-live="polite"></p>
      </form>
      <p class="login-switch">New to Zild Cafe? <button type="button" data-show-register>Create an account</button></p>
      </div>
      <div data-register-panel aria-labelledby="register-title" hidden>
        <p class="eyebrow">Join the cafe</p>
        <h2 id="register-title">Create your account</h2>
        <p class="intro">Save your details and keep your orders together.</p>
        <form data-register-form novalidate>
          <div class="mb-3">
            <label class="form-label" for="register-name">Full name</label>
            <input class="form-control" id="register-name" name="name" type="text" autocomplete="name" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="register-email">Email address</label>
            <input class="form-control" id="register-email" name="email" type="email" autocomplete="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="register-phone">Phone number</label>
            <input class="form-control" id="register-phone" name="phone" type="tel" autocomplete="tel" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="register-password">Password</label>
            <input class="form-control" id="register-password" name="password" type="password" autocomplete="new-password" minlength="8" required>
          </div>
          <div class="mb-4">
            <label class="form-label" for="register-password-confirmation">Confirm password</label>
            <input class="form-control" id="register-password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
          </div>
          <button class="btn btn-sign-in w-100" type="submit">Create Account</button>
          <p class="mt-3 mb-0" data-register-status role="status" aria-live="polite"></p>
        </form>
        <p class="mt-4 mb-0">Already have an account? <button type="button" data-show-login>Sign in</button></p>
      </div>
    </section>
    <footer class="login-footer"><a href="/index.html">Zild Cafe</a> <span aria-hidden="true">·</span> <a href="/contact.html">Contact</a></footer>
  </main>
  <script src="{{ asset('site/assets/auth-site.js') }}?v=4"></script>
</body>
</html>
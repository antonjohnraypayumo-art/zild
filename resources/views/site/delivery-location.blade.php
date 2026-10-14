<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delivery Location - Zild Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <style>
    :root { font-family: 'DM Sans', sans-serif; color: #282820; background: #f5f3ee; }
    body { min-height: 100vh; margin: 0; background: #f5f3ee; }
    .location-card { width: min(620px, calc(100% - 28px)); margin: 48px auto; padding: clamp(22px, 5vw, 42px); border: 1px solid #e5e1d8; background: #fff; }
    h1 { margin: 0; font: 700 30px/1.15 'Playfair Display', serif; }
    .intro { margin: 9px 0 25px; color: #77756d; font-size: 14px; }
    #saved-delivery-map { height: 350px; border: 1px solid #ddd; border-radius: 5px; z-index: 0; }
    .form-control { min-height: 46px; }
    [data-location-form-status] { min-height: 22px; color: #625d53; font-size: 13px; }
  </style>
</head>
<body>
  <main class="location-card" data-delivery-location-page>
    <p class="text-uppercase fw-bold small mb-2" style="color:#9a7148">Delivery details</p>
    <h1>Where should we deliver?</h1>
    <p class="intro">Save your address and pinpoint your delivery location. You can update it any time before placing an order.</p>
    <form data-delivery-location-form>
      <label class="form-label fw-semibold" for="saved-delivery-address">Delivery address</label>
      <input class="form-control mb-3" id="saved-delivery-address" name="delivery_address" type="text" placeholder="House/street, barangay, city/municipality" autocomplete="street-address" maxlength="1000" required>
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
        <label class="form-label fw-semibold mb-0" for="saved-delivery-map">Pin your location</label>
        <button class="btn btn-outline-secondary btn-sm" type="button" data-use-saved-current-location>Use my current location</button>
      </div>
      <div id="saved-delivery-map" aria-label="Map for selecting your saved delivery location"></div>
      <p class="small text-muted mt-2 mb-0" data-saved-location-status role="status" aria-live="polite">Tap the map or drag the pin to your exact delivery point.</p>
      <input type="hidden" name="delivery_latitude">
      <input type="hidden" name="delivery_longitude">
      <p class="mt-3 mb-2" data-location-form-status role="status" aria-live="polite"></p>
      <div class="d-flex flex-wrap gap-2">
        <button class="btn btn-success px-4" type="submit">Save location and continue</button>
        <a class="btn btn-outline-secondary px-4" href="/cart.html">Back to cart</a>
      </div>
    </form>
  </main>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="{{ asset('site/assets/delivery-location.js') }}?v=1"></script>
</body>
</html>

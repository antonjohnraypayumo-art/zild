(() => {
  const page = document.querySelector('[data-delivery-location-page]');
  if (!page) return;

  const form = page.querySelector('[data-delivery-location-form]');
  const addressField = form.elements.namedItem('delivery_address');
  const latitudeField = form.elements.namedItem('delivery_latitude');
  const longitudeField = form.elements.namedItem('delivery_longitude');
  const status = page.querySelector('[data-location-form-status]');
  const pinStatus = page.querySelector('[data-saved-location-status]');
  const saveButton = form.querySelector('[type="submit"]');
  const tokenKey = 'zild_auth_token';
  const token = localStorage.getItem(tokenKey);
  const search = new URLSearchParams(window.location.search);
  const requestedNext = search.get('next') || '/checkout.html';
  const next = requestedNext.startsWith('/') && !requestedNext.startsWith('//')
    ? requestedNext
    : '/checkout.html';

  if (!token) {
    const setupUrl = `/delivery-location.html?next=${encodeURIComponent(next)}`;
    window.location.replace(`/login.html?next=${encodeURIComponent(setupUrl)}`);
    return;
  }

  const request = async (url, options = {}) => {
    const response = await fetch(url, {
      ...options,
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${token}`,
        ...(options.headers || {}),
      },
    });
    const result = await response.json().catch(() => ({}));
    if (!response.ok) {
      const validation = Object.values(result.errors || {}).flat()[0];
      throw Object.assign(new Error(validation || result.message || `Request failed (${response.status})`), { status: response.status });
    }
    return result;
  };

  if (typeof L === 'undefined') {
    pinStatus.textContent = 'The map could not be loaded. Refresh the page to try again.';
    saveButton.disabled = true;
    return;
  }

  const map = L.map('saved-delivery-map').setView([15.36837, 120.61267], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 19,
  }).addTo(map);

  let pin = null;
  let accountLoaded = false;
  const validPin = () => latitudeField.value !== '' && longitudeField.value !== ''
    && Number.isFinite(Number(latitudeField.value)) && Number.isFinite(Number(longitudeField.value))
    && Math.abs(Number(latitudeField.value)) <= 90 && Math.abs(Number(longitudeField.value)) <= 180;

  const updateReadiness = () => {
    saveButton.disabled = !accountLoaded || !addressField.value.trim() || !validPin();
  };

  const setPin = (latitude, longitude) => {
    latitudeField.value = latitude;
    longitudeField.value = longitude;
    if (!pin) {
      pin = L.marker([latitude, longitude], { draggable: true }).addTo(map);
      pin.on('dragend', () => {
        const point = pin.getLatLng();
        latitudeField.value = point.lat;
        longitudeField.value = point.lng;
        pinStatus.textContent = `Pin set at ${point.lat.toFixed(6)}, ${point.lng.toFixed(6)}.`;
        updateReadiness();
      });
    } else {
      pin.setLatLng([latitude, longitude]);
    }
    pinStatus.textContent = `Pin set at ${latitude.toFixed(6)}, ${longitude.toFixed(6)}.`;
    updateReadiness();
  };

  map.on('click', ({ latlng }) => setPin(latlng.lat, latlng.lng));
  addressField.addEventListener('input', updateReadiness);

  page.querySelector('[data-use-saved-current-location]').addEventListener('click', () => {
    if (!navigator.geolocation) {
      pinStatus.textContent = 'Location sharing is unavailable. Tap the map to set your pin.';
      return;
    }
    const button = page.querySelector('[data-use-saved-current-location]');
    button.disabled = true;
    pinStatus.textContent = 'Getting your location…';
    navigator.geolocation.getCurrentPosition(
      ({ coords }) => {
        setPin(coords.latitude, coords.longitude);
        map.setView([coords.latitude, coords.longitude], 17);
        button.disabled = false;
      },
      (error) => {
        const messages = {
          1: 'Location permission was denied. Allow access or tap the map to set your pin.',
          2: 'Your location could not be determined. Try again or tap the map.',
          3: 'Getting your location timed out. Try again or tap the map.',
        };
        pinStatus.textContent = messages[error.code] || 'Could not get your location. Tap the map to set your pin.';
        button.disabled = false;
      },
      { enableHighAccuracy: true, timeout: 15000, maximumAge: 60000 },
    );
  });

  request('/api/me')
    .then((user) => {
      if (user.role !== 'customer') {
        window.location.replace('/index.html');
        return;
      }
      addressField.value = user.delivery_address || '';
      if (user.delivery_latitude !== null && user.delivery_longitude !== null) {
        const latitude = Number(user.delivery_latitude);
        const longitude = Number(user.delivery_longitude);
        if (Number.isFinite(latitude) && Number.isFinite(longitude)
          && Math.abs(latitude) <= 90 && Math.abs(longitude) <= 180) {
          setPin(latitude, longitude);
          map.setView([latitude, longitude], 17);
        }
      }
      accountLoaded = true;
      updateReadiness();
    })
    .catch((error) => {
      if (error.status === 401) {
        localStorage.removeItem(tokenKey);
        window.location.replace(`/login.html?next=${encodeURIComponent(window.location.pathname + window.location.search)}`);
        return;
      }
      status.textContent = error.message;
    });

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (!accountLoaded || !addressField.value.trim() || !validPin()) {
      status.textContent = 'Enter your address and set a pin on the map before continuing.';
      updateReadiness();
      return;
    }

    saveButton.disabled = true;
    status.textContent = 'Saving your delivery location…';
    try {
      await request('/api/me/delivery-location', {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          delivery_address: addressField.value.trim(),
          delivery_latitude: latitudeField.value,
          delivery_longitude: longitudeField.value,
        }),
      });
      window.location.assign(next);
    } catch (error) {
      status.textContent = error.message;
      updateReadiness();
    }
  });
})();

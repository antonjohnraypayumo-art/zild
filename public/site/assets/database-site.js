(() => {
  if (!window.zildAuthScriptLoaded) {
    window.zildAuthScriptLoaded = true;
    const authScript = document.createElement('script');
    authScript.src = '/site/assets/auth-site.js?v=5';
    document.body.appendChild(authScript);
  }

  const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (character) => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
  })[character]);

  const money = (value) => new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
  }).format(Number(value) || 0);

  const request = async (url, options = {}) => {
    const { headers = {}, ...requestOptions } = options;
    const authToken = localStorage.getItem('zild_auth_token');
    const response = await fetch(url, {
      ...requestOptions,
      headers: {
        Accept: 'application/json',
        ...(authToken ? { Authorization: `Bearer ${authToken}` } : {}),
        ...headers,
      },
    });

    if (!response.ok) {
      const body = await response.json().catch(() => ({}));
      throw Object.assign(new Error(body.message || `Request failed (${response.status})`), { status: response.status, body });
    }

    return response;
  };

  const menu = document.querySelector('[data-database-menu]');
  const searchResults = document.querySelector('[data-menu-search-results]');
  const searchSection = document.querySelector('[data-menu-search-section]');
  const emptySearch = document.querySelector('[data-menu-search-empty]');
  const searchForm = document.querySelector('[data-menu-search]');

  const renderProducts = (products) => products.map((product) => {
    const sizes = product.sizes || [];
    const image = product.image_url || '/site/images/fries.avif';
    const sizeOptions = sizes.map((size) => `
      <option value="${escapeHtml(size.id)}" data-modifier="${escapeHtml(size.price_modifier)}" ${size.is_default ? 'selected' : ''}>
        ${escapeHtml(size.name)}
      </option>`).join('');

    return `
      <div class="col">
        <article class="card h-100">
          <img src="${escapeHtml(image)}" class="card-img-top" alt="${escapeHtml(product.name)}" style="height:250px;object-fit:cover">
          <div class="card-body d-flex flex-column">
            <h2 class="card-title h5">${escapeHtml(product.name)}</h2>
            <p class="card-text">${escapeHtml(product.description || '')}</p>
            <p class="fw-bold mt-auto" data-product-price="${escapeHtml(product.price)}">${money(product.price)}</p>
            ${sizes.length ? `<label class="form-label">Size<select class="form-select mb-2" data-product-size>${sizeOptions}</select></label>` : ''}
            <button class="btn btn-primary" type="button" data-add-product="${escapeHtml(product.id)}">Add to Cart</button>
            <p class="small mt-2 mb-0" role="status" aria-live="polite"></p>
          </div>
        </article>
      </div>`;
  }).join('') || '<p class="col-12 text-center">No menu items match your search.</p>';

  const loadMenuProducts = async (target, term, category) => {
    const params = new URLSearchParams();
    if (term) params.set('q', term);
    if (category) params.set('category', category);
    target.innerHTML = '<p class="col-12 text-center">Searching menu…</p>';

    try {
      const response = await request(`/api/products?${params.toString()}`);
      const products = await response.json();
      target.innerHTML = renderProducts(products);
      if (emptySearch) emptySearch.hidden = products.length > 0;
    } catch (error) {
      target.innerHTML = `<p class="col-12 text-center">${escapeHtml(error.message)}</p>`;
    }
  };

  const productGrids = [menu, searchResults].filter(Boolean);
  productGrids.forEach((grid) => {
    grid.addEventListener('change', (event) => {
      const select = event.target.closest('[data-product-size]');
      if (!select) return;

      const price = select.closest('.card-body').querySelector('[data-product-price]');
      const modifier = Number(select.selectedOptions[0]?.dataset.modifier || 0);
      price.textContent = money(Number(price.dataset.productPrice) + modifier);
    });

    grid.addEventListener('click', async (event) => {
      const button = event.target.closest('[data-add-product]');
      if (!button) return;

      const card = button.closest('.card-body');
      const status = card.querySelector('[role="status"]');
      const size = card.querySelector('[data-product-size]');

      if (!localStorage.getItem('zild_auth_token')) {
        localStorage.setItem('zild_pending_cart_item', JSON.stringify({
          product_id: Number(button.dataset.addProduct),
          product_size_id: size ? Number(size.value) : null,
          quantity: 1,
        }));
        window.location.assign('/login.html?next=%2Fcart.html');
        return;
      }

      button.disabled = true;
      status.textContent = 'Adding…';

      try {
        let token = localStorage.getItem('zild_cart_token');
        const response = await request('/api/cart/items', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            ...(token ? { 'X-Cart-Token': token } : {}),
          },
          body: JSON.stringify({
            product_id: Number(button.dataset.addProduct),
            product_size_id: size ? Number(size.value) : null,
            quantity: 1,
          }),
        });
        token = response.headers.get('X-Cart-Token') || (await response.clone().json()).token;
        if (token) localStorage.setItem('zild_cart_token', token);
        status.innerHTML = 'Added to cart. <a href="/cart.html">View cart</a>';
      } catch (error) {
        if (error.status === 401) {
          localStorage.removeItem('zild_auth_token');
          localStorage.setItem('zild_pending_cart_item', JSON.stringify({
            product_id: Number(button.dataset.addProduct),
            product_size_id: size ? Number(size.value) : null,
            quantity: 1,
          }));
          window.location.assign('/login.html?next=%2Fcart.html');
          return;
        }
        status.textContent = error.message;
      } finally {
        button.disabled = false;
      }
    });
  });

  if (menu) {
    const term = new URLSearchParams(window.location.search).get('q') || '';
    if (searchForm) searchForm.querySelector('input[type="search"]').value = term;
    loadMenuProducts(menu, term, menu.dataset.databaseMenu);
  }

  if (searchForm) {
    searchForm.addEventListener('submit', (event) => {
      event.preventDefault();
      const term = searchForm.querySelector('input[type="search"]').value.trim();

      if (menu) {
        loadMenuProducts(menu, term, menu.dataset.databaseMenu);
        return;
      }

      if (searchResults && searchSection) {
        searchSection.hidden = false;
        emptySearch.hidden = true;
        loadMenuProducts(searchResults, term, '');
      }
    });
  }

  const blogFeed = document.querySelector('[data-database-blog]');
  if (blogFeed) {
    const selectedPost = new URLSearchParams(window.location.search).get('post');
    const blogRequest = selectedPost
      ? request(`/api/blog/${encodeURIComponent(selectedPost)}`).then((response) => response.json()).then((post) => [post])
      : request('/api/blog').then((response) => response.json());

    blogRequest.then((posts) => {
      blogFeed.innerHTML = posts.map((post) => `
        <div class="col-md-4 mb-4">
          <article class="card h-100">
            <img src="${escapeHtml(post.image_url || '/site/images/coffeejelly.jpg')}" class="card-img-top" alt="${escapeHtml(post.title)}" style="height:250px;object-fit:cover">
            <div class="card-body">
              <h2 class="card-title h5">${escapeHtml(post.title)}</h2>
              ${selectedPost ? `<div class="card-text">${post.content || ''}</div>` : `<p class="card-text">${escapeHtml(post.excerpt || '')}</p><a class="btn btn-custom" href="/blog.html?post=${encodeURIComponent(post.slug)}">Read More</a>`}
            </div>
          </article>
        </div>`).join('') || '<p class="col-12">No published posts yet.</p>';
    }).catch((error) => console.error('Could not load blog posts from the database:', error));
  }

  const teamFeed = document.querySelector('[data-database-team]');
  if (teamFeed) {
    request('/api/team')
      .then((response) => response.json())
      .then((members) => {
        teamFeed.innerHTML = members.map((member, index) => `
          <div class="slide${index === 0 ? ' active' : ''}">
            <img src="${escapeHtml(member.photo_url || '/site/images/chris2.jpg')}" alt="${escapeHtml(member.name)}">
            <h3>${escapeHtml(member.name)}</h3>
            <p>${escapeHtml(member.position)}</p>
            <p class="text-start">${escapeHtml(member.bio || '')}</p>
          </div>`).join('');
      }).catch((error) => console.error('Could not load team members from the database:', error));
  }

  const reviewFeed = document.querySelector('[data-database-reviews]');
  if (reviewFeed) {
    request('/api/reviews')
      .then((response) => response.json())
      .then((reviews) => {
        reviewFeed.innerHTML = reviews.slice(0, 6).map((review) => `
          <div class="col-md-6">
            <article class="review-card">
              <img src="${escapeHtml(review.image_url || '/site/images/review1.jpg')}" alt="" class="review-image">
              <div class="review-content">
                <h3>${escapeHtml(review.customer_name)}</h3>
                <div class="star-rating" aria-label="${escapeHtml(review.rating)} out of 5 stars">${'★'.repeat(Math.max(0, Math.min(5, Number(review.rating))))}${'☆'.repeat(5 - Math.max(0, Math.min(5, Number(review.rating))))}</div>
                <p>“${escapeHtml(review.comment)}”</p>
              </div>
            </article>
          </div>`).join('') || '<p class="col-12 text-center">Be the first to leave a review.</p>';
      }).catch((error) => console.error('Could not load reviews from the database:', error));
  }

  const cartFeed = document.querySelector('[data-database-cart]');
  if (cartFeed) {
    const cartTotal = document.querySelector('[data-cart-total]');
    const loadCart = async () => {
      const token = localStorage.getItem('zild_cart_token');
      const response = await request('/api/cart', {
        headers: token ? { 'X-Cart-Token': token } : {},
      });
      const cart = await response.json();
      if (cart.token) localStorage.setItem('zild_cart_token', cart.token);
      cartFeed.innerHTML = cart.items.length ? cart.items.map((item) => `
        <tr>
          <td><img src="${escapeHtml(item.image_url || '')}" alt="" width="56" height="56" style="object-fit:cover"> ${escapeHtml(item.name)}${item.size ? ` <small>(${escapeHtml(item.size)})</small>` : ''}</td>
          <td>${money(item.unit_price)}</td>
          <td><input type="number" min="1" max="50" value="${escapeHtml(item.quantity)}" class="form-control" style="max-width:90px" data-cart-quantity="${escapeHtml(item.id)}" aria-label="Quantity for ${escapeHtml(item.name)}"></td>
          <td>${money(item.line_total)}</td>
          <td><button class="btn btn-danger btn-sm" type="button" data-cart-remove="${escapeHtml(item.id)}">Remove</button></td>
        </tr>`).join('') : '<tr><td colspan="5" class="text-center">Your cart is empty.</td></tr>';
      cartTotal.textContent = `Total: ${money(cart.total)}`;
    };

    loadCart().catch((error) => {
      cartFeed.innerHTML = `<tr><td colspan="5" class="text-center">${escapeHtml(error.message)}</td></tr>`;
    });

    cartFeed.addEventListener('change', async (event) => {
      const input = event.target.closest('[data-cart-quantity]');
      if (!input) return;
      const token = localStorage.getItem('zild_cart_token');
      try {
        await request(`/api/cart/items/${input.dataset.cartQuantity}`, {
          method: 'PATCH',
          headers: { 'Content-Type': 'application/json', ...(token ? { 'X-Cart-Token': token } : {}) },
          body: JSON.stringify({ quantity: Number(input.value) }),
        });
        await loadCart();
      } catch (error) {
        window.alert(error.message);
        await loadCart();
      }
    });

    cartFeed.addEventListener('click', async (event) => {
      const button = event.target.closest('[data-cart-remove]');
      if (!button) return;
      const token = localStorage.getItem('zild_cart_token');
      try {
        await request(`/api/cart/items/${button.dataset.cartRemove}`, {
          method: 'DELETE',
          headers: token ? { 'X-Cart-Token': token } : {},
        });
        await loadCart();
      } catch (error) {
        window.alert(error.message);
      }
    });
  }

  const checkout = document.querySelector('[data-database-checkout]');
  if (checkout) {
    const accountSummary = checkout.parentElement.querySelector('[data-checkout-account]');
    const submitButton = checkout.querySelector('[type="submit"]');
    const addressDisplay = checkout.querySelector('[data-checkout-address]');
    const requirements = checkout.querySelector('[data-checkout-requirements]');
    const locationStatus = checkout.querySelector('[data-checkout-location-status]');
    const token = localStorage.getItem('zild_auth_token');
    const locationSetupUrl = `/delivery-location.html?next=${encodeURIComponent('/checkout.html')}`;
    if (!token) {
      window.location.replace(`/login.html?next=${encodeURIComponent(locationSetupUrl)}`);
      return;
    }

    let savedLocationLoaded = false;

    const updateCheckoutReadiness = () => {
      submitButton.disabled = !savedLocationLoaded;
      requirements.textContent = savedLocationLoaded
        ? 'Your saved delivery location will be used. Change it from Manage account.'
        : 'Checking your saved delivery location…';
    };

    request('/api/me')
      .then((response) => response.json())
      .then((user) => {
        checkout.parentElement.querySelector('[data-checkout-customer]').textContent = user.name;
        checkout.parentElement.querySelector('[data-checkout-phone]').textContent = user.phone || 'No phone number on this account';
        if (user.role !== 'customer') {
          window.location.replace('/index.html');
          return;
        }
        if (!user.delivery_address || user.delivery_latitude === null || user.delivery_longitude === null) {
          window.location.replace(locationSetupUrl);
          return;
        }
        addressDisplay.textContent = user.delivery_address;
        savedLocationLoaded = true;
        locationStatus.textContent = `Pinned delivery location: ${Number(user.delivery_latitude).toFixed(6)}, ${Number(user.delivery_longitude).toFixed(6)}.`;
        updateCheckoutReadiness();
      })
      .catch((error) => {
        if (error.status === 401) {
          window.location.replace(`/login.html?next=${encodeURIComponent(locationSetupUrl)}`);
          return;
        }
        checkout.querySelector('[data-checkout-status]').textContent = error.message;
        if (accountSummary) accountSummary.hidden = true;
      });

    updateCheckoutReadiness();

    checkout.addEventListener('submit', async (event) => {
      event.preventDefault();
      const button = checkout.querySelector('[type="submit"]');
      const status = checkout.querySelector('[data-checkout-status]');
      const token = localStorage.getItem('zild_cart_token');

      if (!localStorage.getItem('zild_auth_token')) {
        window.location.assign(`/login.html?next=${encodeURIComponent(locationSetupUrl)}`);
        return;
      }

      button.disabled = true;
      status.textContent = 'Submitting order…';

      try {
        const form = new FormData(checkout);
        const response = await request('/api/orders', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', ...(token ? { 'X-Cart-Token': token } : {}) },
          body: JSON.stringify({ payment_method: form.get('payment_method') }),
        });
        const order = await response.json();
        window.location.assign(`/placeorder.html?order=${encodeURIComponent(order.order_number)}`);
      } catch (error) {
        if (error.status === 401) {
          localStorage.removeItem('zild_auth_token');
          window.location.assign(`/login.html?next=${encodeURIComponent(locationSetupUrl)}`);
          return;
        }
        status.textContent = error.message;
        button.disabled = false;
      }
    });
  }

  const confirmation = document.querySelector('[data-order-confirmation]');
  if (confirmation) {
    const orderNumber = new URLSearchParams(window.location.search).get('order');
    if (orderNumber) confirmation.textContent = `Order ${orderNumber} has been placed successfully and is now being prepared.`;
  }
})();
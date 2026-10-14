(() => {
  const root = document.querySelector('[data-admin-dashboard]');
  if (!root) return;

  const tokenKey = 'zild_admin_auth_token';
  const token = localStorage.getItem(tokenKey);
  const content = root.querySelector('[data-admin-content]');
  const denied = root.querySelector('[data-admin-denied]');
  const name = root.querySelector('[data-admin-name]');
  const message = root.querySelector('[data-admin-message]');
  const orderRows = root.querySelector('[data-order-rows]');
  const filterForm = root.querySelector('[data-order-filters]');
  const menuRows = root.querySelector('[data-menu-rows]');
  const menuFilterForm = root.querySelector('[data-menu-filters]');
  const menuCount = root.querySelector('[data-menu-count]');
  const statusLabels = {
    pending: 'Pending',
    preparing: 'Preparing',
    out_for_delivery: 'Out for delivery',
    completed: 'Completed',
    cancelled: 'Cancelled',
  };
  const statusTransitions = {
    pending: ['preparing', 'cancelled'],
    preparing: ['out_for_delivery', 'cancelled'],
    out_for_delivery: ['completed', 'cancelled'],
    completed: [],
    cancelled: [],
  };

  const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (character) => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
  })[character]);

  const currency = (value) => new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    maximumFractionDigits: 2,
  }).format(Number(value) || 0);

  const api = async (url, options = {}) => {
    const { headers = {}, ...requestOptions } = options;
    const response = await fetch(url, {
      ...requestOptions,
      headers: { Accept: 'application/json', Authorization: `Bearer ${token}`, ...headers },
    });
    const payload = await response.json().catch(() => null);
    if (!response.ok) throw Object.assign(new Error(payload?.message || `Request failed (${response.status})`), { status: response.status });
    return payload;
  };

  const showDenied = () => {
    content.hidden = true;
    denied.hidden = false;
  };

  const signIn = () => window.location.replace('/admin/login?next=%2Fadmin%2Fdashboard');

  const renderOrders = (orders) => {
    orderRows.innerHTML = orders.length ? orders.map((order) => `
      <tr>
        <td><span class="order-number">${escapeHtml(order.order_number)}</span><span class="subtext">${order.items?.length || 0} items</span></td>
        <td><span class="customer-name">${escapeHtml(order.customer_name)}</span><span class="subtext">${escapeHtml(order.phone)}</span></td>
        <td>${escapeHtml(new Date(order.created_at).toLocaleString([], { dateStyle: 'medium', timeStyle: 'short' }))}</td>
        <td>${currency(order.total)}</td>
        <td>${escapeHtml(order.payment_method)}<span class="subtext">${escapeHtml(order.payment_status)}</span></td>
        <td><select class="status-select" data-order-status="${escapeHtml(order.id)}" aria-label="Status for ${escapeHtml(order.order_number)}" ${statusTransitions[order.status]?.length ? '' : 'disabled'}>${[order.status, ...(statusTransitions[order.status] || [])].map((value) => `<option value="${value}" ${order.status === value ? 'selected' : ''}>${statusLabels[value]}</option>`).join('')}</select></td>
        <td>${order.status === 'pending' ? `<div class="order-actions"><button class="order-action confirm" type="button" data-order-action="${escapeHtml(order.id)}" data-status="preparing" aria-label="Confirm order ${escapeHtml(order.order_number)}">Confirm</button><button class="order-action reject" type="button" data-order-action="${escapeHtml(order.id)}" data-status="cancelled" aria-label="Reject order ${escapeHtml(order.order_number)}">Reject</button></div>` : '<span class="subtext">—</span>'}</td>
      </tr>`).join('') : '<tr><td colspan="7" class="empty-state">No orders match this filter.</td></tr>';
  };

  const loadMenu = async () => {
    const values = new FormData(menuFilterForm);
    const query = new URLSearchParams();
    const category = values.get('category');
    const search = values.get('search')?.trim();
    if (search) query.set('q', search);

    menuRows.innerHTML = '<tr><td colspan="5" class="empty-state">Loading menu…</td></tr>';
    try {
      const result = await api(`/api/admin/products?${query.toString()}`);
      const availability = values.get('availability');
      const products = (result.data || []).filter((product) => {
        if (category && product.category?.slug !== category) return false;
        if (availability === 'available') return product.is_available;
        if (availability === 'unavailable') return !product.is_available;
        return true;
      });

      menuCount.textContent = `${products.length} ${products.length === 1 ? 'product' : 'products'}`;
      menuRows.innerHTML = products.length ? products.map((product) => `
        <tr>
          <td><div class="menu-product"><img src="${escapeHtml(product.image_url || '')}" alt="" loading="lazy"><div><strong>${escapeHtml(product.name)}</strong><span class="subtext">${escapeHtml(product.description || '')}</span></div></div></td>
          <td>${escapeHtml(product.category?.name || 'Uncategorized')}</td>
          <td>${currency(product.price)}</td>
          <td><span class="menu-sizes">${(product.sizes || []).map((size) => escapeHtml(size.name)).join(', ') || 'Standard'}</span></td>
          <td><label class="availability-control"><input type="checkbox" role="switch" data-product-availability="${escapeHtml(product.id)}" aria-label="Make ${escapeHtml(product.name)} available" ${product.is_available ? 'checked' : ''}><span class="availability${product.is_available ? '' : ' off'}">${product.is_available ? 'Available' : 'Unavailable'}</span></label></td>
        </tr>`).join('') : '<tr><td colspan="5" class="empty-state">No menu items match these filters.</td></tr>';
    } catch (error) {
      if (error.status === 401 || error.status === 403) showDenied();
      menuCount.textContent = 'Menu unavailable';
      menuRows.innerHTML = `<tr><td colspan="5" class="empty-state">${escapeHtml(error.message)}</td></tr>`;
    }
  };

  const loadOrders = async () => {
    const values = new FormData(filterForm);
    const query = new URLSearchParams();
    if (values.get('search')) query.set('search', values.get('search').trim());
    if (values.get('status')) query.set('status', values.get('status'));
    orderRows.innerHTML = '<tr><td colspan="7" class="empty-state">Loading orders…</td></tr>';
    try {
      const result = await api(`/api/admin/orders?${query.toString()}`);
      renderOrders(result.data || []);
    } catch (error) {
      if (error.status === 401 || error.status === 403) showDenied();
      orderRows.innerHTML = `<tr><td colspan="7" class="empty-state">${escapeHtml(error.message)}</td></tr>`;
    }
  };

  const loadDashboard = async () => {
    message.textContent = 'Refreshing dashboard…';
    try {
      const stats = await api('/api/admin/dashboard');
      Object.entries(stats).forEach(([key, value]) => {
        const target = root.querySelector(`[data-stat="${key}"]`);
        if (target) target.textContent = key.startsWith('revenue_') ? currency(value) : new Intl.NumberFormat().format(Number(value) || 0);
      });

      const products = root.querySelector('[data-top-products]');
      products.innerHTML = stats.top_products?.length ? stats.top_products.map((product, index) => `
        <div class="top-product">
          <span class="rank">${index + 1}</span>
          <div class="product-info"><strong>${escapeHtml(product.product_name)}</strong><span>${escapeHtml(product.units)} units sold</span></div>
          <span class="product-revenue">${currency(product.revenue)}</span>
        </div>`).join('') : '<p class="empty-state">Sales activity will appear here.</p>';

      message.textContent = 'Dashboard is up to date.';
      await Promise.all([loadOrders(), loadMenu()]);
    } catch (error) {
      if (error.status === 401) {
        localStorage.removeItem(tokenKey);
        localStorage.removeItem('zild_admin_user');
        signIn();
        return;
      }
      if (error.status === 403) {
        showDenied();
        name.textContent = 'Restricted';
        message.textContent = 'This account does not have administrator access.';
        return;
      }
      message.textContent = error.message;
    }
  };

  root.querySelector('[data-today]').textContent = new Intl.DateTimeFormat(undefined, {
    weekday: 'long', month: 'long', day: 'numeric', year: 'numeric',
  }).format(new Date());

  root.querySelector('[data-admin-refresh]').addEventListener('click', loadDashboard);
  filterForm.addEventListener('submit', (event) => {
    event.preventDefault();
    loadOrders();
  });
  filterForm.elements.status.addEventListener('change', loadOrders);
  menuFilterForm.addEventListener('submit', (event) => {
    event.preventDefault();
    loadMenu();
  });
  menuFilterForm.elements.category.addEventListener('change', loadMenu);
  menuFilterForm.elements.availability.addEventListener('change', loadMenu);

  menuRows.addEventListener('change', async (event) => {
    const toggle = event.target.closest('[data-product-availability]');
    if (!toggle) return;

    const previousValue = !toggle.checked;
    toggle.disabled = true;
    message.textContent = 'Updating menu availability…';

    try {
      await api(`/api/admin/products/${toggle.dataset.productAvailability}`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ is_available: toggle.checked }),
      });
      message.textContent = toggle.checked ? 'Menu item is now available.' : 'Menu item is now unavailable.';
      await loadMenu();
    } catch (error) {
      toggle.checked = previousValue;
      message.textContent = error.message;
    } finally {
      toggle.disabled = false;
    }
  });

  const updateOrderStatus = async (orderId, status, control) => {
    if (status === 'cancelled' && !window.confirm('Reject and cancel this order?')) return;
    if (control) control.disabled = true;
    message.textContent = 'Saving order status…';
    try {
      await api(`/api/admin/orders/${orderId}`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ status }),
      });
      message.textContent = status === 'preparing' ? 'Order confirmed and moved to preparing.' : 'Order status saved.';
      await loadDashboard();
    } catch (error) {
      message.textContent = error.message;
      await loadOrders();
    } finally {
      if (control) control.disabled = false;
    }
  };

  orderRows.addEventListener('change', async (event) => {
    const select = event.target.closest('[data-order-status]');
    if (!select) return;
    await updateOrderStatus(select.dataset.orderStatus, select.value, select);
  });

  orderRows.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-order-action]');
    if (!button) return;
    await updateOrderStatus(button.dataset.orderAction, button.dataset.status, button);
  });

  root.querySelector('[data-admin-sign-out]').addEventListener('click', async (event) => {
    event.preventDefault();
    try {
      await api('/api/logout', { method: 'POST' });
    } finally {
      localStorage.removeItem(tokenKey);
      localStorage.removeItem('zild_admin_user');
      signIn();
    }
  });

  if (!token) {
    signIn();
    return;
  }

  api('/api/me')
    .then((user) => {
      if (user.role !== 'admin') {
        name.textContent = 'Restricted';
        message.textContent = 'This account does not have administrator access.';
        showDenied();
        return;
      }
      name.textContent = user.name;
      return loadDashboard();
    })
    .catch((error) => {
      if (error.status === 401) {
        localStorage.removeItem(tokenKey);
        localStorage.removeItem('zild_admin_user');
        signIn();
        return;
      }
      message.textContent = error.message;
      showDenied();
    });
})();

(() => {
  const page = document.querySelector('[data-account-page]');
  if (!page) return;

  const tokenKey = 'zild_auth_token';
  const token = localStorage.getItem(tokenKey);
  const message = page.querySelector('[data-account-message]');
  const ordersTable = page.querySelector('[data-account-orders]');

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
  }).format(Number(value) || 0);

  const signIn = () => window.location.replace('/login.html?next=%2Faccount.html');
  if (!token) {
    signIn();
    return;
  }

  const api = async (url) => {
    const response = await fetch(url, {
      headers: { Accept: 'application/json', Authorization: `Bearer ${token}` },
    });
    const result = await response.json().catch(() => ({}));
    if (!response.ok) throw Object.assign(new Error(result.message || 'Unable to load your account.'), { status: response.status });
    return result;
  };

  Promise.all([api('/api/me'), api('/api/my-orders')])
    .then(([user, orders]) => {
      if (user.role !== 'customer') {
        window.location.replace(user.role === 'admin' ? '/admin/dashboard' : '/index.html');
        return;
      }

      const initials = user.name.trim().split(/\s+/).slice(0, 2).map((part) => part[0]).join('').toUpperCase();
      page.querySelector('[data-profile-initials]').textContent = initials;
      page.querySelector('[data-profile-name]').textContent = user.name;
      page.querySelector('[data-profile-email]').textContent = user.email;
      page.querySelector('[data-profile-phone]').textContent = user.phone || 'Not provided';
      page.querySelector('[data-profile-delivery-address]').textContent = user.delivery_address || 'Not set';
      page.querySelector('[data-profile-created]').textContent = user.created_at
        ? new Intl.DateTimeFormat(undefined, { month: 'short', year: 'numeric' }).format(new Date(user.created_at))
        : '—';
      page.querySelector('[data-profile-credits]').textContent = currency(user.credits);

      const records = orders.data || [];
      ordersTable.innerHTML = records.length ? records.map((order) => `
        <tr>
          <td><span class="order-ref">${escapeHtml(order.order_number)}</span><span class="subtext">${order.items?.length || 0} items</span></td>
          <td>${escapeHtml(new Intl.DateTimeFormat(undefined, { dateStyle: 'medium' }).format(new Date(order.created_at)))}</td>
          <td>${currency(order.total)}</td>
          <td><span class="order-status">${escapeHtml(order.status.replaceAll('_', ' '))}</span></td>
        </tr>`).join('') : '<tr><td colspan="4" class="empty">No orders yet. Your orders will appear here.</td></tr>';
      message.textContent = '';
    })
    .catch((error) => {
      if (error.status === 401) {
        localStorage.removeItem(tokenKey);
        localStorage.removeItem('zild_auth_user');
        signIn();
        return;
      }
      message.textContent = error.message;
      ordersTable.innerHTML = '<tr><td colspan="4" class="empty">Unable to load orders.</td></tr>';
    });

  document.querySelector('[data-account-sign-out]')?.addEventListener('click', async () => {
    try {
      await fetch('/api/logout', { method: 'POST', headers: { Accept: 'application/json', Authorization: `Bearer ${token}` } });
    } finally {
      localStorage.removeItem(tokenKey);
      localStorage.removeItem('zild_auth_user');
      window.location.assign('/login.html');
    }
  });
})();

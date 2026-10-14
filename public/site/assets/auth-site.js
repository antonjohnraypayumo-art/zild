(() => {
  const authTokenKey = 'zild_auth_token';
  const cartTokenKey = 'zild_cart_token';
  const loginForm = document.querySelector('[data-login-form]');
  const registerForm = document.querySelector('[data-register-form]');
  const menuPaths = ['/men.html', '/drinks.html', '/foods.html'];
  const showMenuSearch = menuPaths.includes(window.location.pathname.toLowerCase());

  document.querySelectorAll('.search-container').forEach((container) => {
    container.style.display = showMenuSearch ? '' : 'none';
  });

  const renderNavigation = (user = null) => {
    const navigation = document.querySelector('.navbar-nav');
    if (!navigation) return;

    navigation.querySelector('[data-auth-navigation]')?.remove();
    navigation.querySelector('[data-admin-navigation]')?.remove();
    const item = document.createElement('li');
    item.className = 'nav-item';
    item.dataset.authNavigation = '';

    if (!user) {
      item.innerHTML = '<a class="nav-link" href="/login.html"><i class="fas fa-user"></i> Sign In</a>';
    } else {
      if (user.role === 'admin') {
        const dashboardItem = document.createElement('li');
        dashboardItem.className = 'nav-item';
        dashboardItem.dataset.adminNavigation = '';
        dashboardItem.innerHTML = '<a class="nav-link" href="/admin/dashboard"><i class="fas fa-chart-line"></i> Admin</a>';
        navigation.append(dashboardItem);
      }

      const accountPath = user.role === 'admin' ? '/admin/dashboard' : '/account.html';
      const initials = user.name.trim().split(/\s+/).slice(0, 2).map((part) => part[0]).join('').toUpperCase();
      item.classList.add('site-account-item');
      const details = document.createElement('details');
      details.className = 'site-account-menu';

      const summary = document.createElement('summary');
      summary.setAttribute('aria-label', `Account menu for ${user.name}`);
      const avatar = document.createElement('span');
      avatar.className = 'site-account-avatar';
      avatar.setAttribute('aria-hidden', 'true');
      avatar.textContent = initials;
      const displayName = document.createElement('span');
      displayName.className = 'site-account-name';
      displayName.textContent = user.name;
      const chevron = document.createElement('i');
      chevron.className = 'fas fa-chevron-down site-account-chevron';
      chevron.setAttribute('aria-hidden', 'true');
      summary.append(avatar, displayName, chevron);

      const popover = document.createElement('div');
      popover.className = 'site-account-popover';
      const email = document.createElement('span');
      email.className = 'site-account-email';
      email.textContent = user.email;
      const accountLink = document.createElement('a');
      accountLink.href = accountPath;
      const accountIcon = document.createElement('i');
      accountIcon.className = `fas ${user.role === 'admin' ? 'fa-chart-line' : 'fa-user-gear'}`;
      accountIcon.setAttribute('aria-hidden', 'true');
      accountLink.append(accountIcon, document.createTextNode(user.role === 'admin' ? ' Admin dashboard' : ' Manage account'));
      const logout = document.createElement('button');
      logout.type = 'button';
      logout.dataset.accountSignOut = '';
      const logoutIcon = document.createElement('i');
      logoutIcon.className = 'fas fa-arrow-right-from-bracket';
      logoutIcon.setAttribute('aria-hidden', 'true');
      logout.append(logoutIcon, document.createTextNode(' Sign out'));
      popover.append(email, accountLink, logout);
      details.append(summary, popover);
      item.append(details);

      logout.addEventListener('click', async () => {
        const token = localStorage.getItem(authTokenKey);
        try {
          await fetch('/api/logout', { method: 'POST', headers: { Accept: 'application/json', Authorization: `Bearer ${token}` } });
        } finally {
          localStorage.removeItem(authTokenKey);
          localStorage.removeItem('zild_auth_user');
          renderNavigation();
        }
      });
    }

    navigation.append(item);
  };

  const savedToken = localStorage.getItem(authTokenKey);
  if (savedToken) {
    fetch('/api/me', { headers: { Accept: 'application/json', Authorization: `Bearer ${savedToken}` } })
      .then((response) => {
        if (!response.ok) throw new Error('Session expired');
        return response.json();
      })
      .then((user) => {
        localStorage.setItem('zild_auth_user', JSON.stringify(user));
        renderNavigation(user);
      })
      .catch(() => {
        localStorage.removeItem(authTokenKey);
        localStorage.removeItem('zild_auth_user');
        renderNavigation();
      });
  } else {
    renderNavigation();
  }

  const loginPanel = document.querySelector('[data-login-panel]');
  const registerPanel = document.querySelector('[data-register-panel]');
  document.querySelector('[data-show-register]')?.addEventListener('click', () => {
    loginPanel.hidden = true;
    registerPanel.hidden = false;
    registerForm.querySelector('[name="name"]').focus();
  });
  document.querySelector('[data-show-login]')?.addEventListener('click', () => {
    registerPanel.hidden = true;
    loginPanel.hidden = false;
    loginForm.querySelector('[name="email"]').focus();
  });

  if (!loginForm || !registerForm) return;

  const signInAndContinue = async (result) => {
    localStorage.setItem(authTokenKey, result.token);
    localStorage.setItem('zild_auth_user', JSON.stringify(result.user));
    const pendingCartItem = result.user.role === 'customer'
      ? localStorage.getItem('zild_pending_cart_item')
      : null;
    const next = new URLSearchParams(window.location.search).get('next');
    let redirectTo = next && next.startsWith('/') && !next.startsWith('//')
      ? next
      : (result.user.role === 'admin' ? '/admin/dashboard' : '/index.html');

    if (pendingCartItem) {
      const cartItem = JSON.parse(pendingCartItem);
      const cartToken = localStorage.getItem(cartTokenKey);
      const response = await fetch('/api/cart/items', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          Authorization: `Bearer ${result.token}`,
          ...(cartToken ? { 'X-Cart-Token': cartToken } : {}),
        },
        body: JSON.stringify(cartItem),
      });
      const body = await response.json();
      if (!response.ok) throw new Error(Object.values(body.errors || {}).flat()[0] || body.message || 'Could not add this item to your cart.');

      const returnedCartToken = response.headers.get('X-Cart-Token') || body.token;
      if (returnedCartToken) localStorage.setItem(cartTokenKey, returnedCartToken);
      localStorage.removeItem('zild_pending_cart_item');
      redirectTo = '/cart.html';
    }

    window.location.assign(redirectTo);
  };

  const responseError = (result, fallback) => Object.values(result.errors || {}).flat()[0]
    || result.message
    || fallback;

  const status = loginForm.querySelector('[data-login-status]');
  loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (!loginForm.reportValidity()) return;

    const button = loginForm.querySelector('[type="submit"]');
    button.disabled = true;
    status.className = 'mt-3 mb-0 text-secondary';
    status.textContent = 'Signing in…';

    try {
      const formData = new FormData(loginForm);
      const cartToken = localStorage.getItem(cartTokenKey);
      const response = await fetch('/api/customer/login', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          ...(cartToken ? { 'X-Cart-Token': cartToken } : {}),
        },
        body: JSON.stringify({ email: formData.get('email'), password: formData.get('password') }),
      });
      const result = await response.json();
      if (!response.ok) throw new Error(responseError(result, 'Unable to sign in. Check your email and password.'));
      await signInAndContinue(result);
    } catch (error) {
      status.className = 'mt-3 mb-0 text-danger';
      status.textContent = error.message;
      button.disabled = false;
    }
  });

  const registerStatus = registerForm.querySelector('[data-register-status]');
  registerForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (!registerForm.reportValidity()) return;

    const button = registerForm.querySelector('[type="submit"]');
    const formData = new FormData(registerForm);
    if (formData.get('password') !== formData.get('password_confirmation')) {
      registerStatus.className = 'mt-3 mb-0 text-danger';
      registerStatus.textContent = 'The passwords do not match.';
      return;
    }

    button.disabled = true;
    registerStatus.className = 'mt-3 mb-0 text-secondary';
    registerStatus.textContent = 'Creating your account…';

    try {
      const cartToken = localStorage.getItem(cartTokenKey);
      const response = await fetch('/api/register', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          ...(cartToken ? { 'X-Cart-Token': cartToken } : {}),
        },
        body: JSON.stringify({
          name: formData.get('name'),
          email: formData.get('email'),
          phone: formData.get('phone') || null,
          password: formData.get('password'),
          password_confirmation: formData.get('password_confirmation'),
        }),
      });
      const result = await response.json();
      if (!response.ok) throw new Error(responseError(result, 'Unable to create your account.'));
      await signInAndContinue(result);
    } catch (error) {
      registerStatus.className = 'mt-3 mb-0 text-danger';
      registerStatus.textContent = error.message;
      button.disabled = false;
    }
  });
})();
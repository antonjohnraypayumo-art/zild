(() => {
  const form = document.querySelector('[data-admin-login-form]');
  if (!form) return;

  const tokenKey = 'zild_admin_auth_token';
  const userKey = 'zild_admin_user';
  const status = form.querySelector('[data-admin-login-status]');
  const button = form.querySelector('[type="submit"]');

  const continueToDashboard = () => {
    const next = new URLSearchParams(window.location.search).get('next');
    const destination = next && next.startsWith('/') && !next.startsWith('//')
      ? next
      : '/admin/dashboard';
    window.location.assign(destination);
  };

  const savedToken = localStorage.getItem(tokenKey);
  if (savedToken) {
    fetch('/api/me', { headers: { Accept: 'application/json', Authorization: `Bearer ${savedToken}` } })
      .then((response) => {
        if (!response.ok) throw new Error('Expired admin session');
        return response.json();
      })
      .then((user) => {
        if (user.role !== 'admin') throw new Error('Invalid admin session');
        localStorage.setItem(userKey, JSON.stringify(user));
        continueToDashboard();
      })
      .catch(() => {
        localStorage.removeItem(tokenKey);
        localStorage.removeItem(userKey);
      });
  }

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (!form.reportValidity()) return;

    button.disabled = true;
    status.className = 'text-secondary';
    status.textContent = 'Checking administrator access…';

    try {
      const values = new FormData(form);
      const response = await fetch('/api/admin/login', {
        method: 'POST',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: values.get('email'), password: values.get('password') }),
      });
      const result = await response.json();
      if (!response.ok) {
        const validationMessage = Object.values(result.errors || {}).flat()[0];
        throw new Error(validationMessage || result.message || 'Unable to sign in to admin.');
      }

      localStorage.setItem(tokenKey, result.token);
      localStorage.setItem(userKey, JSON.stringify(result.user));
      continueToDashboard();
    } catch (error) {
      status.className = 'text-danger';
      status.textContent = error.message;
      button.disabled = false;
    }
  });
})();

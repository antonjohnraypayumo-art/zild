
const navbar = document.querySelector('.navbar');

if (navbar) {
  const updateNavbar = () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  };

  window.addEventListener('scroll', updateNavbar, { passive: true });
  updateNavbar();
}

if (!window.zildAuthScriptLoaded) {
  window.zildAuthScriptLoaded = true;
  const authScript = document.createElement('script');
  authScript.src = '/site/assets/auth-site.js?v=5';
  document.body.appendChild(authScript);
}
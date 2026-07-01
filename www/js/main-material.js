document.addEventListener("DOMContentLoaded", function () {
  // Fetch and inject navigation
  fetch('/_includes/nav-material.html')
    .then(response => response.text())
    .then(data => {
      const navbarPlaceholder = document.querySelector("#navbar-placeholder");
      if (navbarPlaceholder) {
        navbarPlaceholder.innerHTML = data;
        
        // Initialize Materialize Sidenav
        const sidenav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);

        // Navbar color change on scroll
        const navbar = document.querySelector('.navbar-fixed');
        if (navbar) {
          const nav = navbar.querySelector('nav');
          const handleNavbarTheme = () => {
            if (window.scrollY > 50 || !document.querySelector('#intro')) {
              nav.classList.add('blue-grey', 'darken-4');
            } else {
              nav.classList.remove('blue-grey', 'darken-4');
            }
          };
          handleNavbarTheme();
          window.addEventListener('scroll', handleNavbarTheme);
        }
      }
    });

  // Fetch and inject footer
  fetch('/_includes/footer-material.html')
    .then(response => response.text())
    .then(data => {
       const footerPlaceholder = document.querySelector("#footer-placeholder");
       if (footerPlaceholder) {
        footerPlaceholder.innerHTML = data;

        // Initialize Materialize Floating Action Button
        const fab = document.querySelectorAll('.fixed-action-btn');
        M.FloatingActionButton.init(fab);
       }
    });
});

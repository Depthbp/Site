document.addEventListener("DOMContentLoaded", function () {
  const style = document.createElement('style');
  style.textContent = `
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        #footer-placeholder {
            margin-top: auto;
        }
    `;
  document.head.appendChild(style);
  fetch('https://depth.kr/_includes/nav.html')
    .then(response => response.text())
    .then(data => {
      if (document.querySelector("#navbar-placeholder")) {
        document.querySelector("#navbar-placeholder").innerHTML = data;
        const navbar = document.querySelector('.navbar');
        if (navbar) {
          const handleNavbarTheme = () => {
            if (window.scrollY > 50 || !document.querySelector('#intro')) {
              navbar.classList.add('bg-dark');
            } else {
              navbar.classList.remove('bg-dark');
            }
          };
          handleNavbarTheme();
          window.addEventListener('scroll', handleNavbarTheme);
        }
      }
    });
  fetch('https://depth.kr/_includes/footer.html')
    .then(response => response.text())
    .then(data => {
      if (document.querySelector("#footer-placeholder")) {
        document.querySelector("#footer-placeholder").innerHTML = data;
      }
      const toTopBtn = document.getElementById('to-top');
      if (toTopBtn) {
        const handleToTopBtn = () => {
          if (window.scrollY > 100) {
            toTopBtn.classList.add('show');
          } else {
            toTopBtn.classList.remove('show');
          }
        };
        handleToTopBtn();
        window.addEventListener('scroll', handleToTopBtn);
        toTopBtn.addEventListener('click', (e) => {
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    });
  (function(c,l,a,r,i,t,y){
    c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
    t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
    y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
})(window, document, "clarity", "script", "uo1cjyp0g2");
});
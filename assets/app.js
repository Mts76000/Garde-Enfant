import './styles/app.scss';
import './styles/home.scss';
import './styles/register_choix.scss';
import './styles/user/success.scss';

console.log('ok home');


const burgerBtn = document.querySelector('.burger');
const closeBtn = document.querySelector('.close-burger');
const burgerMenu = document.querySelector('#burger-menu');

// Ajoutez un gestionnaire d'événements au clic sur le bouton
burgerBtn.addEventListener('click', (e) => {
     e.preventDefault();
     burgerMenu.classList.toggle('active');
});
closeBtn.addEventListener('click', (e) => {
     e.preventDefault();
     burgerMenu.classList.toggle('active');
});

document.addEventListener('DOMContentLoaded', function () {
     var btnTop = document.getElementById('btnTop');

     window.addEventListener('scroll', function () {
          if (window.pageYOffset > 100) {
               btnTop.style.display = 'block';
          } else {
               btnTop.style.display = 'none';
          }
     });

     btnTop.addEventListener('click', function () {
          window.scrollTo({
               top: 0,
               behavior: 'smooth'
          });
     });
});

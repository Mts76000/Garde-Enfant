import './styles/app.scss';
import './styles/home.scss';
import './styles/register_choix.scss';
import './styles/register.scss';
import './styles/user/success.scss';
import './styles/login.scss';

// pro
import './styles/pro/dashboard.scss';
import './styles/pro/message.scss';
import './styles/pro/detail.scss';
import './styles/pro/demande.scss';

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

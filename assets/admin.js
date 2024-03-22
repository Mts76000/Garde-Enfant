import './styles/app.scss';
import "./styles/form.scss";
import "./styles/bouton.scss";

import "./styles/user/listing-child.scss";


import "./styles/admin/message.scss";
import "./styles/admin/user.scss";
import "./styles/admin/singleC.scss";


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

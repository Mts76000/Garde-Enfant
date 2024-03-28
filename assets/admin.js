import './styles/app.scss';
import "./styles/form.scss";
import "./styles/bouton.scss";

import "./styles/user/listing-child.scss";


import "./styles/admin/message.scss";
import "./styles/admin/user.scss";
import "./styles/admin/singleC.scss";
import "./styles/user/stripe.scss";


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

// Gestion de Stripe

var stripe = Stripe('pk_test_51OyxKeP2itdtN1tGWeSug7qNNbEf60ZpH2g0trZPPj7FJ7N4tBTT8GBFH3oIiZCgCDlfi0VdAaAYRlnpjNf7nWU400vG6dIzhB');
var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

var form = document.getElementById('payment-form');
var cardButton = document.getElementById('card-button');
var clientSecret = cardButton.getAttribute('data-secret');

form.addEventListener('submit', function (event) {
     event.preventDefault();
     stripe.handleCardPayment(clientSecret, cardElement, {
          payment_method_data: {
               billing_details: {name: document.getElementById('cardholder-name').value}
          }
     }).then(function (result) {
          if (result.error) {
               var errorElement = document.getElementById('error-message');
               errorElement.textContent = result.error.message;
          } else {
               window.location.href = 'confirmation.html';
          }
     });
});

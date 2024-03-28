import "./styles/app.scss";
import "./styles/form.scss";
import "./styles/bouton.scss";

import "./styles/home.scss";
import "./styles/contact.scss";

// connexion / inscription
import "./styles/register.scss";
import "./styles/login.scss";

// pro
import "./styles/pro/dashboard.scss";
import "./styles/pro/message.scss";
import "./styles/pro/detail.scss";
import "./styles/pro/demande.scss";
import "./styles/pro/addCreche.scss";
import "./styles/pro/rdv.scss";
import "./styles/pro/proHeure.scss";


// user
import "./styles/user/rdv.scss";
import "./styles/user/success.scss";
import "./styles/user/index.scss";
import "./styles/user/addchild.scss";
import "./styles/user/recupChild.scss";
import "./styles/user/listing-child.scss";
import "./styles/user/stripe.scss";


console.log("ok home");

const burgerBtn = document.querySelector(".burger");
const closeBtn = document.querySelector(".close-burger");
const burgerMenu = document.querySelector("#burger-menu");

// Ajoutez un gestionnaire d'événements au clic sur le bouton
burgerBtn.addEventListener("click", (e) => {
    e.preventDefault();
    burgerMenu.classList.toggle("active");
});
closeBtn.addEventListener("click", (e) => {
    e.preventDefault();
    burgerMenu.classList.toggle("active");
});

document.addEventListener("DOMContentLoaded", function () {
    var btnTop = document.getElementById("btnTop");

    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 100) {
            btnTop.style.display = "block";
        } else {
            btnTop.style.display = "none";
        }
    });

    btnTop.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
});


const key = '9zRf1qxrmW59rxxc0lzr';
var map = L.map('map').setView([0, 0], 16); // Initialiser la carte avec une vue par défaut
L.tileLayer(`https://api.maptiler.com/maps/basic-v2-dark/{z}/{x}/{y}.png?key=${key}`).addTo(map); // Fond de carte OpenStreetMap

fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json`)
    .then(response => response.json())
    .then(data => {
        var latitude = parseFloat(data[0].lat);
        var longitude = parseFloat(data[0].lon);

        map.setView([latitude, longitude], 16);

        var marker = L.marker([latitude, longitude]).addTo(map);
        var popupContent = `<div style="text-align: center;"><h3 style="color: #344D67;"><b>${nomAdresse}</h3></b><br> ${address}</div>`;

        marker.bindPopup(popupContent).openPopup();
    })
    .catch(error => console.error('Erreur lors du géocodage:', error));

// Gestion de Stripe

src="https://js.stripe.com/v3/";

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

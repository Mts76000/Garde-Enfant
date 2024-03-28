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


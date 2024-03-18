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

// user
import "./styles/user/rdv.scss";
import "./styles/user/success.scss";
import "./styles/user/index.scss";
import "./styles/user/addchild.scss";
import "./styles/recupChild.scss";
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

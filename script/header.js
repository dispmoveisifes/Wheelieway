/*ativando e desativando o display do menu mobile*/
function mobileMenu() {
    var options = document.getElementById("header_options");
    if (options.style.display === "flex") {
      options.style.display = "none";
    } else {
      options.style.display = "flex";
    }
  }

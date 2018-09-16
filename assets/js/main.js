function loadBody() {

  var timeout = setTimeout(endAnimation, 1500);
  var loadingContainer = document.getElementById("loadingContainer");
  loadingContainer.style.width = "100%";
  console.log("Welcome! Site made by Marton");

}

function endAnimation() {

  $(".loading-line").fadeOut();

}

function openNav() {

  var x = document.getElementById("nav");
  var y = document.getElementById("burger-icon");

  y.classList.toggle("change");

  if (x.className === "nav") {

    x.className += " responsive";

  } else {

    x.className = "nav";

  }

}

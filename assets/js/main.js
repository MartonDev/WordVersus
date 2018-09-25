var fileInputs = document.getElementsByClassName("fileinput");
var fileTexts = document.getElementsByClassName("fileText");
var imageElements = document.getElementsByClassName("imageElement");

function loadBody() {

  //author
  console.log("Welcome! Site made by Marton");

  //file input style fiexes and file input previews
  for(var i = 0; i < fileInputs.length; i++) {

    var input = fileInputs[i];
    var text = fileTexts[i];
    var imageElement = imageElements[i];

    imageElement.style.display = "none";

    input.onchange = function() {

      if(input.value.split('\\').pop() != "") {

        text.innerHTML = "New profile picture will be: " + input.value.split('\\').pop();
        imageElement.style.display = "block";
        readImage(input, imageElement);
        notifyUser("Info", "Uploaded an image. Press Set to submit!", 5000);

      }else {

        imageElement.style.display = "none";
        text.innerHTML = "Upload an image";

      }

    };

  }

  //loading animation
  var timeout = setTimeout(endAnimation, 1500);
  var loadingContainer = document.getElementById("loadingContainer");
  loadingContainer.style.width = "100%";

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

function readImage(input, imageElement) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {

      $(imageElement).attr('src', e.target.result);
      $(imageElement).attr('alt', input.value.split('\\').pop());

    }

    reader.readAsDataURL(input.files[0]);

  }

}

$(document).ready(function() {

  $("#fillline").css("width", "40%");

  setTimeout(function () {

    $("#fillline").css("width", "76%");

    setTimeout(function() {

      $("#fillline").css("width", "100%");

      setTimeout(function() {

        $("#game-loading").fadeOut();

      }, 1800);

    }, 400);

  }, 820);

});

window.addEventListener('load', function () {

  var fill = document.getElementById("fillline");
  var filltimeout = setTimeout(step2Loading, 820);
  fill.style.width = "40%";

}, false);

function step2Loading() {

  var fill = document.getElementById("fillline");
  fill.style.width = "76%";
  var filltimeout2 = setTimeout(step3Loading, 400);

}

function step3Loading() {

  var fill = document.getElementById("fillline");
  fill.style.width = "100%";

}

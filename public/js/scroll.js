var nystories = document.querySelector("section").offsetTop;
window.onscroll = function() {
  if (window.pageYOffset > 0) {
 var opac = (window.pageYOffset / nystories);
    console.log(opac);
  if (opac < 0.4){
    document.body.style.background = "linear-gradient(rgba(255, 255, 255, " + opac + "), rgba(255, 255, 255, " + opac + ")), url(/images/bicycle-clouds-colors-797673.jpg) no-repeat";
  }
  }
}
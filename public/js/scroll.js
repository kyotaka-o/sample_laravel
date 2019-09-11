var nystories = document.querySelector("section").offsetTop;
var section = document.querySelector("section");
var menu = document.getElementsByClassName("menu");

function scroll_change(){
  if (window.pageYOffset > 0) {
    var opac = (window.pageYOffset / nystories);
       console.log(opac);
       section.style.opacity = 1.0;
       menu[0].style.opacity = 1.0;
       
      if (opac < 0.4){
         opac = 0.4
         document.body.style.background = "linear-gradient(rgba(255, 255, 255, " + opac + "), rgba(255, 255, 255, " + opac + ")), url(/images/bicycle-clouds-colors-797673.jpg) no-repeat";
       }else{
        document.body.style.background = "linear-gradient(rgba(255, 255, 255, " + 0.4 + "), rgba(255, 255, 255, " + 0.4 + ")), url(/images/bicycle-clouds-colors-797673.jpg) no-repeat";       
       }
     }
     else{
       // menu[0].style.opacity = 0;
       section.style.opacity = 0;
     }
}
window.onscroll = function() {
  if (window.pageYOffset > 0) {
 var opac = (window.pageYOffset / nystories);
    console.log(opac);
    section.style.opacity = 1.0;
    menu[0].style.opacity = 1.0;
    if (opac < 0.4){
      document.body.style.background = "linear-gradient(rgba(255, 255, 255, " + opac + "), rgba(255, 255, 255, " + opac + ")), url(/images/bicycle-clouds-colors-797673.jpg) no-repeat";
    }
  }
  else{
    // menu[0].style.opacity = 0;
    section.style.opacity = 0;
  }
}

$(function(){
  scroll_change();
})
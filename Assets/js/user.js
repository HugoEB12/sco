/*CSS FUNCTIONS*/
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    let dropdownTopNav  = document.getElementsByClassName("dropdown-content");
    removeClass(dropdownTopNav);
    let dropdownSideNav = document.getElementsByClassName("dropdown-content-sidenav");
    removeClass(dropdownSideNav);
  }
}

function removeClass(colection){
  for (var i = 0; i < colection.length; i++) {
    if (colection[i].classList.contains('show')) {
      colection[i].classList.remove('show');
    }
  }
}

function dropdown(element){
  let x = document.getElementById(element).classList.toggle("show");
}


/*JAVASCRIPT FUNCTIONS*/
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML =
    getDayString(today.getDay()) +" "+
    today.getDate() + " de " +
    getMonthString(today.getMonth()) + " del " +
    today.getFullYear() +", "+ h + ":" + m + ":" + s + " hrs.";
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
function getDayString(day){
  switch (parseInt(day)) {
    case 0:return "Domingo";
    case 1:return "Lunes";
    case 2:return "Martes";
    case 3:return "Miércoles";
    case 4:return "Jueves";
    case 5:return "Viernes";
    case 6:return "Sábado";
  }
}
function getMonthString(month){
  switch (parseInt(month)) {
    case 0:return "Enero";
    case 1:return "Febrero";
    case 2:return "Marzo";
    case 3:return "Abril";
    case 4:return "Mayo";
    case 5:return "Junio";
    case 6:return "Julio";
    case 7:return "Agosto";
    case 8:return "Septiembre";
    case 9:return "Octubre";
    case 10:return "Noviembre";
    case 11:return "Diciembre";
  }
}

/*====================> JQUERY <==================*/

$(document).ready(function(){
  
  $(".img").hover(
    function (argument) {//IN
      $(this).find("img").addClass("invert");
    },
    function (argument) {//OUT
      $(this).find("img").removeClass("invert");
    }
  );

});
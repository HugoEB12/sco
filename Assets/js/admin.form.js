/*COOKIES*/
function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
/**/
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
/**/
function deleteAllCookies() {
	var c = document.cookie.split("; ");
	for (i in c)
		document.cookie =/^[^=]+/.exec(c[i])[0]+"=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
}
/**/
function showPassword(checkbox,inputID) {
	let input = document.getElementById(inputID);
	if (checkbox.checked){
		input.type = 'text';
	} else {
		input.type = 'password';
	}
}
/**/
function verifyPasswords(input1,input2) {
	let pswd1 = document.getElementById(input1).value;
  let pswd2 = document.getElementById(input2).value;
  let span = document.getElementById("confirm");
  let msg  = document.getElementById("msg");

  if (pswd1 == pswd2) {
  	span.classList.remove('invalid');
  	span.classList.add('valid');
  	$("#msg").text("¡Correcto!");
  } else {
    span.classList.remove('valid');
  	span.classList.add('invalid');
  	$("#msg").text("¡Las contraseñas no coinciden!");
  }
}
/**/
function generatePassword(checkbox) {
	/* (*,+,#,/) */
	let specialChars = [42,43,35,47];
	/* (A,B,C, ...) */
	/* 65 - 90 */
	/* (a,b,c, ...) */
	/* 97 - 122 */
	/* (1,2,3, ...) */
	let inputPassword = document.getElementById("password");
	let inputConfirm  = document.getElementById("confirm");
	/**/
	if (checkbox.checked) {
		/**/
		let password = "";
		for (var i = 0; i < 2; i++) {
			password += String.fromCharCode(getRandomInteger(65,90));
		}
		for (var i = 0; i < 2; i++) {
			password += getRandomInteger(0,9);
		}
		for (var i = 0; i < 2; i++) {
			password += String.fromCharCode(specialChars[Math.floor(Math.random() * specialChars.length)]);
		}
		for (var i = 0; i < 2; i++) {
			password += String.fromCharCode(getRandomInteger(97,122));
		}
		/**/
		inputPassword.value = password;
		inputPassword.disabled = true;
		inputConfirm.value  = password;
		inputConfirm.disabled = true;
	} else {
		inputPassword.value = "";
		inputPassword.disabled = false;
		inputConfirm.value  = "";
		inputConfirm.disabled = false;
	}
}
/**/
function getRandomInteger(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
/**/
function modifyPassword(){
	let inputPassword = document.getElementById("password");
	let inputConfirm  = document.getElementById("confirm");
	/**/
	let pswd = inputPassword.value;
	if (pswd != "") {
		setCookie("userpswd",pswd,1);
	}
	/**/
	if (inputPassword.disabled == false || inputConfirm.disabled == false) {
		inputPassword.value = getCookie("userpswd");
		inputPassword.disabled = true;
		inputConfirm.value  = getCookie("userpswd");
		inputConfirm.disabled = true;
	} else {
		inputPassword.value = "";
		inputPassword.disabled = false;
		inputConfirm.value  = "";
		inputConfirm.disabled = false;
		deleteAllCookies();
	}
}

function enablePassword(){
	let inputPassword = document.getElementById("password").disabled = false;
}

function verifyAvailableEmail(input,from,span) {
  var key = $(input).val();
  var dataString = 'key='+key;
  $.ajax({
    type: "POST",
    url: "../../../Controllers/AdminController.php?type=ajax&from="+from,
    data: dataString,
    success: function(data) {
      if (data == 1) {//true
        $(span).text("El correo electrónico ya está registrado");
        $(span).removeClass("valid");
        $(span).addClass("invalid");
        $("#save").css('display', "none");
      } else if (key.length > 0 && data != 1){
        $(span).text("Disponible");
        $(span).removeClass("invalid");
        $(span).addClass("valid");
        $("#save").css('display', "inline");
      } else {
        $(span).text("");
        $(span).removeClass("invalid");
        $(span).removeClass("valid");
        $("#save").css('display', "inline");
      }
    }
  });
}

///JQUERY
$(document).ready(function(){

	/*ADMINISTRATORS*/
  $("#form_admin").validate({
    rules:{
      'name':    {required:true, minlength:3, maxlength: 30},
      'lname':   {required:true, minlength:3, maxlength: 30},
      'email':   {required:true, email:true,  maxlength: 50},
      'password':{required:true},
      'confirm': {required:true}
    },
	  messages:{
      'name':    {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 30 caracteres."},
      'lname':   {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 30 caracteres."},
      'email':   {required:"* Requerido.", email:"* Ingrese un E-mail válido.", maxlength:"* Máximo 50 caracteres."},
      'password':{required:"* Requerido."},
      'confirm': {required:"* Requerido."}
    }
  });
  /*DEPENDENCIES*/
  $("#form_dependency").validate({
    rules:{
      'name':    				{required:true, minlength:3, maxlength: 80},
      'principal':  		{required:true, minlength:3, maxlength: 50},
      'description': 		{required:true, minlength:3, maxlength: 100},
      'type_dependency':{required:true}
    },
	  messages:{
      'name':    				{required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 80 caracteres."},
      'principal':  		{required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 50 caracteres."},
      'description': 		{required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 100 caracteres."},
      'type_dependency':{required:"* Requerido."}
    }
  });
  /*USERS*/
  $("#form_user").validate({
    rules:{
      'name':      {required:true, minlength:3, maxlength: 30},
      'lname':     {required:true, minlength:3, maxlength: 30},
      'email':     {required:true, email:true,  maxlength: 50},
      'password':  {required:true},
      'confirm':   {required:true},
      'job': 		   {required:true},
      'dependency':{required:true}
    },
	  messages:{
      'name':      {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 30 caracteres."},
      'lname':     {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 30 caracteres."},
      'email':   	 {required:"* Requerido.", email:"* Ingrese un E-mail válido.", maxlength:"* Máximo 50 caracteres."},
      'password':  {required:"* Requerido."},
      'confirm': 	 {required:"* Requerido."},
      'dependency':{required:"* Requerido."},
      'job': 		 	 {required:"* Requerido."}
    }
  });
  /*SENDERS AND RECEIVERS*/
  $("#form_sr").validate({
    rules:{
      'name':    		{required:true, minlength:3, maxlength: 80},
      'job':  		  {required:true, minlength:3, maxlength: 80},
      'dependency': {required:true, minlength:3, maxlength: 100},
      'type_sr':    {required:true}
    },
	  messages:{
      'name':    		{required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 80 caracteres."},
      'job':  		  {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 80 caracteres."},
      'dependency': {required:"* Requerido.", minlength:"* Mínimo 3 caracteres.",  maxlength:"* Máximo 100 caracteres."},
      'type_sr':    {required:"* Requerido."}
    }
  });
  /*AJAX REQUEST*/
  $('#email').on(
    'keyup',
    function() {//u for users
      verifyAvailableEmail("#email","u","#msj-email");
    }
  );
  /**/
  $('#email_admin').on(
    'keyup',
    function() {//u for users
      verifyAvailableEmail("#email_admin","a","#msj-email_admin");
    }
  );

});
/*form*/

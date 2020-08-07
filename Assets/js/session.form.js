/*JQUERY/AJAX DEFINITIONS*/
/**/
$(document).ready(function() {
  $("#form_session").validate({
    rules:{
      'user':{required:true, email: true},
      'pswd':{required:true}
    },
    messages:{
      'user':{required:"* Requerido.", email: "* Ingresa un E-mail válido."},
      'pswd':{required:"* Requerido."}
    }
  });

});
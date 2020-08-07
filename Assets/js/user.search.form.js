function cleanSearchInputs(){
  document.getElementById("subject").value = "";
  document.getElementById("reference").value = "";
  document.getElementById("request").selectedIndex = "0";
  document.getElementById("status").selectedIndex = "0";
}

/**/
$(document).ready(function() {
	$("#form_search").validate({
    rules:{
      'subject': {digits:true}
    },
    messages:{
      'subject': {digits:"* Ingrese sólo números."}
    }
  });

});
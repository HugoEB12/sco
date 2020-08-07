/*JAVASCRIPT DEFINITIONS*/
function allowNewSenderReceiver(checkbox,fields){
  let job = document.getElementById(fields[0]);
  let dependency = document.getElementById(fields[1]);
  let input = document.getElementById(fields[2]);
  if (checkbox.checked) {
    job.disabled = false;
    dependency.disabled = false;
    input.value = "y";
  } else {
    job.disabled = true;
    dependency.disabled = true;
    input.value = "n";
  }
}

function findSuggestions(input,fields,from) {
  let key = $(input).val();
  $(input).autocomplete({
    autofocus: true,
    delay: 100,
    source: function(request, response) {
      // Fetch data
      $.ajax({
        url: "../../Controllers/SubjectController.php?type=ajax&from="+from,
        type: 'POST',
        dataType: "json",
        data: "key="+key,
        success: function(data) {
          response(data);
        }
      });
    },
    select: function (event, ui) {
      // Set selection
      $(input).val(ui.item.label); // display the selected text
      if (fields.length == 3) {
        $(fields[0]).val(ui.item.value); // save selected id to input
        $(fields[1]).val(ui.item.job); // save selected id to input
        $(fields[2]).val(ui.item.dependency); // save selected id to input
      }
      return false;
    }
  });
  if (key == "") {
    for (let i = 0; i < fields.length; i++) {
      $(fields[i]).val("");
    }
  }
}

function findSuggestionsUsers(input,fields,from) {
  let key = $(input).val();
  let dep = $("#dependencyID").val();
  let usr = $("#userID").val();
  /**/
  $(input).autocomplete({
    autofocus: true,
    delay: 100,
    source: function(request, response) {
      // Fetch data
      $.ajax({
        url: "../../Controllers/SubjectController.php?type=ajax&from="+from,
        type: 'POST',
        dataType: "json",
        data: "key="+key+"&dep="+dep+"&usr="+usr,
        success: function(data) {
          response(data);
        }
      });
    },
    select: function (event, ui) {
      // Set selection
      $(input).val(ui.item.label); // display the selected text
      if (fields.length == 3) {
        $(fields[0]).val(ui.item.value); // save selected id to input
        $(fields[1]).val(ui.item.job); // save selected id to input
        $(fields[2]).val(ui.item.dependency); // save selected id to input
      }
      return false;
    }
  });
  if (key == "") {
    for (let i = 0; i < fields.length; i++) {
      $(fields[i]).val("");
    }
  }
}


/*JQUERY/AJAX DEFINITIONS*/
/**/
$(document).ready(function() {

  /*SUGGESTIONS*/
  /*
  $('body').on('click',function(event){
     if(!$(event.target).is('#suggestions_senders')){
       $("#suggestions_senders").fadeOut(200);
     }
     if(!$(event.target).is('#suggestions_receivers')){
       $("#suggestions_receivers").fadeOut(200);
     }
     if(!$(event.target).is('#suggestions_users')){
       $("#suggestions_users").fadeOut(200);
     }
  });
  /*
  $('#key_senders').on('keyup', function() {
    var key = $(this).val();
    var dataString = 'key='+key;
		$.ajax({
      type: "POST",
      url: "../../Controllers/RecordController.php?type=ajax&from=senders",
      data: dataString,
      success: function(data) {
        //write the suggestions that the query sends us
        $('#suggestions_senders').fadeIn(500).html(data);
        //click on any of the suggestions
        $('.sender').on('click', function(){
          //get the id of suggest
          let id = $(this).attr('id');
          //edit the value of input with the data of clicked suggestion
          $('#key_senders').val($(this).attr('data'));
          //Put the key in the input (it will be sent to the controller)
          $('#id_sender').val(id);
          //complete all fields job and dependency
          $('#job_sender').val($(this).attr('job'));
          $('#dependency_sender').val($(this).attr('dependency'));
          //disappear the rest of the suggestions
          $('#suggestions_senders').fadeOut(200);
          //
          return false;
        });
      }
    });
    if (key == "") {
      $('#id_sender').val("");
      $('#job_sender').val("");
      $('#dependency_sender').val("");
    }
  });
  /**/

  
  //
  $('#key_users').on(
    'keyup keypress', 
    function() {
      findSuggestionsUsers("#key_users",["#id_user","#job_user","#dependency_user"],"users");
    }
  );
  //
  $('#key_senders').on(
    'keyup keypress', 
    function() {
      findSuggestions("#key_senders",["#id_sender","#job_sender","#dependency_sender"],"senders");
    }
  );
  //
  $('#key_receivers').on(
    'keyup keypress', 
    function() {
      findSuggestions("#key_receivers",["#id_receiver","#job_receiver","#dependency_receiver"],"receivers");
    }
  );
  /**/
  $("#form_record").validate({
    rules:{
      'admission': {required:true},
      'expiration':{required:true},
      'year':      {required:true},
      'reference': {required:true},
      'request':   {required:true},
      'priority':  {required:true},
      'sender':    {required:true},
      'receiver':  {required:true},
      'subject':   {required:true},
      'turn':      {required:true},
      'file':      {required:true}
      //'amount':{required:true},
      //'indications':{required:true},
    },
    messages:{
      'admission': {required:""},
      'expiration':{required:""},
      'year':      {required:""},
      'reference': {required:""},
      'request':   {required:""},
      'priority':  {required:""},
      'sender':    {required:""},
      'receiver':  {required:""},
      'subject':   {required:""},
      'turn':      {required:""},
      'file':      {required:""}
    }
  });

  $("#form_finish").validate({
    rules:{
      'final_response':{required:true, minlength:3, maxlength:80}
    },
    messages:{'final_response':{required:"* Requerido.", minlength:"* Ingrese un valor", maxlength:"* Máximo 80 caracteres."}}
  });

});
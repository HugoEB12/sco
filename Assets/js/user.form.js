/*
FUNCTIONS USED TO SET DATE WITH AN SPECIFIC NUMBER OF "WORKING DAYS"
... IN THIS CASE 5 DAYS
*/
/*
  @PARAM :
    fromDate => Object type date, it contains the current date(today).
    days     => Number of days.
  @RETURN: none.
*/
function setWorkingDays(fromDate,days) {
  let count = 0;
  while (count < days) {
    fromDate.setDate(fromDate.getDate() + 1);
    let day = fromDate.getDay();
    if (day != 0 && day != 6) // Skip weekends
      count++;
  }
  let day = fromDate.getDate();
  let monthIndex =fromDate.getMonth()+1;
  let year = fromDate.getFullYear();
  let date = year+"-"+addZero(monthIndex)+"-"+addZero(day);
  //console.log(date)
  document.getElementById("workingDays").value = date;
}
/**/

/*
  @PARAM  : number => int value for convert to a int value with two digits format (01,02,03, ... , 09).
  @RETURN : string format with two digits.
*/
function addZero(number){
  let num = parseInt(number);
  if (num < 10) {
    return "0"+num
  } else {
    return num;
  }
}
/**/

/*
FUNCTION USED FOR DRAW A CIRCLE WITH SPECIFIC COLOR / PRIORITY.
*/
/*
  @PARAM: none.
  @RETURN: none.
*/
function setPriority(){
  let priority = document.getElementById("priority");
  let strValue = priority.options[priority.selectedIndex].value;
  //let classArray = ["sphere-red","sphere-blue","sphere-green"];
  //let divContent = document.getElementById("typePriority");
  /*
  for(let i = 0; i < classArray.length; i++){
    if (divContent.classList.contains(classArray[i])) {
      divContent.classList.remove(classArray[i]);
    }
  }
  */
  switch (strValue) {
    case "alta":
      /**/
      setWorkingDays(new Date(),3);
      break;
    case "normal":
      /**/
      setWorkingDays(new Date(),5);
      break;
    case "baja":
      /**/
      break;
  }
}
/**/

/*
FUNCTIONTS USED FOR INPUT FILE IMAGE/PDF VALIDATION
*/
/*
  @PARAM:
    type     => type of loade file.
    typeFile => type of file selected in option input (image/pdf) for validation.
  @RETURN: none.
*/
function validFileType(type,typeFile){
  let types = ["image/jpg", "image/jpeg", "image/png"];
  let valid = false;
  /**/
  if (typeFile == "pdf") {
    if (type === "application/pdf"){
      valid = true;
    } else {
      alert("Tipo de archivo no permitido");
    }
  } else if (typeFile == "image") {
    if (types.find(element => element == type) != null){
      valid = true;
    } else {
      alert("Tipo de imágen no permitido");
    }
  }
  /**/
  return valid;
}
/**/

/*
  @PARAM: size => string value that contains the real size of the loaded file.
  @RETURN: valid => boolean value, if the size is less than 5 MB return "true".
*/
function validFileSize(size){
  let maxSize = 5 * 1024 * 1024;// UP TO 5 MB
  let valid = false;
  /**/
  if (parseInt(size) > maxSize) {
    alert("Seleccione un archivo menor a 5 MB");
  } else {
    valid = true;
  }
  /**/
  return valid;
}
/**/

/*
  @PARAM: input => input field to verify the selected file.
  @RETURN: none.
*/
function verifyFile (input) {
  let selectTag = document.getElementById("typeFile");
  let optionValue  = selectTag.options[selectTag.selectedIndex].value;
  let preview = document.getElementById("fileMetaInfo");
  let imgPreview = document.getElementById("imagePreview");
  /**/
  if (input.files.length > 0){
    let file = input.files[0];/*select specific file*/
    /**/
    if (validFileSize(file.size,optionValue) && validFileType(file.type,optionValue)){
      if (optionValue == "image") {
        var reader = new FileReader();
        reader.onload = function(){
          imgPreview.src = reader.result;
          imgPreview.style.display = "inline";
        };
        reader.readAsDataURL(event.target.files[0]);
      }
      preview.innerHTML = "<br/>Nombre: "+file.name+" / Tamaño: "+getRealFileSize(parseInt(file.size));
      preview.style.display = "inline";
    } else {
      input.value = "";
      imgPreview.src = "";
      preview.innerHTML = "";
    }
  }
  /**/
}
/**/

/*
  @PARAM: realSize => int value that contains the real size of file in "bytes".
  @RETURN: size => string that contains the real size converted to B, KB or MB.
*/
function getRealFileSize(realSize){
  let size = "";
  /*SIZE IN BYTES*/
  if (realSize >= 0 && realSize < 1000){
    size = realSize + " Bytes";
  } else if (realSize >= 1000 && realSize < 1000000) {
    size = (realSize/1000) + " KB";
  } else if (realSize >= 1000000){
    size = (realSize/1000000) + " MB";
  }
  return size;
}
/**/

/*
  @PARAM: none.
  @RETURN: none.
*/
function setInputType(){
  let selectTag = document.getElementById("typeFile");
  let optionValue = selectTag.options[selectTag.selectedIndex].value;
  let inputImage = document.getElementById("inputImage");
  let inputPDF = document.getElementById("inputPDF");
  /**/
  document.getElementById("fileMetaInfo").innerHTML = "";
  /**/
  switch (optionValue) {
    case "pdf":
      inputPDF.style.display = 'inline';
      inputImage.style.display = 'none';
      /**/
      document.getElementById("inputFilePDF").name = "file";
      document.getElementById("inputFileImage").name = "none";
      break;
    case "image":
      inputPDF.style.display = 'none';
      inputImage.style.display = 'inline';
      /**/
      document.getElementById("inputFilePDF").name = "none";
      document.getElementById("inputFileImage").name = "file";
      break;
  }
}
/**/
/*INPUT FILE IMAGE/PDF VALIDATION*/

/*PLACE NEW DEPENDENCY*/
var id = 1;
var countTurns = 0;
/**/
var forms = [];
/**/
function addDependency(){
  /*
  div container for dependencies
  */
  let divContainer = document.getElementById("dependencies");
  /**/
  let divID = "div"+id;
  /*generate properties for each element*/
  let form = document.createElement("div");
  form.classList.add('form-group');
  form.classList.add('form-inline');
  form.setAttribute("id", divID);
  /**/
  form.appendChild(createLabel("Nombre:"));
  //
  let inputName = createInputText("NOMBRE(S) Y APELLIDOS",false,"name"+id,"text");inputName.name = "turn";
  let inputID   = createInputText("",true,"id_"+id,"hidden");
  let inputJob  = createInputText("CARGO ACTUAL",true,"job"+id,"text");
  let inputDep  = createInputText("DEPENDENCIA RECEPTORA",true,"dep"+id,"text");
  //
  form.appendChild(createDivForInput(inputName,"http://localhost/SCO/Assets/images/icons/mono/16x16/form/user.png"));
  //
  form.appendChild(inputID);
  /**/
  form.appendChild(createLabel("Cargo:"));
  form.appendChild(createDivForInput(inputJob,"http://localhost/SCO/Assets/images/icons/mono/16x16/form/employee.png"));
  /**/
  form.appendChild(createLabel("Dependencia:"));
  form.appendChild(createDivForInput(inputDep,"http://localhost/SCO/Assets/images/icons/mono/16x16/form/suitcase.png"));
  /**/
  /*ADD EVENTS*/
  inputName.addEventListener("keyup", function(){
    findSuggestionsUsers("#"+inputName.id,["#"+inputID.id,"#"+inputJob.id,"#"+inputDep.id],"users");
  });
  inputName.addEventListener("keypress", function(){
    findSuggestionsUsers("#"+inputName.id,["#"+inputID.id,"#"+inputJob.id,"#"+inputDep.id],"users");
  });
  /**/
  form.appendChild(createButtonDelete(divID));
  /**/
  forms.push(divID);
  /**/
  divContainer.appendChild(form);
  /**/
  id++;
  /**/
  countTurns++;
  /**/
  setIdValues(forms);
}

function createInputText(placeholder,disabled,id,type){
  let input = document.createElement("input");
  input.id = id;
  input.setAttribute("type", type);
  input.setAttribute("placeholder", placeholder);
  input.classList.add("form-control");
  input.disabled = disabled;
  //input.onkeypress = findSuggestions("#"+idName,fields,"users");
  return input;
}

function createLabel(text){
  let label = document.createElement("label");
  label.classList.add("p-2");
  let span  = document.createElement("span");
  span.classList.add("text-danger");
  span.textContent = "*";
  label.appendChild(span);
  label.appendChild(document.createTextNode(text));
  return label;
}

function createButtonDelete(divID){
  let button = document.createElement("a");
  button.classList.add("link");
  button.classList.add("link-outline-danger");
  button.classList.add("img");
  button.setAttribute("href", "javascript:void(0);");
  button.appendChild(document.createTextNode(" Eliminar "));
  /**/
  let img = document.createElement("img");
  img.setAttribute("src", "http://localhost/SCO/Assets/images/icons/mono/16x16/form/minus.png");
  img.setAttribute("class", "");
  /**/
  button.appendChild(img);
  button.onclick = function(){
    let div = document.getElementById(divID);
    div.parentNode.removeChild(div);
    /**/
    removeItemFromArr(forms, divID);
    setIdValues(forms);
    /**/
    if (id < 0) {
      id = 0;countTurns = 0;
    } else {
      id--;countTurns--;
    }
  };
  /**/
  return button;
}

function removeItemFromArr(arr, item){
  let i = arr.indexOf( item );
  arr.splice( i, 1 );
}

function setIdValues(arr){
  let input = document.getElementById("turns").value = arr.toString();
}

/*
  Place value for each user_id
*/
function setUsersSubmitValues(){
  /**/
  if (forms.length > 0) {
    let users = [];
    for (let i = 0; i < forms.length; i++) {
      let div = document.getElementById(forms[i]);
      let idCount = forms[i].substring(forms[i].length-1, forms[i].length);
      let nodeList = div.querySelectorAll("input");
      for (let i = 0; i < nodeList.length; i++){
        let input = nodeList[i];
        if (input.id == "id_"+idCount) {
          users.push(input.value);
        }
      }
    }
    document.getElementById("turns").value = users.toString();
  } else {
    document.getElementById("turns").value = "";
  }
  /**/
  setDefaultValues();
  /**/
  return true;

}

/*
Place default values ​​for the fields that are not required
*/
function setDefaultValues(){
  let amount = document.getElementById("amount");
  if (amount != null) {
    if (amount.value == '') {
      amount.value = "No especificado.";
    }
  }
  let indications = document.getElementById("indications");
  if (indications != null) {
    if (indications.value == '') {
      indications.value = "No especificado.";
    }
  }
  let description = document.getElementById("description_e");
  if (description != null) {
    if (description.value == '') {
      description.value = "Ninguna.";
    }
  }
}

function createDivForInput(input,imgSRC){
  let div = document.createElement("div");
  div.classList.add("input-group");
  /**/
  let div2 = document.createElement("div");
  div2.classList.add("input-group-prepend");
  /**/
  let div3 = document.createElement("div");
  div3.classList.add("input-group-text");
  /**/
  let img = document.createElement("img");
  img.setAttribute("src", imgSRC);
  /**/
  div3.appendChild(img);
  div2.appendChild(div3);
  div.appendChild(div2);
  /**/
  div.appendChild(input);
  /**/
  return div;
}
/*PLACE NEW DEPENDENCY*/

/*START JQUERY DEFINITIONS*/
$(document).ready(function(){

  /*WHEN THE INPUT IS COMPLETELLY LOADED, THE "WORKING DAYS" ARE PLACED.*/
  $("#workingDays").on("load",setWorkingDays(new Date(),5));

});
/*END JQUERY DEFINITIONS*/

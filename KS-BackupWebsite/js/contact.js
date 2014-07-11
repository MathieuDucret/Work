/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
function getNewSubmitForm(){
 var submitForm = document.createElement("FORM");
 document.body.appendChild(submitForm);
 submitForm.method = "POST";
 return submitForm;
}

//helper function to add elements to the form
function createNewFormElement(inputForm, elementName, elementValue){
var newElement = document.createElement("input");
inputForm.appendChild(newElement);
newElement.name = elementName;
newElement.type = 'text';
newElement.value = elementValue;
return newElement;
}


//function that creates the form, adds some elements
//and then submits it
function submitForm(nature){
 var submitForm = getNewSubmitForm();
 createNewFormElement(submitForm, "nature", nature);
 submitForm.action= "contact";
 submitForm.submit();
}
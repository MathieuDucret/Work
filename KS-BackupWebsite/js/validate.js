// JavaScript Document

function validate(form_Field_name) {
		var errcount = 0;
		var message = "";

	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form i.e form_Field_name[i][0]
	//and the second tells whether to 
	//perform a extended validation on that field i.e. form_Field_name[i][1]
	//key for extended validation
	//1 == email
	//2 == reciprocal hyperlink check
	
		//this loop checks all the form fields
		for(var j=0; j<document.forms[0].elements.length; j++)
		{		
				for ( var i=0; i<form_Field_name.length; i++)
				{	//check if the form field in question requires a validation		
					if (document.forms[0].elements[j].name==form_Field_name[i][0])
					{
							//check if the field is empty
							if (trim(document.forms[0].elements[j].value)=="")
							{
								message =  message + form_Field_name[i][0] + '\n';
								errcount = errcount + 1;
  							}
							//check if the form field is email and validate this
								if (form_Field_name[i][1]=="1")
								{
									if (validateEmail(document.forms[0].elements[j].value))
									{}
									else
									{
										message =  message + " Email address is not Valid" + '\n';
										errcount = errcount + 1;
									}
								}
							//check if the form field is reciprocal link and validate this
							if (form_Field_name[i][1]=="2")
							{
									if (validateHyperlink(document.forms[0].elements[j].value))
									{}
									else
									{	
										message =  message + " Reciprocal Hyperlink is not valid" + '\n';
										errcount = errcount + 1;
									}
							}							
					}
			}
}
		if (errcount > 0)
		{	
			alert ("We encountered the following error(s) while processing your form" + '\n' + message);
			return false;
		}
		else
		{
			return true;
		}	

}
/*Check for a special character'***/
function isSplChar(str)
{	
	var spchar, getChar, SpecialChar;	
	spchar="`()(\\~!^&*+\"|%=,<>#";
	getChar='Empty';
	SpecialChar='No';
	var spchars =" ` ( )  \\ ~ ! ^ & * + \" | % =  , < > #"; 
	//var spchars ="`()\\~!^&*+\"|%=,<>#"; 
	for(var i=0; i<str.length; i++)
	{
		for(var j=0; j<spchar.length; j++)
		{			
			if(str.charAt(i)== spchar.charAt(j))
			{			
				SpecialChar='Yes';
				break;
			}
		}		
	}
	if (SpecialChar == 'Yes')
	{
		//alert('Please do not enter any of the following characters: \n ' + spchars);	
		return true;
	}
	else if (SpecialChar == 'No')
	{
		return false;
	}
}


function validateText(field) {
        var re = /^[A-z]*$/;
        if (!re.test(field.value)) {
            alert('Value must be ONLY letters!');
            field.value = field.value.replace(/[^A-z]/g,"");
        }
    }


function validateNumbers(field) {
        var re = /^[0-9]*$/;
        if (!re.test(field.value)) {
            alert('Value must be ONLY numbers!');
            field.value = field.value.replace(/[^0-9]/g,"");
        }
    }



function validateEmail(pemail) {
alert ("Validate email called email to validate is " + pemail);
AtPos = pemail.indexOf("@");
StopPos = pemail.lastIndexOf(".");
returnVal=true;


	if (pemail == "") {returnVal = false}
	if (AtPos == -1 || StopPos == -1) {	returnVal = false }
	if (StopPos < AtPos) {returnVal = false}
	if (StopPos - AtPos == 1) {returnVal = false}
return returnVal
}

function textCounter(field,cntfield,maxlimit) {
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
			// otherwise, update 'characters left' counter	
	else
		cntfield.value = maxlimit - field.value.length;
	}


function trim (str) {
return str.replace(/^\s*/g, '').replace(/\s*$/g, '');
}


function countLength(field, limit){
	length = document.form_link_request.text_for_link.value.length;
		if (length >= limit){
			alert ("You are only allowed " + limit +" chars");
		}
}

function validateHyperlink(pRecHyperlink){
	returnVal=true;
	alert ("reciprocal link value is " + pRecHyperlink);
	recLink = pRecHyperlink
	knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|uk)$/;
	var checkTLD=1;
	var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
	var validChars="\[^\\s" + specialChars + "\]";
	var atom=validChars + '+';
	//check if theres a dot in the given expression and break the whole expression into smaller chunks
	var atomPat=new RegExp("^" + atom + "$");
	var domArr=recLink.split(".");
	var len=domArr.length;
		for (i=0;i<len;i++) 
		{
			if (domArr[i].search(atomPat)==-1) 
			{
				returnVal=false;
   			}
		}

		/* domain name seems valid, but now make sure that it ends in a
		known top-level domain (like com, edu, gov) or a two-letter word,
		representing country (uk, nl), and that there's a hostname preceding 
		the domain or country. */

	if (checkTLD && domArr[domArr.length-1].length!=2 && domArr[domArr.length-1].search(knownDomsPat)==-1) 
	{
		returnVal=false;
	}
	return returnVal;
}

  function chkNumber(e) {
    var charCode = (e.which) ? e.which : event.keyCode
    if (charCode > 57 && charCode != 190 || charCode < 48 && charCode != 46 && charCode != 8) {return false;}
    else {return true;}
  } 
  

	function isCurrency (s)
	{
		return s.replace(/^\s*(\+|-)?((\d+(\.\d\d)?)|(\.\d\d))\s*$/,'');
	}

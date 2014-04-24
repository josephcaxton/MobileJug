/**
 * QA JavaScript Witten by Joseph
 *
 * 
 */
function validateSubjectForm()
{
var x=document.forms["subjectform"]["subjectname"].value;
if (x==null || x=="")
  {
  alert("Subject name must be filled out");
  return false;
  }
}

function validateTemplateForm()
{
var x=document.forms["templateform"]["templatename"].value;
if (x==null || x=="")
  {
  alert("Template name must be filled out");
  return false;
  }
}

function addTopicToList(){

var x=document.getElementById("txtTopicName").value;
if (x ==null || x ==""){

 	alert("Topic name must be filled out");
 	return false;
	}
	
	else
	
	{
	// As we add Topics to the list check if the item is already in the list
		if(!checkifItemAlreadyInList(x)){
		
		//var Topics[];
		var form = document.getElementById("frmSubject");
		var newLi = document.createElement("li");
		newLi.setAttribute('name','Topics[]');
		var text = document.createTextNode(x);
		newLi.appendChild(text);
		var ul = form.getElementsByTagName('ul');
		ul[0].appendChild(newLi);
		// A ls cannot be submitted via form to php so we have to use hidden input
		addHiddenInputElement('Hidden', x , 'Topics[]', 'frmSubject');
		}
		
	
	}
}

function checkifItemAlreadyInList(TextName){

	var uls = document.getElementById("frmSubject").getElementsByTagName('li');
	 if(uls.length > 0){
	 
	 	for(var i=0; i< uls.length; i++){
	 		var val = uls[i].innerText;
	 		
	 		if(val == TextName){
		
				alert( TextName  + " already exist in the list");
				return true;
			}
	 	}
	 	
	 	return false;
	 
	 }
	
	
}

function addHiddenInputElement(type, value, name, formId) {
 
    //Create an input type dynamically.
    var element = document.createElement("input");
 
    //Assign different attributes to the element.
    element.setAttribute("type", type);
    element.setAttribute("value", value);
    element.setAttribute("name", name);
 
 
    var Frm = document.getElementById(formId);
 	Frm.appendChild(element);
 
}

function dropDownSelectedValueSet(){

dropDown = document.getElementById("dropDownBox").value;
hiddenTxt = document.getElementById("txtSelectedSubject");
hiddenTxt.setAttribute('value',dropDown);

}

function checkSwitch(checkbox)
{
    if (checkbox.checked)
    {
        checkbox.value = 1;
		//alert("values of checkbox is" + checkbox.value);
    }
	else{
		 checkbox.value = 0;
		// alert("values of checkbox is" + checkbox.value);
	}
}

function goToVideoListPage(){
 	window.location = "index.php?page_id=70";
	
}
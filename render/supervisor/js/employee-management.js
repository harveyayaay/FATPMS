function interfaceRequest(php_file, el, send_data) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", php_file, true); 
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState === 4 && this.status === 200) 
		{
			console.log(xhttp.responseText);
	  		document.getElementById(el).innerHTML = xhttp.responseText;
		}
	};
	xhttp.send(send_data);
}

function viewSpecificProfile(id)
{
	var send_data = 
		"&id="+id;
	interfaceRequest("profile-preview.php", 'profile-preview', send_data);
}
function editviewMode()
{ 
  var fname = document.getElementById('field-fname');
  var lname = document.getElementById('field-lname');
  var email = document.getElementById('field-email');
  var contact = document.getElementById('field-contact');

  if(fname.disabled == true)
  {
    fname.disabled = false;
    lname.disabled = false;
    email.disabled = false;
    contact.disabled = false;
    interfaceRequest("update-buttons.php", 'change-buttons', null);
  }
  else
  {
    fname.disabled = true;
    lname.disabled = true;
    email.disabled = true;
    contact.disabled = true;
    interfaceRequest("view-buttons.php", 'change-buttons', null);
  }
  
}


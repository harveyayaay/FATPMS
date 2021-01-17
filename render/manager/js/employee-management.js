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
function editViewMode(id)
{ 
  var fname = document.getElementById('field-fname');
  var lname = document.getElementById('field-lname');
  var email = document.getElementById('field-email');
  var contact = document.getElementById('field-contact');
  var position = document.getElementById('field-position');
  var status = document.getElementById('field-status');
  var send_data = 
    "&id="+id;
    
  if(fname.disabled == true)
  {
    fname.disabled = false;
    lname.disabled = false;
    email.disabled = false;
    contact.disabled = false;
    position.disabled = false;
    status.disabled = false;
    interfaceRequest("update-buttons.php", 'change-buttons', send_data);
  }
  else
  {
    fname.disabled = true;
    lname.disabled = true;
    email.disabled = true;
    contact.disabled = true;
    position.disabled = true;
    status.disabled = true;
    interfaceRequest("view-buttons.php", 'change-buttons', send_data); 
  }
}
function updateMode(id)
{ 
  var fname = document.getElementById('field-fname');
  var lname = document.getElementById('field-lname');
  var email = document.getElementById('field-email'); 
  var contact = document.getElementById('field-contact');
  var position = document.getElementById('field-position');
  var status = document.getElementById('field-status');

  var send_data = 
		"&id="+id+
		"&field-fname="+fname.value+
		"&field-lname="+lname.value+
		"&field-email="+email.value+
		"&field-contact="+contact.value+
		"&field-position="+position.value+
		"&field-status="+status.value;
	interfaceRequest("update-change.php", 'page-change', send_data);
}

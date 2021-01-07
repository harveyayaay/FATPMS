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

function editProd(title, id)
{
	var send_data = 
		"&activity_title="+title;
	interfaceRequest("productive-activities-update.php", id, send_data);
}
function cancelProdEdit()
{
	location.reload();
}

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

function checkLog()
{
  var user = document.getElementById('checkuser');
  var pass = document.getElementById('checkpass');

  var send_data = 
		"&user="+user.value+
		"&pass="+pass.value;
	window.location.href = "check-log.php";
}
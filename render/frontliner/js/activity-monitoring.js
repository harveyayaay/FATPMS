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

// function addTask(id)
// {
// 	var task = document.getElementById('a-task');
// 	var caseno = document.getElementById('a-caseno');
// 	var datetime = document.getElementById('a-datetime');

// 	var send_data = 
// 		"&id="+id+
// 		"&task="+task.value+
// 		"&caseno="+caseno.value+
// 		"&datetime="+datetime.value;
// 	interfaceRequest("add-change.php", 'page-change', send_data);
// }

function updateActivity(taskid, change)
{
	window.location.href = 'update-change.php?taskid=' + taskid+ '&change='+ change;
}


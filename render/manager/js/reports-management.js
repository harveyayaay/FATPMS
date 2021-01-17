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
function showAddMetricFields()
{
	interfaceRequest("metric-add.php", 'add-metric', null);
}
function closeAddMetricFields()
{
	interfaceRequest("add-metric-div.php", 'add-metric', null);
}
function addMetric()
{
	var title = document.getElementById('a-title');
	var type = document.getElementById('a-type');
	var goal = document.getElementById('a-goal');
	var ref = document.getElementById('a-ref');

	var send_data = 
		"&title="+title.value+
		"&type="+type.value+
		"&goal="+goal.value+
		"&ref="+ref.value;
	interfaceRequest("add-change.php", 'page-change', send_data);
}
function updateMetric()
{
	var tid = document.getElementById('u-tid');
	var title = document.getElementById('u-title');
	var ptime = document.getElementById('u-ptime');
	var sla = document.getElementById('u-sla');
	var level = document.getElementById('u-level');

	var send_data = 
		"&tid="+tid.value+
		"&title="+title.value+
		"&ptime="+ptime.value+
		"&sla="+sla.value+
		"&level="+level.value;
	interfaceRequest("update-change.php", 'page-change', send_data);
}


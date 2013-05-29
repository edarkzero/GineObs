function ajaxCalendarCreateEvent(id,title,start,end)
{
	var xmlhttp;
	  
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  }
	  
	else
	  {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//Codigo js 1
			document.getElementById(id_element).innerHTML=xmlhttp.responseText;
			//Codigo js 2
		}
	  }
	  
	xmlhttp.open("POST",url,true);
	//modificar --
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//xmlhttp.send("fname=Henry&lname=Ford");
}

function ajaxCalendarGetLastID()
{
	var xmlhttp;
	var response;
	  
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  }
	  
	else
	  {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//Codigo js 1
			//document.getElementById(id_element).innerHTML=xmlhttp.responseText;
                        return xmlhttp.responseText;
			//Codigo js 2
		}
	  }
	  
	xmlhttp.open("GET","/Gineobs/Evento/?id=1",true);
	//modificar --
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//xmlhttp.send("fname=Henry&lname=Ford");
}

/*
<body>

<h3>Start typing a name in the input field below:</h3>
<form action=""> 
First name: <input type="text" id="txt1" onkeyup="showHint(this.value)" />
</form>
<p>Suggestions: <span id="txtHint"></span></p> 

</body>
</html>
*/
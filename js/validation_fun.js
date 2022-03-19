// JavaScript Document

var p1;

function val_num(field,alerttext)

{

	var numpattern=/^[0-9]+$/;              

	var confirm=field.value;

	with(field)

	{

		if(value==""||value==null||value<1||value>99)

		{alert(alerttext); return false;}

		if(!confirm.value.match(numpattern)){	alert(alerttext); return false;}

		return true;

	}

}



function val_text(field,alerttext)
{
	var numpattern=/^[a-zA-Z._]+$/;              

	var confirm=field.value;

	with(field)

	{
		if(value==""||value==null||value.length<2)

		{alert(alerttext); return false;}

		if(!confirm.value.match(numpattern)){	alert(alerttext); return false;}
		return true;

	}
}


	function val_password1(field,alerttext)

	{

        var addresspattern=/^[a-zA-Z0-9"][a-zA-Z0-9"-,;.]*$/;              

		var confirm=field.value;

		with(field)

			  {

				  if(value==""||value==null||value.length<4)

				  {alert(alerttext); return false;}

				  if(!confirm.value.match(addresspattern)){	alert(alerttext); return false;}

					return true;

		      }

	}

	function confirmpassword1(field,p2,alerttext)

	{

        var addresspattern=/^[a-zA-Z0-9"][a-zA-Z0-9"-,;.]*$/;              

		var confirm=field.value;

		if(!confirm.match(p2))

		{	alert(alerttext); return false;}

		else if(!confirm.value.match(addresspattern)){	alert(alerttext); return false;}

		return true;

	}



function address1(field,alerttext)

	{

        var addresspattern=/^[a-zA-Z0-9"][a-zA-Z0-9"-/,;.]*$/;

		var addr=field.value;

		if(addr.value.match(addresspattern))

		{alert(alerttext); return false;}

				  return true;

		}

	}



function email1(field, altertext)

	{

		

        var emailpattern1=/^[a-zA-Z0-9_.]+@[a-zA-Z0-9_.-]+.([a-zA-Z]+)$/;  

		//var emailpattern2=/^([a-zA-Z0-9_.])+@([a-zA-Z0-9_.-])+.([a-zA-Z]){2}+.([a-zA-Z]){2}/;  

		var emailid=field.value;

		if(emailid.value.match(emailpattern1))

		{alert(alerttext); return false;}

				  return true;

		}


function check_captcha()

{

	xmlhttp=new XMLHttpRequest();	

	xmlhttp.onreadystatechange=function()

	  {

	  if (xmlhttp.readyState==4 && xmlhttp.status==200)

	    {

	    document.getElementById("desc").innerHTML=xmlhttp.responseText;

	    }

	  }

	xmlhttp.open("POST","clearingq.jsp",true);

	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	xmlhttp.send("env="+envcode);	

//document.form1.action="http://captchator.com/captcha/check_answer//"+<%=session.getId()%>+"//"+document.getElementById("captchares");
}	


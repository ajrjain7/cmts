// JavaScript Document
var p1;
function check_custid()
{
	var numpattern=/^[0-9]+$/;              
	var c1=document.getElementById("custid").value;
	var alerttext="Invalid Customer ID";
		if(c1==""||c1==null||c1<1)
		{alert(alerttext); return false;}		
		if(!c1.match(numpattern))
		{alert(alerttext); return false;}
		document.getElementById("process").src="./images/loading.gif";
		xmlhttp=new XMLHttpRequest();	
		xmlhttp.onreadystatechange=function()
	  	{
	  if(xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		    document.getElementById("desc").innerHTML=xmlhttp.responseText;
			document.getElementById("process").src="./images/blank.png";
	    }
	  	}
	xmlhttp.open("POST","./php/check_custid.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("custid="+c1);	
	return true;
}

function validate_sp()
{
	var numpattern=/^[a-zA-Z._]+$/;              
	var field=document.getElementById("item_p").value;
	var field1=document.getElementById("total_bill").value;
	var field3=document.getElementById("paid").value;
	var field4=document.getElementById("net_bal").value;
	var field5=document.getElementById("dos").value;
	if(field=="")
	{
		alert("Invalid Purchased Item Name");	
		return false;
	}
	if(field1<1)
	{
				alert("Invalid Total Bill");	
		return false;
	}
	if(field5=="")
	{
				alert("Invalid Date");	
		return false;
	}
	if(field3<0)
	{
				alert("Invalid Paid Amount");	
		return false;
	}
	if(field4<0)
	{
				alert("Invalid Interest Rate");	
		return false;
	}	
	document.getElementById("process").src="images/loading.gif";
	return true;
}

function validate_m()
{
	var numpattern=/^[a-zA-Z._]+$/;              
	var field=document.getElementById("item_p").value;
	var field1=document.getElementById("item_wt").value;
	var field3=document.getElementById("exchange_amt").value;
	var field4=document.getElementById("interest").value;
	var field5=document.getElementById("net_bal").value;
	if(field=="")
	{
		alert("Invalid Mortgage Item Name");	
		return false;
	}
	if(field1<1)
	{
				alert("Invalid Wt");	
		return false;
	}
	if(field3<1)
	{
				alert("Invalid Exchange Amount");	
		return false;
	}
	if(field4<0)
	{
				alert("Invalid Interest");	
		return false;
	}
	if(field5<0)
	{
				alert("Invalid Net balance");	
		return false;
	}	
	document.getElementById("process").src="images/loading.gif";
	return true;
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


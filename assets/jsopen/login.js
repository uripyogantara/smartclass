$(document).ready(function()
{		
new materialTouch('.md-ripple');
$("#username").change(function() 
{ 

var username = $("#username").val();
var msgbox = $("#status");

if(username.length >= 3)
{
$("#status").html('<div class="checking">Checking availability...</div>');

$.ajax({  
    type: "POST",  
    url: "check_username.php",  
    data: "username="+ username,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 
   
   var d = msg;
var str=msg.substr(0, 2);

    $("#status").html("");
	if(str == 'OK')
	{ 
	    $("#username").removeClass("no");
	    $("#username").addClass("yes");
       // msgbox.html(' <font color="Green"> Available </font>  ');
	}  
	else  
	{  
	     $("#username").removeClass("yes");
		 $("#username").addClass("no");
		msgbox.html(msg);
	}  
   
   });
   } 
   
  }); 

}
else
{
 $("#username").addClass("no");
$("#status").html('<div class="error">Enter a valid user name</div>');
}



return false;
});

$("#email").change(function() 
{ 

var email = $("#email").val();
var msgbox = $("#estatus");

if(email.length >= 3)
{
$("#estatus").html('<div class="checking">Checking availability...</div>');

$.ajax({  
    type: "POST",  
    url: "check_email.php",  
    data: "email="+ email,  
    success: function(msg){  
   
   $("#estatus").ajaxComplete(function(event, request, settings){ 
   
   var d = msg;
var str=msg.substr(0, 2);

    $("#estatus").html('');
	if(str == 'OK')
	{ 
	    $("#email").removeClass("no");
	    $("#email").addClass("yes");
        //msgbox.html('<font color="Green"> Ok </font>  ');
	}  
	else  
	{  
	     $("#email").removeClass("yes");
	     $("#email").addClass("no");
	     msgbox.html(msg);
	}  
   
   });
   } 
   
  }); 

}
else
{
 $("#email").addClass("no");
$("#estatus").html('<div class="error">Enter a valid e-mail</div>');
}



return false;
});



$.validator.addMethod("email", function(value, element) {  
    return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);  
    }, "<div class='validator'>Pelase Enter a valid Email</div>");
     
	 $.validator.addMethod("username",function(value,element){
    return this.optional(element) || /^[a-zA-Z0-9_-]{3,16}$/i.test(value);  
    },"<div class='validator'>Use a minimum of 3 characters and a maximum of 15 leave space</div>");


    $.validator.addMethod("password",function(value,element){
    return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i.test(value);  
    },"<div class='validator'>Your password can be a minimum of 6 and maximum of 16 characters.</div>");


    
        // Validate signup form
        $("#signup").validate({
                rules: {
                        email: "required email",
			username: "required username",
                        password: "required password",

                },
				

        });
		
		

});
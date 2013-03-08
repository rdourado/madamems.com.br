var folderLocation = location.host == 'localhost' ? '/kokfashion/madamems/www/' : '/novo/logado/';
var serverLocation = location.host == 'localhost' ? location.protocol + '//' + location.host + folderLocation : location.protocol + '//' + location.host + folderLocation;

$(document).ready(function() 
{
	
	$("#signin").submit(function(){
		if(validate())
		{
			$.ajax({
				url: serverLocation + "index.php?/services/auth/login/",
				type: "POST",
				async: false,
				data: {email: $("#username").val(), password: $("#password").val()},
				success: function(data) {
					if(data == "1")
					{
						window.location.href = serverLocation + "index.php?/home";
					}else
					{
						alert("Login ou senha inválidos.");
					}
				}
			});
		}
		return false;
	});
	
	$("#resend_password_link").click(function(){
		if(validateForget())
		{
			$.ajax({
				url: serverLocation + "index.php?/services/auth/recoverPassword/",
				type: "POST",
				async: false,
				data: {email: $("#username").val()},
				success: function(data) {
					if(data == "1")
					{
						alert("Uma nova senha foi enviada para o e-mail cadastrado.");
					}else
					{
						alert("Ocorreu um erro no envio de sua senha.");
					}
				}
			});
		}
		return false;
	});
	
	var validateForget = function (){
		if(!isEmail($("#username").val()))
		{
			alert("Preencha seu e-mail.");
			$("#username").focus();
			return false;
		}
		return true;
	};
	
	var validate = function (){
		if(!isEmail($("#username").val()))
		{
			alert("Preencha seu e-mail.");
			$("#username").focus();
			return false;
		}
		if($("#password").val() == "")
		{
			alert("Preencha sua senha.");
			$("#password").focus();
			return false;
		}
		return true;
	};
	
	var isEmail = function (value){
		var emailExpression = new RegExp(/^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i);
		return emailExpression.exec(value);
	};
	
	$("#resend_password_link").hide();
});
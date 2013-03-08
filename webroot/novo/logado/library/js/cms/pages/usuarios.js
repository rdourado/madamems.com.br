var PostData = new Object();
PostData.id = "";

$(document).ready(function() 
{
        buildList();
	$("#usuarios-form").submit(function(){
		if (validate())
		{
			var url = $('#usuarios-form').attr('insert-id') == "" ? serverLocation + "index.php?/services/cmsusuarios/insert" : serverLocation + "index.php?/services/cmsusuarios/update";
			$.ajax({
				url: url,
				type: 'POST',
				async: false,
				data: "name=" + $("#text-name").val() + "&email=" + $("#text-email").val() + "&password=" + $("#text-password").val() + "&id=" + $('#usuarios-form').attr('insert-id'),
				success: function(data)
				{
				    $('#notification').html('Dados inseridos com sucesso');
				    $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
				    $('#notification').animate({marginTop: "-70px"}, 1000);
				    buildList();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				    $('#notification').html('Ocorreu um erro no envio dos dados');
				    $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
				    $('#notification').animate({marginTop: "-70px"}, 1000);
				}
			    });
		}
		return false;
	})
	
});

/*
 * GENERAL FUNCTIONS
 */
function buildList()
{
   $.ajax({
        url: serverLocation + "index.php?/services/cmsusuarios/buildList",
        type: "POST",
        async: false,
        success: function(data) 
        {
            $("#list-users").html(data);
	    $(".buttonsDelete").click(function(event)
	    {
		PostData.deleteId = $(this).attr('rel');
		if (window.confirm("Deseja excluir este usuário?"))
		{
		    $.ajax({
			url: serverLocation + "index.php?/services/cmsusuarios/delete",
			type: 'POST',
			async: false,
			data: "id=" + PostData.deleteId,
			success: function(data)
			{
			    $("#userItem_" + PostData.deleteId).remove();
			    $('#notification').html('O usuário foi excluído com sucesso');
			    $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
			    $('#notification').animate({marginTop: "-70px"}, 1000);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			    window.alert(errorThrown);
			}
		    });
		}
	    });
	    $(".buttonsEdit").click(function(event)
	    {
		window.location.href = serverLocation + "index.php?/cms/usuarios?id=" + $(this).attr('rel');
	    });
        }
    });
}

function validate()
{

	if (!isFullname($("#text-name").val()))
	{
		alert("Insira seu nome de usuário")
		$("#text-name").focus();
		return false;
	} 
	else if (!isEmail($("#text-email").val()))
	{
		alert("Insira seu e-mail")	
		$("#text-email").focus();
		return false;
	} 
	else if (!isNull($("#text-password").val()))
	{
		alert("Insira sua senha")
		$("#text-password").focus();
		return false;
	}
	else {
		return true;
	}
}

/*
 * VALIDATION FUNCTIONS
 */

function isNull(value) {
	if (value.length == 0) return false;
	return true;
}

function isFullname(value)
{
	if(!isNull(value)) return false;
	if (value.indexOf("") == -1) return true;
	var temp_array = value.split(" ");
	for (i = 0; i < temp_array.length; i++) {
		if(temp_array[i].length < 2) return false;
	}
	return true;
}

function isEmail(value)
{
	var emailExpression = new RegExp(/^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i);
	return emailExpression.exec(value);
}
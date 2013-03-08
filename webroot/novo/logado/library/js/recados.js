$(document).ready(function() 
{
	var scraps;
	var page;
	var totalPages;
	
	$("#submitScrap").click(function(){
		if(validate())
		{
			$.ajax({
				url: serverLocation + "index.php?/services/media/addScrap/",
				type: "POST",
				async: false,
				data: {message: $("#message").val()},
				success: function(data) {
					if(parseInt(data) > 0)
					{
						alert("Mensagem enviada com sucesso.");
						$("#message").val("");
					}else
					{
						alert("Ocorreu um erro no envio de seus dados.");
					}
				}
			});
		}
		return false;
	});
	
	var validate = function (){
		if($("#message").val() == "")
		{
			alert("Preencha sua mensagem.");
			$("#message").focus();
			return false;
		}
		return true;
	};
	
	var createPagination = function()
	{
		page = 0;
		$("#pagination").empty();
		if(scraps.length > perPage)
		{
			$("#pagination").append("<span>Páginas: </span>");
			totalPages = Math.ceil(scraps.length / perPage);
			for (i = 0; i < totalPages; i++) 
			{
				$("#pagination").append("<div rel=\"" + i + "\">" + parseInt(i + 1) + "</div>")
			}
			
			$("#pagination div").click(function()
			{
				page = parseInt($(this).attr("rel"));
				paginate();
			});
		}
	};
	
	var paginate = function()
	{
		var init = parseInt(page * perPage);
		var end = parseInt(page * perPage + perPage);
		$(".content-list").empty();
		for (i = init; i < end; i++) 
		{
			if(scraps[i])
			{
				$(".content-list").append("<li><p>" + scraps[i].message + "</p><div class=\"quem2\"><strong>Por: " + scraps[i].name + "</strong><span class=\"fright\"> em " + scraps[i].date + "</span></div></li>");
			}
		}
	};
	
	$.ajax({
		url: serverLocation + "index.php?/services/media/getScraps/",
		dataType: 'json',
		success: function(data)
		{
			$(".area1").removeClass("loading");
			scraps = data;
			createPagination();
			paginate();
		}
	});
	$(".area1").addClass("loading");
});
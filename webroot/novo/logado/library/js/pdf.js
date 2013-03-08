$(document).ready(function() 
{
	var files;
	var page;
	var totalPages;
	
	var createPagination = function()
	{
		page = 0;
		$("#pagination").empty();
		if(files.length > perPage)
		{
			$("#pagination").append("<span>Páginas: </span>");
			totalPages = Math.ceil(files.length / perPage);
			for (i = 0; i < totalPages; i++) 
			{
				$("#pagination").append("<div rel=\"" + i + "\">" + parseInt(i + 1) + "</div>")
			}
			
			$("#pagination div").click(function()
			{
				$("#pagination div").removeClass("selected");
				page = parseInt($(this).attr("rel"));
				paginate();
				$(this).addClass("selected");
			});
		}
	};
	
	var paginate = function()
	{
		var init = parseInt(page * perPage);
		var end = parseInt(page * perPage + perPage);
		$(".area1 .ulpdf3").empty();
		for (i = init; i < end; i++) 
		{
			if(files[i])
			{
				$(".area1 .ulpdf3").append("<li><a href=\"" + serverLocation + "library/uploads/" + files[i].content + ".pdf\" target=\"_blank\">" + files[i].title + "</a><span class=\"right\">" + files[i].date + "</span><div class=\"clear\"></div></li>");
			}
		}
	};
	
	$("#order-title").click(function()
	{
		var order = $(this).attr("rel") == "" || $(this).attr("rel") == "desc" ? "asc" : "desc";
		$(this).attr("rel", order);
		$.ajax({
			url: serverLocation + "index.php?/services/media/getByType/3/media.title/" + order,
			dataType: 'json',
			success: function(data)
			{
				$(".area1").removeClass("loading");
				files = data;
				if(files.length > 0)
				{
					createPagination();
					paginate();
				}else
				{
					$(".area1").html("Não há arquivos cadastrados no momento.");
				}
			}
		});
		$(".area1").addClass("loading");
	});
	
	$("#order-date").click(function()
	{
		var order = $(this).attr("rel") == "" || $(this).attr("rel") == "desc" ? "asc" : "desc";
		$(this).attr("rel", order);
		$.ajax({
			url: serverLocation + "index.php?/services/media/getByType/3/media.createdOn/" + order,
			dataType: 'json',
			success: function(data)
			{
				$(".area1").removeClass("loading");
				files = data;
				if(files.length > 0)
				{
					createPagination();
					paginate();
				}else
				{
					
					$(".area1").html("Não há arquivos cadastrados no momento.");
				}
			}
		});
		$(".area1").addClass("loading");
	});
	
	$.ajax({
		url: serverLocation + "index.php?/services/media/getByType/3/media.createdOn/desc",
		dataType: 'json',
		success: function(data)
		{
			$(".area1").removeClass("loading");
			files = data;
			if(files.length > 0)
			{
				createPagination();
				paginate();
			}else
			{
				$(".area1").html("Não há arquivos cadastrados no momento.");
			}
		}
	});
	$(".area1").addClass("loading");
});
$(document).ready(function() 
{
	var videos;
	var page;
	var totalPages;
	perPage = perPage * 3;
	
	var createPagination = function()
	{
		page = 0;
		$("#pagination").empty();
		if(videos.length > perPage)
		{
			$("#pagination").append("<span>Páginas: </span>");
			totalPages = Math.ceil(videos.length / perPage);
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
		$(".content-list").empty();
		for (i = init; i < end; i++) 
		{
			if(videos[i])
			{
				$(".content-list").append("<li class=\"video-thumb\" rel=\"" + serverLocation + "library/uploads/" + videos[i].content + ".mp4\">" + videos[i].title + "<span class=\"right\">" + videos[i].date + "</span><div class=\"clear\"></div></li>");
			}
		}
		
		$(".content-list li").click(function(){
			if (navigator.userAgent.indexOf("Firefox") != -1 || navigator.userAgent.indexOf("MSIE") != -1) 
			{
				$('#video').html('<object width="610" height="460" type="application/x-shockwave-flash" data="' + serverLocation + 'library/swf/flowplayer-3.2.10.swf"><param name="movie" value="' + serverLocation + 'library/swf/flowplayer-3.2.10.swf" /><param name="allowfullscreen" value="true" /><param name="flashvars" value="config={\'clip\' : { \'url\' : \'' + $(this).attr("rel") + '\', \'autoPlay\' : true, \'autoBuffering\' : true } }" /></object>');
			} 
			else 
			{
				$('#video').html('<video width="610" height="460" controls autoplay="autoplay"><source src="' + $(this).attr("rel") + '"></video>');
			}
			$(".content-list li").removeClass("selected");
			$(this).addClass("selected");
		});
	};
	
	$("#order-title").click(function()
	{
		$(".content-list").empty();
		var order = $(this).attr("rel") == "" || $(this).attr("rel") == "desc" ? "asc" : "desc";
		$(this).attr("rel", order);
		$.ajax({
			url: serverLocation + "index.php?/services/media/getByType/2/media.title/" + order,
			dataType: 'json',
			success: function(data)
			{
				$(".area1").removeClass("loading");
				videos = data;
				if(videos.length > 0)
				{
					createPagination();
					paginate();
				}else
				{
					$(".content-list").html("Não há vídeos cadastrados no momento.");
				}
			}
		});
		$(".area1").addClass("loading");
	});
	
	$("#order-date").click(function()
	{
		$(".content-list").empty();
		var order = $(this).attr("rel") == "" || $(this).attr("rel") == "desc" ? "asc" : "desc";
		$(this).attr("rel", order);
		$.ajax({
			url: serverLocation + "index.php?/services/media/getByType/2/media.createdOn/" + order,
			dataType: 'json',
			success: function(data)
			{
				$(".area1").removeClass("loading");
				videos = data;
				if(videos.length > 0)
				{
					createPagination();
					paginate();
				}else
				{
					$(".content-list").html("Não há vídeos cadastrados no momento.");
				}
			}
		});
		$(".area1").addClass("loading");
	});
	
	$.ajax({
		url: serverLocation + "index.php?/services/media/getByType/2/media.createdOn/desc",
		dataType: 'json',
		success: function(data)
		{
			$(".area1").removeClass("loading");
			videos = data;
			if(videos.length > 0)
			{
				createPagination();
				paginate();
			}else
			{
				$(".content-list").html("Não há vídeos cadastrados no momento.");
			}
			
		}
	});
	$(".area1").addClass("loading");
});
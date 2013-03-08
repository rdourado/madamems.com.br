$(document).ready(function() 
{
	var photos;
	var page;
	var totalPages;
	perPage = perPage * 3;
	
	var createPagination = function()
	{
		page = 0;
		$("#pagination").empty();
		if(photos.length > perPage)
		{
			$("#pagination").append("<span>Páginas: </span>");
			totalPages = Math.ceil(photos.length / perPage);
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
		$(".image-list ul").empty();
		for (i = init; i < end; i++) 
		{
			if(photos[i])
			{
				$(".image-list ul").append("<li><a href=\"" + serverLocation + "library/uploads/" + photos[i].content + ".jpg\" class=\"highslide thumb\" onclick=\"return hs.expand(this, {captionId: '" + photos[i].title + "'})\"><img src=\"" + serverLocation + "timthumb.php?src=" + serverLocation + "library/uploads/" + photos[i].content + ".jpg&w=95&h=95\" class=\"foto\" /></a><div class=\"imageTitle\">" + photos[i].title + "</div></li>");
			}
		}
		$(".image-list").append("<div class=\"clear\"></div>");
	};
	
	var getImages = function()
	{
		$(".image-list ul").empty();
		$(".area1").addClass("loading");
		var order = $("#imageFilter").val() == "media.createdOn" ? "desc" : "asc"
		$.ajax({
			url: serverLocation + "index.php?/services/media/getByType/1/" + $("#imageFilter").val() + "/" + order,
			dataType: 'json',
			success: function(data)
			{
				$(".area1").removeClass("loading");
				photos = data;
				if(photos.length > 0)
				{
					createPagination();
					paginate();
				}else
				{
					$(".image-list").html("Não há fotos cadastradas no momento.");
				}
			}
		});
	
	}
	
	$("#imageFilter").change(function()
	{
		getImages();
	})
	
	getImages();
	
});
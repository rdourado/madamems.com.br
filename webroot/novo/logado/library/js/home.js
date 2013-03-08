$(document).ready(function() 
{
	$.ajax({
		url: serverLocation + "index.php?/services/media/getLastScraps/1",
		dataType: 'json',
		success: function(data)
		{
			$("#scrap-home").removeClass("loading");
			var scrap = data;
			$("#scrap-home p").html(scrap[0].message.substr(0, 280));
			$("#scrap-home .quem").html(scrap[0].name + ", em " + scrap[0].date);
		}
	});
	
	$.ajax({
		url: serverLocation + "index.php?/services/media/getLastMedia/1/10",
		dataType: 'json',
		success: function(data)
		{
			$("#home-photos").removeClass("loading");
			var photos = data;
			$("#home-photos").empty();
			for (i = 0; i < photos.length; i++) 
			{
				$("#home-photos").append("<a href=\"" + serverLocation + "library/uploads/" + photos[i].content + ".jpg\" class=\"highslide thumb\" onclick=\"return hs.expand(this, {captionId: ''})\"><img src=\"" + serverLocation + "timthumb.php?src=" + serverLocation + "library/uploads/" + photos[i].content + ".jpg&w=95&h=95\" class=\"foto\" /></a>");
			}
		}
	});
	
	$.ajax({
		url: serverLocation + "index.php?/services/media/getLastMedia/3/2",
		dataType: 'json',
		success: function(data)
		{
			$(".area3").removeClass("loading");
			var pdfs = data;
			$(".area3 ul").empty();
			for (i = 0; i < pdfs.length; i++) 
			{
				$(".area3 ul").append("<li><a href=\"" + serverLocation + "library/uploads/" + pdfs[i].content + ".pdf\" target=\"_blank\">" + pdfs[i].title + "</a></li>");
			}
		}
	});
	
	$("#scrap-home").addClass("loading");
	$("#home-photos").addClass("loading");
	$(".area3").addClass("loading");
});
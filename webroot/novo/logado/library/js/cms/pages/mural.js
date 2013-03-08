$(document).ready(function() 
{
	$('button.up').click(function() 
	{
		if (!$(this).hasClass("disabled")) changeStatus($(this).attr("id"), 1);
	})
	
	$('button.down').click(function() 
	{
		if (!$(this).hasClass("disabled")) changeStatus($(this).attr("id"), 2);
	})
	
	$('.lightbox').click(function() {
		$('#lightbox').fadeIn("fast");
		$('#lightbox .holder').html('<img src="' + $(this).attr("src") + '" />');
	})
	
	$("#lightbox .close").click(function() {
		$("#lightbox").fadeOut();
	});
});

function changeStatus(id, status) 
{
	var postdata = new Object;
	postdata.id = id;
	postdata.status = status;
	
        $.ajax({
            url: serverLocation + "index.php?/services/cmsmural/changeStatus",
            type: "POST",
            async: false,
            data: postdata,
            success: function(data) {
		$notificationMessage = status == 1 ? "Frase aprovada com sucesso" : "Frase reprovada com sucesso";
                $('#item_' + postdata.id).fadeOut('slow');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $notificationMessage = "Erro aprovando dados";
            }
        });

        $('#notification').html($notificationMessage);
        $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
        $('#notification').animate({marginTop: "-70px"}, 1000);
}
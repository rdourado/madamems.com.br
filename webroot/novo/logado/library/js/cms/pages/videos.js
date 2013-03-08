var videoPostData = new Object();
videoPostData.id = "";
var filename = "";

$(document).ready(function() 
{
        buildVideoList();
	
        $('#uploadifyMOV').uploadify(
        {
                'uploader'       : serverLocation + 'library/swf/uploadify.swf',
                'script'         : serverLocation + 'index.php?/services/uploadify/upload',
                'cancelImg'      : serverLocation + 'library/images/cancel.png',
                'fileDesc'       : 'MP4',
                'fileExt'        : '*.mp4;*.MP4;',
                'folder'         : folderLocation + 'library/uploads',
                'queueID'        : 'queueMOV',
                'auto'           : true,
                'multi'          : false,
                'buttonText'     : 'Escolher Video',
		'sizeLimit'      : 16485760,
                'onComplete'     : function(event, queueID, fileObj, response) 
                {
			filename = response;
                },
		'onError'     : function(event, queueID, fileObj, response) 
                {
			$('#uploadifyMOV').uploadifyClearQueue();
                        alert("Envie um vídeo com tamanho inferior a 10MB");
                }
        });
	
	var validate = function(){
		if ($("#title").val() == ""){
			alert('Preencha o título do vídeo.');
			return false;
		}
		if(filename == ""){
			alert('Selecione seu vídeo.');
			return false;
		}
		return true;
	};
	
	var sendForm = function(){
		if(validate()){
			$.ajax({
				url: serverLocation + "index.php?/services/media/addMedia/",
				type: "POST",
				async: false,
				data: {filename: filename, title: $("#title").val(), type: "2"},
				success: function(data) {
					if(parseInt(data) > 0)
					{
						$('#notification').html('O vídeo foi inserido com sucesso');
					        $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
					        $('#notification').animate({marginTop: "-70px"}, 1000);
						buildVideoList();
						reset();
					}else
					{
						$('#notification').html('Ocorreu um erro no envio do seu vídeo');
						$('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
						$('#notification').animate({marginTop: "-70px"}, 1000);
					}
				}
			});
		}
	};
	
	var reset = function(){
		$("#title").val("");
		filename = ""
	};
	
	$("#submit").click(function(){
		sendForm();
		return false;
	})
});

/*
 * GENERAL FUNCTIONS
*/
 
function buildVideoList()
{
   $.ajax({
        url: serverLocation + "index.php?/services/cmsvideos/buildVideoList",
        type: "POST",
        async: false,
        success: function(data) 
        {
            $("#list-files").html(data);
	    $(".buttonsVideoDelete").click(function(event)
	    {
		videoPostData.deleteId = $(this).attr('rel');
		if (window.confirm("Deseja excluir este vídeo?"))
		{
		    $.ajax({
			url: serverLocation + "index.php?/services/cmsvideos/delete",
			type: 'POST',
			async: false,
			data: "id=" + videoPostData.deleteId,
			success: function(data)
			{
			    $("#videoItem_" + videoPostData.deleteId).remove();
			    $('#notification').html('O vídeo foi excluído com sucesso');
			    $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
			    $('#notification').animate({marginTop: "-70px"}, 1000);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			    window.alert(errorThrown);
			}
		    });
		}
	    });
		    $("#content .list li").click(function(){
			if (navigator.userAgent.indexOf("Firefox") != -1 || navigator.userAgent.indexOf("MSIE") != -1) 
			{
				$('#video').html('<object width="320" height="240" type="application/x-shockwave-flash" data="' + serverLocation + 'library/swf/flowplayer-3.2.10.swf"><param name="movie" value="' + serverLocation + 'library/swf/flowplayer-3.2.10.swf" /><param name="allowfullscreen" value="true" /><param name="flashvars" value="config={\'clip\' : { \'url\' : \'' + $(this).attr("rel") + '\', \'autoPlay\' : true, \'autoBuffering\' : true } }" /></object>');
			} 
			else 
			{
				$('#video').html('<video width="320" height="240" controls autoplay="autoplay"><source src="' + $(this).attr("rel") + '"></video>');
			}
		});
        }
    });
}
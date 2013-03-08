var imagePostData = new Object();
imagePostData.id = "";
var filename = "";

$(document).ready(function() 
{
        buildImageList();
	
	$('#uploadifyIMG').uploadify(
        {
                'uploader'       : serverLocation + 'library/swf/uploadify.swf',
                'script'         : serverLocation + 'index.php?/services/uploadify/upload',
                'cancelImg'      : serverLocation + 'library/images/cancel.png',
                'fileDesc'       : 'Imagens',
                'fileExt'        : '*.jpg;',
                'folder'         : folderLocation + 'library/uploads',
                'queueID'        : 'queueIMG',
                'auto'           : true,
                'multi'          : false,
                'buttonText'     : 'Escolher foto',
		'sizeLimit'      : 10485760,
                'onComplete'     : function(event, queueID, fileObj, response) 
                {
			filename = response;
                },
		'onError'     : function(event, queueID, fileObj, response) 
                {
			$('#uploadifyIMG').uploadifyClearQueue();
                        alert("Ocorreu um erro no envio da sua foto.");
                }
        });
	
	var validate = function(){
		if ($("#title").val() == ""){
			alert('Preencha o título da foto.');
			return false;
		}
		if(filename == ""){
			alert('Selecione sua foto.');
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
				data: {filename: filename, title: $("#title").val(), type: "1"},
				success: function(data) {
					if(parseInt(data) > 0)
					{
						$('#notification').html('A foto foi inserida com sucesso');
					        $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
					        $('#notification').animate({marginTop: "-70px"}, 1000);
						buildImageList();
						reset();
					}else
					{
						$('#notification').html('Ocorreu um erro no envio da sua foto');
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
function buildImageList()
{
   $.ajax({
        url: serverLocation + "index.php?/services/cmsfotos/buildImageList",
        type: "POST",
        async: false,
        success: function(data) 
        {
            $("#list-images").html(data);
	    $(".buttonImagesDelete").click(function(event)
	    {
		imagePostData.deleteId = $(this).attr('rel');
		if (window.confirm("Deseja excluir esta foto?"))
		{
		    $.ajax({
			url: serverLocation + "index.php?/services/cmsfotos/deleteImage",
			type: 'POST',
			async: false,
			data: "id=" + imagePostData.deleteId,
			success: function(data)
			{
			    $("#imageItem_" + imagePostData.deleteId).remove();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			    window.alert(errorThrown);
			}
		    });
		}
	    });

        }
    });
}
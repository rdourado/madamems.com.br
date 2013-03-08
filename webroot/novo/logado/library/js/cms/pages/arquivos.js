var PostData = new Object();
PostData.id = "";
var filename = "";

$(document).ready(function() 
{
        buildList();
	
        $('#uploadifyPDF').uploadify(
        {
                'uploader'       : serverLocation + 'library/swf/uploadify.swf',
                'script'         : serverLocation + 'index.php?/services/uploadify/upload',
                'cancelImg'      : serverLocation + 'library/images/cancel.png',
                'fileDesc'       : 'PDF',
                'fileExt'        : '*.pdf;',
                'folder'         : folderLocation + 'library/uploads',
                'queueID'        : 'queuePDF',
                'auto'           : true,
                'multi'          : false,
                'buttonText'     : 'Escolher Arquivo',
		'sizeLimit'      : 10485760,
                'onComplete'     : function(event, queueID, fileObj, response) 
                {
                        filename = response;
                },
		'onError'     : function(event, queueID, fileObj, response) 
                {
			$('#uploadifyPDF').uploadifyClearQueue();
                        alert("Ocorreu um erro no envio de seu arquivo.");
                }
        });
	
	var validate = function(){
		if ($("#title").val() == ""){
			alert('Preencha o título do arquivo.');
			return false;
		}
		if(filename == ""){
			alert('Selecione seu arquivo.');
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
				data: {filename: filename, title: $("#title").val(), type: "3"},
				success: function(data) {
					if(parseInt(data) > 0)
					{
						$('#notification').html('O arquivo foi inserido com sucesso');
					        $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
					        $('#notification').animate({marginTop: "-70px"}, 1000);
						buildList();
						reset();
					}else
					{
						$('#notification').html('Ocorreu um erro no envio do seu arquivo');
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
function buildList()
{
   $.ajax({
        url: serverLocation + "index.php?/services/cmsarquivos/buildList",
        type: "POST",
        async: false,
        success: function(data) 
        {
            $("#list-files").html(data);
	    $(".buttonsDelete").click(function(event)
	    {
		PostData.deleteId = $(this).attr('rel');
		if (window.confirm("Deseja excluir este arquivo?"))
		{
		    $.ajax({
			url: serverLocation + "index.php?/services/cmsarquivos/delete",
			type: 'POST',
			async: false,
			data: "id=" + PostData.deleteId,
			success: function(data)
			{
			    $("#fileItem_" + PostData.deleteId).remove();
			    $('#notification').html('O arquivo foi excluído com sucesso');
			    $('#notification').animate({marginTop: "0px"}, 1000).delay(2000);
			    $('#notification').animate({marginTop: "-70px"}, 1000);
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
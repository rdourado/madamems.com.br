// JavaScript Document
$(document).ready(function()
{
    var postdata = new Object();

    $('#formLogin').submit(function()
    {
        $notificationMessage = "Processando...";

        postdata.username =  $("#username").val();
        postdata.password =  $("#password").val();

        if ($('#username').val() == "") {
            $notificationMessage = "Preencha o usu&aacute;rio corretamente";
        } else if ($('#password').val() == "") {
            $notificationMessage = "Preencha o password corretamente";
        } else {
            $.ajax({
                url: serverLocation + 'index.php?/services/cmsauth/login',
                type: "POST",
                async: false,
                data: postdata,
                success: function(data) {
                    if (data == false) {
                        $notificationMessage = "Usu&aacute;rio/Senha inv&aacute;lidos";
                    } else {
                        window.location.href = serverLocation + "index.php?/" + data;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    window.alert(textStatus);
                }
            });
        }

        $('#notification').html($notificationMessage);
        $('#notification').animate({ marginTop: "0px" }, 1000).delay(2000);
        $('#notification').animate({ marginTop: "-70px" }, 1000);
        
        return false;
    });
});
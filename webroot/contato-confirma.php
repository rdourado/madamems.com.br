<?php
$date = date("d/m/Y h:i");

// ****** ATENÇÃO ********
// ABAIXO ESTÁ A CONFIGURAÇÃO DO SEU FORMULÁRIO.
// ****** ATENÇÃO ********

// RECEBE OS VALORES VINDO DO FORMULÁRIO E ATRIBUI AS VARIÁVEIS
$nome = $_POST['nome'];
$email = $_POST['email'];
$textodamensagem = $_POST['textodamensagem'];

//CABEÇALHO - ONFIGURAÇÕES SOBRE SEUS DADOS E SEU WEBSITE
$nome_do_site="Madame Ms";
$email_para_onde_vai_a_mensagem = "contato@madamems.com.br";
$nome_de_quem_recebe_a_mensagem = "Madame Ms";
$exibir_apos_enviar='enviado.htm';

//MAIS - CONFIGURAÇOES DA MENSAGEM ORIGINAL
$cabecalho_da_mensagem_original="From: $name <$email>\n";
$assunto_da_mensagem_original="Contato no Site";

// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
// ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO *************
$configuracao_da_mensagem_original="

ENVIADO POR:<br>
Nome: $nome<br>
Email: $email<br>
Mensagem: $textodamensagem<br>
ENVIADO EM: $date

";

//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
// CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO
// "Re: $assunto"
$assunto_da_mensagem_de_resposta = "Confirmação";
$cabecalho_da_mensagem_de_resposta = "From: $nome_do_site < $email_para_onde_vai_a_mensagem>\n";
$configuracao_da_mensagem_de_resposta="Obrigado por entrar em contato!<br>Em breve responderemos sua mensagem.<br>Atenciosamente,<br>$nome_do_site<br><br>Enviado em: $date";

// ****** IMPORTANTE ********
// A PARTIR DE AGORA RECOMENDA-SE QUE NÃO ALTERE O SCRIPT PARA QUE O SISTEMA FINCIONE CORRETAMENTE
// ****** IMPORTANTE ********

//ESSA VARIAVEL DEFINE SE É O USUARIO QUEM DIGITA O ASSUNTO OU SE DEVE ASSUMIR O ASSUNTO DEFINIDO
//POR VOCÊ CASO O USUARIO DEFINA O ASSUNTO PONHA "s" NO LUGAR DE "n" E CRIE O CAMPO DE NOME
//'assunto' NO FORMULARIO DE ENVIO
$assunto_digitado_pelo_usuario="n";

//ENVIO DA MENSAGEM ORIGINAL
//$headers = "$cabecalho_da_mensagem_original";
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: $nome <contato@madamems.com.br>\n";
$headers .= "Return-Path: contato@madamems.com.br\n";
$headers .= "Reply-To: $email\n";

if($assunto_digitado_pelo_usuario=="n"){
$assunto = "$assunto_da_mensagem_original";
}
$seuemail = "$email_para_onde_vai_a_mensagem";
$mensagem = "$configuracao_da_mensagem_original";
mail("contato@madamems.com.br",$assunto,$mensagem,$headers);

//ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
//$headers = "$cabecalho_da_mensagem_de_resposta";
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: $nome <contato@madamems.com.br>\n";
$headers .= "Return-Path: contato@madamems.com.br\n";
$headers .= "Reply-To: $email\n";
if($assunto_digitado_pelo_usuario=="n"){
$assunto = "$assunto_da_mensagem_de_resposta";
}else{
$assunto = "Re: $assunto";
}

$mensagem = "$configuracao_da_mensagem_de_resposta";
mail("contato@madamems.com.br",$assunto,$mensagem,$headers);
echo "<script>window.location='$exibir_apos_enviar'</script>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Madame MS</title>
	<link href="<?=base_url();?>library/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>library/css/logged.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>library/css/uploadify.css" rel="stylesheet" type="text/css" />

	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="library/css/ie.css" />
	<![endif]-->

	<script src="<?=base_url();?>library/cufon/cufon-yui.js" type="text/javascript"></script> 
	<script src="<?=base_url();?>library/cufon/cufon-replace.js" type="text/javascript"></script> 
	<script src="<?=base_url();?>library/cufon/Sansumi_700-Sansumi-ExtraBold_800.font.js" type="text/javascript"></script> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="<?=base_url();?>library/js/swfobject.js" type="text/javascript"></script> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>library/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?=base_url();?>library/highslide/highslide.js"></script>
	<script src="<?=base_url();?>library/js/main.js" type="text/javascript"></script> 
	<?php
	/*
	* Local javascript definition
	*/
	if( isset ($local_js) )
	{
		echo "<script src=\"" . base_url() . "library/js/" . $local_js . "\"  type=\"text/javascript\"></script>\n";
	}
	?>
	
</head>

<body>
	<div id="topo">
		<div class="linha-topo"></div>
		<div class="topo-interna"><a href="/index.htm"><img src="<?=base_url();?>library/images/logo.png" width="290" height="32" border="0"  /></a>
			<div class="area">
				<div id="container">
					<div id="topnav" class="topnav"> área restrita <a href="login" class="signin"><span>login</span></a> </div>
					<fieldset id="signin_menu">
						<form method="post" id="signin" action="">
							<label for="username">Usuário:</label>
							<input id="username" name="username" value="" title="username" tabindex="4" type="text">
							<label for="password">Senha:</label>
							<input id="password" name="password" value="" title="password" tabindex="5" type="password">
							<a href="#" id="resend_password_link" class="forgot">Esqueceu sua senha?</a> 
							<p class="remember">
								<input id="signin_submit" value="ENTRAR" tabindex="6" type="submit">
							</p>
						</form>
					</fieldset>
				</div>
			</div>
		</div>
	</div>

	<div id="menu-paginas">
		<div class="menu-interna">
			<div class="redes">
				
			</div>
			<ul id="cssdropdown">
				<li class="headlink2"><a href="/index.htm">home</a></li>
				<li class="headlink2"><a href="/sobre.htm">sobre</a></li>
				<li class="headlink">
					<a href="/campanha.htm">Campanha</a>
					<ul>
						<li><a href="/campanha.htm">Inverno 2012</a></li>
					</ul>
				</li>
				<li class="headlink">
					<a href="/lookbook.htm">Lookbook</a>
					<ul id="fp_galleryList" class="fp_galleryList">
						<li><a href="/lookbook.htm#inverno_2012" class="inverno_2012">Inverno 2012</a></li>
					</ul>
				</li>
				<li class="headlink2"><a href="/lojas.htm">lojas</a></li>
				<li class="headlink2"><a href="/contato.htm">contato</a></li>
			</ul>
		</div>
	</div>

	<div id="principal">
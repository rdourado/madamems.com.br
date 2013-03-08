<div class="coluna-preta">
	<h2>Bem vindo, <?=$this->session->userdata("session_name");?></h2>
	<br />
	<br />
	<ul class="ulpainel"><li><a href="<?=base_url();?>index.php?/home/recados" >ver painel de recados</a></li></ul>
	<ul class="ulgaleria"><li><a href="<?=base_url();?>index.php?/home/fotos" >ver galeria de fotos</a></li></ul>
	<ul class="ulpdf"><li><a href="<?=base_url();?>index.php?/home/pdf" >ver arquivos em pdf</a></li></ul>
	<ul class="ulvideos"><li><a href="<?=base_url();?>index.php?/home/videos" >ver tv madame ms</a></li></ul>
	<ul class="ulsair"><li><a href="<?=base_url();?>index.php?/services/auth/logout" >sair</a></li></ul>
	
	<!--<h2>upload de imagens</h2>
	<form action="" method="post">
		<input type="file" name="uploadifyIMG" id="uploadifyIMG" />
		<div id="queueIMG"></div>
	</form>

	<h2>upload de arquivos</h2>
	<form action="" method="post">
		<input type="file" name="uploadifyPDF" id="uploadifyPDF" />
		<div id="queuePDF"></div>
	</form>
	
	<h2>upload de vídeos</h2>
	<form action="" method="post">
		<input type="file" name="uploadifyMOV" id="uploadifyMOV" />
		<div id="queueMOV"></div>
	</form>-->
</div>
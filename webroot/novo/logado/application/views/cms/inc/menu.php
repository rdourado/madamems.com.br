<ul id="sideMenu" class="menu" rel="<?=$_Tsection;?>">
	<li><?=anchor(base_url() . 'index.php?/cms/main', 'Home')?></li>
	<li><?=anchor(base_url() . 'index.php?/cms/arquivos', 'Arquivos')?></li>
	<li><?=anchor(base_url() . 'index.php?/cms/fotos', 'Galeria de fotos')?></li>
	<li><?=anchor(base_url() . 'index.php?/cms/videos', 'Galeria de v&iacute;deos')?></li>
	<li>
		<a href="#">Mural de recados</a>
		<ul<? if ($_Tsection == 'mural') echo " class=selected"; ?>>
			<li><?=anchor(base_url() . 'index.php?/cms/mural/novas', 'Novas mensagens')?></li>
			<li><?=anchor(base_url() . 'index.php?/cms/mural/aprovadas', 'Mensagens aprovadas')?></li>
			<li><?=anchor(base_url() . 'index.php?/cms/mural/reprovadas', 'Mensagens reprovadas')?></li>
		</ul>
	</li>
	<li><?=anchor(base_url() . 'index.php?/cms/usuarios', 'Usu&aacute;rios')?></li>
</ul>
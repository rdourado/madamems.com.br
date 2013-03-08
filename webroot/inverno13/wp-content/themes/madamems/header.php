<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen">
	<link rel="stylesheet" href="<?php t_url(); ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen">
	<link rel="stylesheet" href="<?php t_url(); ?>/js/jplayer/skin/black/style.css" media="screen">
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
</head>
<body <?php body_class( $post->post_name ); ?>>
	<header id="head">
		<?php my_logo(); ?>

		<?php wp_nav_menu( array(
			'container'       => 'nav',
			'container_id'    => 'nav',
			'menu_id'         => 'menu',
			'fallback_cb'     => false,
			'depth'           => 1,
		) ); ?>

		<a href="#signin" id="restricted"><img src="<?php t_url(); ?>/img/area-restrita.png" alt="Área Restrita" width="93" height="19"></a>
		<form action="/" id="signin">
			<fieldset>
				<legend>Área Restrita | Login</legend>
				<p class="field field-user">
					<label for="">Usuário</label>
					<input type="email" name="" id="">
				</p>
				<p class="field field-user">
					<label for="">Senha</label>
					<input type="email" name="" id="">
				</p>
				<p class="field field-submit">
					<button type="submit"><img src="<?php t_url(); ?>/img/submit.png" alt="Enviar" width="85" height="26"></button>
				</p>
			</fieldset>
		</form>

		<div class="fb-like" data-href="http://www.facebook.com/madamemsoficial" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		<a href="http://www.facebook.com/madamemsoficial" class="fb" target="_blank"><img src="<?php t_url(); ?>/img/icon-fb.png" alt="Facebook" width="25" height="25"></a>
	</header>
	<hr>

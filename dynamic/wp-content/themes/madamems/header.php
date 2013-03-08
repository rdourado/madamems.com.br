<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="/min/g=madamems-css" media="screen">
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
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

		<div class="fb-like" data-href="http://www.facebook.com/madamemsoficial" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		<a href="http://www.facebook.com/madamemsoficial" class="fb" target="_blank"><img src="<?php t_url(); ?>/img/icon-fb.png" alt="Facebook" width="25" height="25"></a>
	</header>
	<hr>

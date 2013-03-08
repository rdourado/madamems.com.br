<?php 
/*
Template name: Campanha
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>
		<div class="entry-content">
<?php 		$images = get_field( 'galeria' );
			if ( $images ) : ?>
			<ul class="lookbook-list slider">
<?php 			foreach( $images as $img ) : ?>
				<li class="lookbook-item"><?php echo wp_get_attachment_image( $img['id'], 'full' ); ?></li>
<?php 			endforeach; ?>
			</ul>
<?php 		endif; ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php is_ajax() ? json_content() : get_footer(); ?>
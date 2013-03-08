<?php is_ajax() ? ob_start() : get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php is_ajax() ? json_content() : get_footer(); ?>
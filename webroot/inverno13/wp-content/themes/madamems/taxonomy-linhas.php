<?php is_ajax() ? ob_start() : get_header(); ?>
	<article id="body" class="hentry">
<?php 	$term = get_term_by( 'slug', get_query_var( 'linhas' ), 'linhas' );
		$query = new WP_Query( 'page_id=8' );
		while( $query->have_posts() ) : $query->the_post(); ?>
		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>
		<ul class="entry-menu">
<?php 		wp_list_categories( array(
				'title_li' => '',
				'taxonomy' => 'linhas',
				'orderby' => 'count', 
				'order' => 'DESC',
				'use_desc_for_title' => false,
			) ); ?>
		</ul>
		<div class="entry-content">
			<p class="entry-excerpt"><?php 
			remove_filter( 'the_content', 'wpautop' );
			the_content();
			?></p>
<?php 		query_posts( "{$query_string}&posts_per_page=-1" );
			if ( have_posts() ) : ?>
			<ul class="lookbook-list slider" data-show="4">
<?php 			while( have_posts() ) : the_post(); ?>
				<li class="lookbook-item"><a href="<?php 
				$imageID = get_post_thumbnail_id( get_the_ID() );
				echo reset( wp_get_attachment_image_src( $imageID, 'full' ) );
				?>" class="fancybox"><?php 
				echo wp_get_attachment_image( $imageID, 'lookbook', false, array(
					'alt' => str_replace( "\n", ', ', get_field( 'referencias', get_the_ID() ) )
				) );
				?><span></span></a></li>
<?php 			endwhile; ?>
			</ul>
			<div class="linha-wrap">
				<div class="linha-container">
					<p class="linha-logo"><?php 
					$marca = get_field( 'marca', 'linhas_'. $term->term_id );
					echo wp_get_attachment_image( $marca, 'full' );
					?></p>
					<p class="linha-info"><?php echo nl2br( $term->description ); ?></p>
				</div>
			</div>
<?php 		endif; ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php is_ajax() ? json_content() : get_footer(); ?>
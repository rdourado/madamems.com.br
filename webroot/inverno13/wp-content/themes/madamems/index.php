<?php 
/*
Template name: Página Inicial
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
		<section id="highlight"<?php 
		$image = get_field( 'imagem' );
		if ( $image ) echo ' style="background-image:url(' . $image . ')"'; ?>>
			<a href="#occasion" class="anchor"><img src="<?php t_url(); ?>/img/skip.png" alt="pular para ocasião" width="73" height="31"></a>
			<h2 class="title">Inverno 2013</h2>
		</section>
		<section id="occasion">
			<h2 class="title">Qual é a sua ocasião?</h2>
			<p class="subtitle"><span>Escolha o look</span></p>
<?php 		$terms = get_terms( 'linhas', array( 
				'orderby' => 'count', 
				'order' => 'DESC',
				'number' => 4,
			) ); ?>
			<ul class="look-list">
<?php 			foreach( $terms as $term ) : ?>
				<li class="look-item">
					<a href="<?php echo get_term_link( $term ); ?>">
						<?php 
						$imagem = get_field( 'imagem', 'linhas_'. $term->term_id );
						echo wp_get_attachment_image( $imagem, 'lookbook' );
						?>
						<div class="look-label"><span><b><?php echo $term->name; ?></b></span></div>
					</a>
				</li>
<?php 			endforeach; ?>
			</ul>
		</section>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>
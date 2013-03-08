<?php 
/*
Template name: Contato
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>
		<div class="entry-content">
			<?php the_content(); ?>
			<div class="aside">
				<h2>Trabalhe Conosco</h2>
				<p>
					<a href="#">Envie seu currículo para nós.<br>
					Clique aqui e preencha seus dados.</a>
				</p>
			</div>
			<div class="newsletter newsletter-subscription">
				<form action="<?php echo home_url( '/wp-content/plugins/newsletter/do/subscribe.php' ); ?>" method="post" id="newsform" onsubmit="return newsletter_check(this)">
					<fieldset>
						<legend>Newsletter</legend>
						<p class="field textonly">Fique por dentro das novidades da Madame Ms.</p>
						<p class="field field-nome">
							<label for="nn">Nome</label>
							<input type="text" name="nn" id="nn" class="single newsletter-firstname" required aria-required="true">
						</p>
						<p class="field field-email">
							<label for="ne">Email</label>
							<input type="email" name="ne" id="ne" class="single fldemail newsletter-email" required aria-required="true">
						</p>
						<p class="field field-nome">
							<label for="np2">Data de nascimento</label>
							<input type="text" name="np2" id="np2" class="single newsletter-profile newsletter-profile-2" required aria-required="true">
						</p>
						<p class="field field-submit">
							<button type="submit"><img src="<?php t_url(); ?>/img/submit.png" alt="Enviar" width="85" height="26"></button>
						</p>
					</fieldset>
				</form>
			</div>
		</div>
<?php 	endwhile; ?>
	</article>
<?php is_ajax() ? json_content() : get_footer(); ?>
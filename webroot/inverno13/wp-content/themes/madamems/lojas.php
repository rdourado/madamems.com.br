<?php 
/*
Template name: Lojas
*/
$cidades = array();
$field_lojas = get_field( 'lojas' );
foreach( $field_lojas as $field ) {
	$cidade = trim( $field['cidade'] );
	$arr = array(
		'nome' => $field['nome'],
		'endereco' => $field['endereco'],
	);
	$cidades[$cidade] ? $cidades[$cidade][] = $arr : $cidades[$cidade] = array( $arr );
}
ksort( $cidades );
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<article id="body" class="hentry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>
		<div class="entry-content">
			<form action="" method="get" id="lojasform">
				<fieldset>
					<legend>Filtro</legend>
					<p class="field field-cidade">
						<label for="cidade">Escolha sua cidade</label>
						<select name="cidade" id="cidade">
<?php 						foreach( $cidades as $cidade => $lojas ) : ?>
							<option value="<?php echo sanitize_title( $cidade ); ?>"><?php echo $cidade; ?></option>
<?php 						endforeach; ?>
						</select>
					</p>
				</fieldset>
			</form>
			<div class="stores">
<?php 			foreach( $cidades as $cidade => $lojas ) : ?>
				<div id="<?php echo sanitize_title( $cidade ); ?>">
					<h2 class="state"><?php echo $cidade; ?></h2>
					<ul class="store-list">
<?php 					foreach( $lojas as $loja ) : ?>
						<li class="store-item">
							<h3 class="store-name"><?php echo trim( $loja['nome'] ); ?></h3>
							<p class="store-info"><?php echo trim( $loja['endereco'] ); ?></p>
						</li>
<?php 					endforeach; ?>
					</ul>
				</div>
<?php 			endforeach; ?>
			</div>
		</div>
<?php 	endwhile; ?>
	</article>
<?php is_ajax() ? json_content() : get_footer(); ?>
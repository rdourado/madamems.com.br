<?php 

require( '../../../wp-load.php' );

header( "Content-Type: application/vnd.ms-excel; charset=ISO-8859-1" );
header( 'Content-Disposition: attachment; filename="trabalhe-conosco.csv"' );

global $wpdb;

$sql = "SELECT `field_name`,`field_val` 
		FROM `madamems_cformsdata`,`madamems_cformssubmissions` 
		WHERE `id` = `sub_id` 
		AND `form_id` = %d 
		AND `field_name` != %s 
		AND `field_name` != %s 
		ORDER BY `f_id` ASC";
$rows = $wpdb->get_results( $wpdb->prepare( $sql, 2, 'page', 'Fieldset1' ) );

echo '"Nome";"Email";"Telefone fixo";"Telefone celular";"RG";"CPF";"Endereco";"Nascimento";"Formacao";"Area de interesse";"Experiencia profissional"';

foreach( $rows as $row ) {
	if ( $row->field_name == 'Nome' )
		echo "\n";
	echo '"' . sanitize_csv( is_numeric( $row->field_val ) ? "{$row->field_val} " : $row->field_val ) . '";';
}

echo "\n";

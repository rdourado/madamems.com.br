<?php 

$t_url = get_template_directory_uri();

function t_url() {
	global $t_url;
	echo $t_url;
}

function my_logo() {
	global $t_url;
	if ( is_front_page() )
		echo '<h1 id="logo"><a href="' . home_url( '/' ) . '"><img src="' . $t_url . '/img/madame-ms-white.png" alt="Madame Ms" width="238" height="50"></a></h1>';
	else 
		echo '<div id="logo"><a href="' . home_url( '/' ) . '"><img src="' . $t_url . '/img/madame-ms-black.png" alt="Madame Ms" width="238" height="50"></a></div>';
}

/* Setup */

add_action( 'after_setup_theme', 'my_setup' );

function my_setup() {
	register_nav_menu( 'primary', 'Menu' );
	add_image_size( 'lookbook', 240, 600, true );
}

/* Scripts */

add_action( 'wp_enqueue_scripts', 'my_scripts' );

function my_scripts() {
	$uri = get_stylesheet_directory_uri();

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.8.3.min.js"', array(), null, true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jplayer', "{$uri}/js/jplayer/jquery.jplayer.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'playlist', "{$uri}/js/jplayer/jplayer.playlist.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'gomus', "http://echo.gomus.com.br/player/mb.js?id=1735868546", array( 'jquery' ), null, true );
	wp_enqueue_script( 'login', "http://www.madamems.com.br/js/login.js", array( 'jquery' ), null, true );

	wp_enqueue_script( 'fancybox', "{$uri}/js/fancybox/jquery.fancybox-1.3.4.pack.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'maskedinput', "{$uri}/js/jquery.maskedinput.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'interface', "{$uri}/js/interface.js", array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/interface.js' ), true );
}

/* Admin */

add_action( 'admin_menu', 'remove_menus' );
//add_action( 'admin_init', 'remove_editor_capabilities' );
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function remove_menus() {
	global $menu;
	$restricted = array( __('Posts'), __('Media'), __('Tools'), __('Comments') );
	end ( $menu );
	while( prev( $menu ) ) {
		$value = explode( ' ', $menu[key( $menu )][0] );
		if ( in_array( $value[0] != NULL ? $value[0] : "" , $restricted ) )
			unset( $menu[key( $menu )] );
	}
}

function remove_editor_capabilities(){
	$editor = get_role( 'editor' );
	//$administrator = get_role( 'administrator' );

	$editor->remove_cap( 'edit_pages' );
	$editor->remove_cap( 'edit_others_pages' );
	$editor->remove_cap( 'edit_published_pages' );
	$editor->remove_cap( 'publish_pages' );
	$editor->remove_cap( 'delete_pages' );
	$editor->remove_cap( 'delete_others_pages' );
	$editor->remove_cap( 'delete_published_pages' );
	$editor->remove_cap( 'delete_private_pages' );
	$editor->remove_cap( 'edit_private_pages' );
	$editor->remove_cap( 'read_private_pages' );

	$editor->remove_cap( 'edit_posts' );
	$editor->remove_cap( 'edit_others_posts' );
	$editor->remove_cap( 'edit_published_posts' );
	$editor->remove_cap( 'publish_posts' );
	$editor->remove_cap( 'delete_posts' );
	$editor->remove_cap( 'delete_others_posts' );
	$editor->remove_cap( 'delete_published_posts' );
	$editor->remove_cap( 'delete_private_posts' );
	$editor->remove_cap( 'edit_private_posts' );
	$editor->remove_cap( 'read_private_posts' );

	//$editor->remove_cap( 'export_forms' );
	//$administrator->remove_cap( 'export_forms' );
}	

function my_login_logo() { ?>
<style type="text/css">
body.login { background: #5a1f4f }
body.login div#login h1 a {
	background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/madame-ms-white.png);
	background-size: auto;
	height: 50px;
	margin-left: auto;
	margin-right: auto;
	width: 238px;
}
.login #nav, 
.login #backtoblog { text-shadow: 0 0 0 #5a1f4f }
.login #nav a,
.login #backtoblog a { color: #fff !important }
.login #nav a:hover,
.login #backtoblog a:hover { color: #fff !important }
.wp-core-ui .button-primary {
	background: #5a1f4f;
	border-color: #5a1f4f;
}
.wp-core-ui .button-primary:hover {
	background: #3e3e3e;
	border-color: #3e3e3e;
}
</style>
<?php }

function my_login_logo_url() { return get_bloginfo( 'url' ); }
function my_login_logo_url_title() { return 'Ir para o início'; }

/* Content */

add_filter( 'the_content', 'my_content', 102 );

function my_content( $subject ) {
	global $t_url;
	return preg_replace( '/\<input type\=\"submit\".*?id\=\"(.*?)\".*?class\=\"(.*?)\".*?value\=\"(.*?)\".*?onclick\=\"(.*?)\"\/\>/', '<button type="submit" id="$1" class="$2" onclick="$4"><img src="' . $t_url . '/img/submit.png" alt="$3" width="85" height="26"></button>', $subject );
}

/* Ajax */

function is_ajax() {
	if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' && ! empty( $_GET['ajax'] ) )
		return true;
	return false;
}

function json_content() {
	$json = ob_get_contents();
	ob_end_clean();

	global $post;
	echo json_encode( array(
		'ID' => $post->ID,
		'slug' => is_front_page() ? 'home' : $post->post_name,
		'post_content' => $json,
	) );
}

/* Custom Post Type & Taxonomy */

add_action( 'init', 'register_cpt_look' );

function register_cpt_look() {

	$labels = array( 
		'name' => _x( 'Lookbook', 'look' ),
		'singular_name' => _x( 'Look', 'look' ),
		'add_new' => _x( 'Add New', 'look' ),
		'add_new_item' => _x( 'Add New Look', 'look' ),
		'edit_item' => _x( 'Edit Look', 'look' ),
		'new_item' => _x( 'New Look', 'look' ),
		'view_item' => _x( 'View Look', 'look' ),
		'search_items' => _x( 'Search Lookbook', 'look' ),
		'not_found' => _x( 'No lookbook found', 'look' ),
		'not_found_in_trash' => _x( 'No lookbook found in Trash', 'look' ),
		'parent_item_colon' => _x( 'Parent Look:', 'look' ),
		'menu_name' => _x( 'Lookbook', 'look' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'thumbnail', 'custom-fields' ),
		'taxonomies' => array( 'linhas' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'look', $args );
}

add_action( 'init', 'register_taxonomy_linhas' );

function register_taxonomy_linhas() {

	$labels = array( 
		'name' => _x( 'Linhas', 'linhas' ),
		'singular_name' => _x( 'Linha', 'linhas' ),
		'search_items' => _x( 'Search Linhas', 'linhas' ),
		'popular_items' => _x( 'Popular Linhas', 'linhas' ),
		'all_items' => _x( 'All Linhas', 'linhas' ),
		'parent_item' => _x( 'Parent Linha', 'linhas' ),
		'parent_item_colon' => _x( 'Parent Linha:', 'linhas' ),
		'edit_item' => _x( 'Edit Linha', 'linhas' ),
		'update_item' => _x( 'Update Linha', 'linhas' ),
		'add_new_item' => _x( 'Add New Linha', 'linhas' ),
		'new_item_name' => _x( 'New Linha', 'linhas' ),
		'separate_items_with_commas' => _x( 'Separate linhas with commas', 'linhas' ),
		'add_or_remove_items' => _x( 'Add or remove linhas', 'linhas' ),
		'choose_from_most_used' => _x( 'Choose from the most used linhas', 'linhas' ),
		'menu_name' => _x( 'Linhas', 'linhas' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'show_admin_column' => true,
		'hierarchical' => true,

		'rewrite' => true,
		'query_var' => true
	);

	register_taxonomy( 'linhas', array('look'), $args );
}

/* Exportar Formulários */

add_action( 'admin_menu', 'add_export_page' );

function add_export_page() {
	add_menu_page( 'Formulários', 'Formulários', 'moderate_comments', 'export-forms', 'create_export_page' );
}

function create_export_page() {
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>Exportar Formulários</h2>
		<p><a href="<?php bloginfo( 'template_url' ); ?>/export-form.php" target="_blank" class="button">Exportar formulário "Trabalhe Conosco"</a></p>
	</div>
<?php 
}

function sanitize_csv( $text ) {
	$text = str_replace( '"', "'", $text );
	$text = str_replace( "\n", ' ', $text );
	$text = str_replace( "\r", ' ', $text );
	$text = str_replace( ";", ' ', $text );
	return utf8_decode( $text );
}

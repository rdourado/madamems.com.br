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
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), '1.8.3', true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jplayer', "{$uri}/js/jplayer/jquery.jplayer.min.js", array( 'jquery' ), null, true );
    wp_enqueue_script( 'playlist', "{$uri}/js/jplayer/jplayer.playlist.min.js", array( 'jquery' ), null, true );
    wp_enqueue_script( 'gomus', "http://echo.gomus.com.br/player/mb.js?id=1735868145", array( 'jquery' ), null, true );
    wp_enqueue_script( 'login', "http://www.madamems.com.br/js/login.js", array( 'jquery' ), null, true );

    wp_enqueue_script( 'fancybox', "{$uri}/js/fancybox/jquery.fancybox-1.3.4.pack.js", array( 'jquery' ), null, true );
    wp_enqueue_script( 'maskedinput', "{$uri}/js/jquery.maskedinput.min.js", array( 'jquery' ), null, true );
    wp_enqueue_script( 'interface', "{$uri}/js/interface.js", array( 'jquery' ), filemtime( TEMPLATEPATH . '/js/interface.js' ), true );
}

/* Content */

add_filter( 'the_content', 'my_content', 102 );

function my_content( $subject ) {
	global $t_url;
	//ereg_replace( '\<input type\=\"submit\".*? value="(.*?)"', replacement, string)
	$search  = '<input type="submit" name="sendbutton" id="sendbutton" class="sendbutton" value="Enviar" onclick="return cforms_validate(\'\', false)"/>';
	$replace = '<button type="submit" id="sendbutton" class="sendbutton" onclick="return cforms_validate(\'\', false)"><img src="' . $t_url . '/img/submit.png" alt="Enviar" width="85" height="26"></button>';
	return str_replace( $search, $replace, $subject );
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
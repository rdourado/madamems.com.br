<?php

// Sets the size of returned excerpt string of function the_excerpt to 10 words.
function custom_excerpt_length($length) {
	return 10;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
?>
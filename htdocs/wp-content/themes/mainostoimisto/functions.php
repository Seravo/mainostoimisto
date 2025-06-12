<?php
/**
 * Mainostoimisto functions and definitions.
 *
 */


/**
 * Enqueues style.css on the front.
 *
 * @return void
 */
function twentytwentyfive_enqueue_styles() {
	wp_enqueue_style(
		'mainostoimisto-style',
		get_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

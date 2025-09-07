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
function mainostoimisto_enqueue_styles() {
	wp_enqueue_style(
		'mainostoimisto-style',
		get_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'mainostoimisto_enqueue_styles' );

/**
 * Preload needed fonts in the head.
 *
 * @return void
 */
function mainostoimisto_preload_fonts() {
	$theme_url = get_theme_file_uri();

	$fonts = [
		$theme_url . '/assets/fonts/fraunces/fraunces-v35-latin-700.woff2' => 'woff2',
		$theme_url . '/assets/fonts/dm-sans/dm-sans-v15-latin-regular.woff2' => 'woff2',
		$theme_url . '/assets/fonts/dm-sans/dm-sans-v15-latin-700.woff2' => 'woff2',
	];

	foreach ( $fonts as $font_link => $font_type ) {
		echo '<link rel="preload" href="' . esc_url( $font_link ) . '" as="font" type="font/' . esc_attr( $font_type ) . '" crossorigin>';
	}
}
add_action( 'wp_head', 'mainostoimisto_preload_fonts', 1 );

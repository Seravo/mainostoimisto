<?php
/**
 * Register Block Bindings.
 *
 * @package MT_Features
 */

namespace MT\Features\Bindings;

/**
 * Class Register_Bindings
 *
 * Registers block bindings.
 */
class Register_Bindings {
	/**
	 * Constructor to initialize the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_block_bindings' ) );
	}

	/**
	 * Registers block bindings.
	 */
	public function register_block_bindings() {
		\register_block_bindings_source(
			'mt-features/office-details',
			array(
				'label'              => __( 'Office URL', 'mt-features' ),
				'get_value_callback' => array( $this, 'mt_bindings_callback' ),
			)
		);
	}

	/**
	 * Bindings callback for office meta fields.
	 *
	 * @param array $source_args Source arguments.
	 * @return string|null The formatted meta value or null.
	 */
	public function mt_bindings_callback( $source_args ) {
		// Return null if no key is set.
		if ( ! isset( $source_args['key'] ) ) {
			return null;
		}

		$key = $source_args['key'];

		// Get the data from the post meta.
		$value = \get_post_meta( get_the_ID(), $key, true ) ?? false;

		// Return early if no value.
		if ( ! $value ) {
			return null;
		}

		// Format the value based on the key.
		switch ( $key ) {
			case 'office_email':
				return sprintf(
					'<a href="mailto:%s">%s</a>',
					esc_html( $value ),
					esc_html( $value )
				);

			case 'office_phone':
				return sprintf(
					'<a href="tel:%s">%s</a>',
					esc_html( str_replace( ' ', '', $value ) ),
					esc_html( $value )
				);

			case 'office_url':
				return sprintf(
					'<a href="%s">%s</a>',
					esc_url( str_replace( ' ', '', $value ) ),
					esc_url( $value )
				);

			default:
				return null;
		}
	}
}

new Register_Bindings();

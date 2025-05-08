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
			'mt-features/office-email',
			array(
				'label'              => __( 'Office email', 'mt-features' ),
				'get_value_callback' => array( $this, 'bindings_callback_email' ),
			)
		);

		\register_block_bindings_source(
			'mt-features/office-phone',
			array(
				'label'              => __( 'Office phone', 'mt-features' ),
				'get_value_callback' => array( $this, 'bindings_callback_phone' ),
			)
		);

		\register_block_bindings_source(
			'mt-features/office-url',
			array(
				'label'              => __( 'Office URL', 'mt-features' ),
				'get_value_callback' => array( $this, 'bindings_callback_url' ),
			)
		);
	}

	/**
	 * Office email bindings callback.
	 */
	public function bindings_callback_email( $source_args ) {
		// Return null if no key is set.
		if ( ! isset( $source_args['key'] ) ) {
			return null;
		}

		// Get the data from the post meta.
		$office_email = \get_post_meta( get_the_ID(), 'office_email', true ) ?? false;

		// Link to the email address.
		if ( $office_email ) {
			$office_email = sprintf(
				'<a href="mailto:%s">%s</a>',
				esc_html( $office_email ),
				esc_html( $office_email )
			);
		}

		// Return the data.
		return $office_email;
	}

	/**
	 * Office phone bindings callback.
	 */
	public function bindings_callback_phone( $source_args ) {
		// Return null if no key is set.
		if ( ! isset( $source_args['key'] ) ) {
			return null;
		}

		// Get the data from the post meta.
		$office_phone = \get_post_meta( get_the_ID(), 'office_phone', true ) ?? false;

		// Link to the phone address.
		if ( $office_phone ) {
			$office_phone = sprintf(
				'<a href="tel:%s">%s</a>',
				esc_html( str_replace( ' ', '', $office_phone ) ),
				esc_html( $office_phone )
			);
		}

		// Return the data.
		return $office_phone;
	}

	/**
	 * Office URL bindings callback.
	 */
	public function bindings_callback_url( $source_args ) {
		// Return null if no key is set.
		if ( ! isset( $source_args['key'] ) ) {
			return null;
		}

		// Get the data from the post meta.
		$office_url = \get_post_meta( get_the_ID(), 'office_url', true ) ?? false;

		// Link to the phone address.
		if ( $office_url ) {
			$office_url = sprintf(
				'<a href="%s">%s</a>',
				esc_url( str_replace( ' ', '', $office_url ) ),
				esc_url( $office_url )
			);
		}

		// Return the data.
		return $office_url;
	}
}

new Register_Bindings();

<?php
/**
 * Register Meta.
 *
 * @package MT_Features
 */

namespace MT\Features\Meta;

/**
 * Class Register_Meta
 *
 * Registers meta fields for the "office" custom post type.
 */
class Register_Meta {
	/**
	 * Constructor to initialize the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_meta_fields' ), 20 );
	}

	/**
	 * Register meta fields for the "office" custom post type.
	 */
	public function register_meta_fields() {
		// Register "office_email" meta field.
		\register_meta(
			'office',
			'office_email',
			array(
				'type'              => 'string',
				'description'       => 'Email address of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_email',
			)
		);

		// Register "office_phone" meta field.
		\register_meta(
			'office',
			'office_phone',
			array(
				'type'              => 'string',
				'description'       => 'Phone number of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	}
}

new Register_Meta();

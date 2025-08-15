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
		add_action( 'init', array( $this, 'register_post_meta_fields' ), 20 );
	}

	/**
	 * Register meta fields for the "office" custom post type.
	 */
	public function register_post_meta_fields() {
		// Register "office_email" meta field.
		\register_post_meta(
			'office',
			'office_email',
			array(
				'type'              => 'string',
				'description'       => 'Email address of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_email',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_phone" meta field.
		\register_post_meta(
			'office',
			'office_phone',
			array(
				'type'              => 'string',
				'description'       => 'Phone number of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_url" meta field.
		\register_post_meta(
			'office',
			'office_url',
			array(
				'type'              => 'string',
				'description'       => 'URL of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_url',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);
	}
}

new Register_Meta();

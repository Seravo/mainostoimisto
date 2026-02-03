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
				'label'             => __( 'Office Email', 'mt-features' ),
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
				'label'             => __( 'Office Phone', 'mt-features' ),
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
				'label'             => __( 'Office URL', 'mt-features' ),
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

		// Register "office_has_boolean" meta field.
		\register_post_meta(
			'office',
			'office_has_boolean',
			array(
				'type'              => 'boolean',
				'description'       => 'Indicates if the office has a boolean value',
				'default'           => true,
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'rest_sanitize_boolean',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_checkboxes" meta field.
		\register_post_meta(
			'office',
			'office_checkboxes',
			array(
				'type'              => 'array',
				'description'       => 'Indicates if the office has checkboxes',
				'default'           => array(),
				'single'            => true,
				'show_in_rest'      => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'string',
						),
					),
				),
				'sanitize_callback' => function ( $value ) {
					if ( ! is_array( $value ) ) {
						return array();
					}
					return array_map( 'sanitize_text_field', $value );
				},
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_radionbuttons" meta field.
		\register_post_meta(
			'office',
			'office_radionbuttons',
			array(
				'type'              => 'string',
				'description'       => 'Indicates if the office has radio buttons',
				'default'           => 'option1',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_select" meta field.
		\register_post_meta(
			'office',
			'office_select',
			array(
				'type'              => 'string',
				'description'       => 'Indicates if the office has select options',
				'default'           => 'option1',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_info" meta field.
		\register_post_meta(
			'office',
			'office_info',
			array(
				'type'              => 'string',
				'description'       => 'Office info',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_textarea_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_date" meta field.
		\register_post_meta(
			'office',
			'office_date',
			array(
				'type'              => 'string',
				'description'       => 'Start Date of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_range" meta field.
		\register_post_meta(
			'office',
			'office_range',
			array(
				'type'              => 'integer',
				'description'       => 'Range of the office',
				'single'            => true,
				'default'           => 2,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_color" meta field.
		\register_post_meta(
			'office',
			'office_color',
			array(
				'type'              => 'string',
				'description'       => 'Color of the office',
				'single'            => true,
				'default'           => 'blue',
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_post" meta field.
		\register_post_meta(
			'office',
			'office_post',
			array(
				'type'              => 'integer',
				'description'       => 'Post of the office',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);

		// Register "office_image" meta field.
		\register_post_meta(
			'office',
			'office_image',
			array(
				'type'              => 'object',
				'description'       => 'Image of the office',
				'single'            => true,
				'show_in_rest'      => array(
					'schema' => array(
						'type'       => 'object',
						'properties' => array(
							'id'     => array(
								'type' => 'integer',
							),
							'url'    => array(
								'type' => 'string',
							),
							'alt'    => array(
								'type' => 'string',
							),
							'width'  => array(
								'type' => 'integer',
							),
							'height' => array(
								'type' => 'integer',
							),
							'title'  => array(
								'type' => 'string',
							),
						),
					),
				),
				'sanitize_callback' => function ( $value ) {
					if ( ! is_array( $value ) ) {
						return array();
					}
					return array(
						'id'     => isset( $value['id'] ) ? absint( $value['id'] ) : 0,
						'url'    => isset( $value['url'] ) ? esc_url_raw( $value['url'] ) : '',
						'alt'    => isset( $value['alt'] ) ? sanitize_text_field( $value['alt'] ) : '',
						'width'  => isset( $value['width'] ) ? absint( $value['width'] ) : 0,
						'height' => isset( $value['height'] ) ? absint( $value['height'] ) : 0,
						'title'  => isset( $value['title'] ) ? sanitize_text_field( $value['title'] ) : '',
					);
				},
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					// Allows anyone who can edit this post
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);
	}
}

new Register_Meta();

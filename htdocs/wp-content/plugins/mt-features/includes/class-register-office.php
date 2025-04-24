<?php
/**
 * Register Office Post Type.
 *
 * @package MT_Features
 */

namespace MT\Features\Post_Types;

/**
 * Class Register_Office
 *
 * Registers the custom post type "office".
 */
class Register_Office {
	/**
	 * Constructor to initialize the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_office_post_type' ) );
	}

	/**
	 * Registers the "office" custom post type.
	 */
	public function register_office_post_type() {
		$labels = array(
			'name'               => __( 'Offices', 'mt-features' ),
			'singular_name'      => __( 'Office', 'mt-features' ),
			'menu_name'          => __( 'Offices', 'mt-features' ),
			'name_admin_bar'     => __( 'Office', 'mt-features' ),
			'add_new'            => __( 'Add New', 'mt-features' ),
			'add_new_item'       => __( 'Add New Office', 'mt-features' ),
			'new_item'           => __( 'New Office', 'mt-features' ),
			'edit_item'          => __( 'Edit Office', 'mt-features' ),
			'view_item'          => __( 'View Office', 'mt-features' ),
			'all_items'          => __( 'All Offices', 'mt-features' ),
			'search_items'       => __( 'Search Offices', 'mt-features' ),
			'parent_item_colon'  => __( 'Parent Offices:', 'mt-features' ),
			'not_found'          => __( 'No offices found.', 'mt-features' ),
			'not_found_in_trash' => __( 'No offices found in Trash.', 'mt-features' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'          => 'dashicons-building',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'toimisto' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'show_in_rest'       => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
		);

		\register_post_type( 'office', $args );
	}
}

new Register_Office();

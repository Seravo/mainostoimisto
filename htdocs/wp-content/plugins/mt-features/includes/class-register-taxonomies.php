<?php
/**
 * Register Taxonomies.
 *
 * @package MT_Features
 */

namespace MT\Features\Taxonomies;

/**
 * Class Register_Taxonomies
 *
 * Registers the custom post type "office".
 */
class Register_Taxonomies {
	/**
	 * Constructor to initialize the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}

	/**
	 * Registers the "office" custom post type.
	 */
	public function register_taxonomies() {
		// Register "location" taxonomy.
		\register_taxonomy(
			'location',
			'office',
			array(
				'labels'       => array(
					'name'          => __( 'Locations', 'mt-features' ),
					'singular_name' => __( 'Location', 'mt-features' ),
					'add_new_item'  => __( 'Add Location', 'mt-features' ),
					'edit_item'     => __( 'Edit Location', 'mt-features' ),
					'all_items'     => __( 'All Locations', 'mt-features' ),
				),
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'sijainti' ),
			)
		);

		// Register "service" taxonomy.
		\register_taxonomy(
			'service',
			'office',
			array(
				'labels'       => array(
					'name'          => __( 'Services', 'mt-features' ),
					'singular_name' => __( 'Service', 'mt-features' ),
					'add_new_item'  => __( 'Add Service', 'mt-features' ),
					'edit_item'     => __( 'Edit Service', 'mt-features' ),
					'all_items'     => __( 'All Services', 'mt-features' ),
				),
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'palvelu' ),
			)
		);

		// Register "technology" taxonomy.
		\register_taxonomy(
			'technology',
			'office',
			array(
				'labels'       => array(
					'name'          => __( 'Technologies', 'mt-features' ),
					'singular_name' => __( 'Technology', 'mt-features' ),
					'add_new_item'  => __( 'Add Technology', 'mt-features' ),
					'edit_item'     => __( 'Edit Technology', 'mt-features' ),
					'all_items'     => __( 'All Technologies', 'mt-features' ),
				),
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'teknologia' ),
			)
		);

		// Register "budget" taxonomy.
		\register_taxonomy(
			'budget',
			'office',
			array(
				'labels'       => array(
					'name'          => __( 'Budgets', 'mt-features' ),
					'singular_name' => __( 'Budget', 'mt-features' ),
					'add_new_item'  => __( 'Add Budget', 'mt-features' ),
					'edit_item'     => __( 'Edit Budget', 'mt-features' ),
					'all_items'     => __( 'All Budgets', 'mt-features' ),
				),
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'budjetti' ),
			)
		);

		// Register "level" taxonomy.
		\register_taxonomy(
			'level',
			'office',
			array(
				'labels'       => array(
					'name'          => __( 'Levels', 'mt-features' ),
					'singular_name' => __( 'Level', 'mt-features' ),
					'add_new_item'  => __( 'Add Level', 'mt-features' ),
					'edit_item'     => __( 'Edit Level', 'mt-features' ),
					'all_items'     => __( 'All Levels', 'mt-features' ),
				),
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'rewrite'      => array( 'slug' => 'taso' ),
			)
		);
	}
}

new Register_Taxonomies();

<?php
/**
 * Plugin Name:       Query Filter Seravo
 * Description:       Order and reset blocks for the Query Loop Filters plugin.
 * Version:           0.1.0
 * Requires at least: 6.8
 * Requires PHP:      8.2
 * Author:            Seravo
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       query-filter-seravo
 *
 * @package QueryFilterSeravo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function query_filter_seravo_query_filter_seravo_block_init() {
	if ( ! defined( 'HM\\Query_Loop_Filter\\PLUGIN_FILE' ) ) {
		return;
	}

	wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
}
add_action( 'init', 'query_filter_seravo_query_filter_seravo_block_init', 20 );

/**
 * Apply validated order filter query variables to supported query loops.
 *
 * @param WP_Query $query Query instance.
 * @return void
 */
function query_filter_seravo_apply_order( WP_Query $query ) {
	$query_id = $query->get( 'query_id', null );

	if ( ! $query->is_main_query() && is_null( $query_id ) ) {
		return;
	}

	$prefix          = $query->is_main_query() ? 'query-' : "query-{$query_id}-";
	$orderby_key     = $prefix . 'orderby';
	$order_key       = $prefix . 'order';
	$allowed_orderby = array( 'date', 'title', 'rand' );
	$allowed_order   = array( 'asc', 'desc' );
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Public query filters do not mutate data.
	$current_orderby = $_GET[ $orderby_key ] ?? '';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Public query filters do not mutate data.
	$current_order = $_GET[ $order_key ] ?? '';

	if ( ! is_scalar( $current_orderby ) || ! is_scalar( $current_order ) ) {
		return;
	}

	$orderby = sanitize_key( wp_unslash( $current_orderby ) );
	$order   = sanitize_key( wp_unslash( $current_order ) );

	if ( ! in_array( $orderby, $allowed_orderby, true ) ) {
		return;
	}

	$query->set( 'orderby', $orderby );

	if ( $orderby !== 'rand' && in_array( $order, $allowed_order, true ) ) {
		$query->set( 'order', strtoupper( $order ) );
	}
}
add_action( 'pre_get_posts', 'query_filter_seravo_apply_order', 20 );

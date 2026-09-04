<?php
/**
 * Render the reset filter block.
 *
 * @package QueryFilterSeravo
 */

$is_inherited = ! empty( $block->context['query']['inherit'] );
$context      = array( 'queryId' => $is_inherited ? null : ( $block->context['queryId'] ?? 0 ) );
?>
<button <?php echo get_block_wrapper_attributes( array( 'class' => 'query-filter__button' ) ); ?> data-wp-interactive="query-filter" <?php echo wp_interactivity_data_wp_context( $context ); ?> data-wp-on--click="actions.navigateReset">
	<?php echo esc_html( $attributes['label'] ?? __( 'Reset filters', 'query-filter' ) ); ?>
</button>
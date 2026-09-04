<?php
/**
 * Render the order filter block.
 *
 * @package QueryFilterSeravo
 */

$order_options  = $attributes['orderOptions'] ?? array();
$default_option = $attributes['defaultOption'] ?? 'newest';
$show_label     = $attributes['showLabel'] ?? true;
$is_inherited   = ! empty( $block->context['query']['inherit'] );
$filter_id      = 'query-order-filter-' . wp_unique_id();

if ( $is_inherited ) {
	$param_name = 'query-orderby';
} else {
	$query_id   = $block->context['queryId'] ?? 0;
	$param_name = sprintf( 'query-%d-orderby', $query_id );
}

$order_param_name = str_replace( 'orderby', 'order', $param_name );
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$current_orderby = isset( $_GET[ $param_name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $param_name ] ) ) : '';
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$current_order = isset( $_GET[ $order_param_name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $order_param_name ] ) ) : '';
$active_option = $default_option;

foreach ( $order_options as $option ) {
	if ( ( $option['value']['orderby'] ?? '' ) === $current_orderby && ( $option['value']['order'] ?? '' ) === $current_order ) {
		$active_option = $option['slug'];
		break;
	}
}

$custom_labels = array(
	'newest'             => $attributes['labelNewest'] ?? '',
	'oldest'             => $attributes['labelOldest'] ?? '',
	'alphabetical-a-z'   => $attributes['labelTitleAsc'] ?? '',
	'alphabetical-z-a'   => $attributes['labelTitleDesc'] ?? '',
	'random'             => $attributes['labelRandom'] ?? '',
);
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'wp-block-query-filter' ) ); ?> data-wp-interactive="query-filter">
	<label class="query-filter__label<?php echo $show_label ? '' : ' screen-reader-text'; ?>" for="<?php echo esc_attr( $filter_id ); ?>"><?php echo esc_html( $attributes['label'] ?? __( 'Order by', 'query-filter' ) ); ?></label>
	<select id="<?php echo esc_attr( $filter_id ); ?>" class="query-filter__select" name="<?php echo esc_attr( $param_name ); ?>" data-wp-on--change="actions.navigateOrder">
		<?php foreach ( $order_options as $option ) : ?>
			<?php $value = $option['value'] ?? array(); ?>
			<option value="<?php echo esc_attr( $option['slug'] ); ?>" data-orderby="<?php echo esc_attr( $value['orderby'] ?? '' ); ?>" data-order="<?php echo esc_attr( $value['order'] ?? '' ); ?>" <?php selected( $active_option, $option['slug'] ); ?>><?php echo esc_html( $custom_labels[ $option['slug'] ] ?: $option['label'] ); ?></option>
		<?php endforeach; ?>
	</select>
</div>
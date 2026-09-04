import { getElement, store } from '@wordpress/interactivity';

store( 'query-filter', {
	actions: {
		*navigateOrder( event ) {
			event.preventDefault();
			const { ref } = getElement();
			const url = new URL( window.location.href );
			const option = ref.options[ ref.selectedIndex ];
			const orderParam = ref.name.replace( 'orderby', 'order' );

			if ( option.dataset.orderby ) {
				url.searchParams.set( ref.name, option.dataset.orderby );
				if ( option.dataset.order ) {
					url.searchParams.set( orderParam, option.dataset.order );
				} else {
					url.searchParams.delete( orderParam );
				}
			} else {
				url.searchParams.delete( ref.name );
				url.searchParams.delete( orderParam );
			}

			const { actions } = yield import(
				'@wordpress/interactivity-router'
			);
			yield actions.navigate( url.toString() );
		},
	},
} );

import { getContext, store } from '@wordpress/interactivity';

store( 'query-filter', {
	actions: {
		*navigateReset() {
			const { queryId } = getContext();
			const isInherited = queryId === null || queryId === undefined;
			const url = new URL( window.location.href );

			[ ...url.searchParams.keys() ].forEach( ( key ) => {
				if ( isInherited ) {
					if (
						( /^query-[a-z0-9_-]+$/i.test( key ) &&
							! /^query-\d+-/.test( key ) ) ||
						[ 'page', 'paged', 's' ].includes( key )
					) {
						url.searchParams.delete( key );
					}
				} else if (
					key === `query-${ queryId }-page` ||
					key.startsWith( `query-${ queryId }-` )
				) {
					url.searchParams.delete( key );
				}
			} );

			if ( isInherited ) {
				url.pathname = url.pathname.replace( /\/page\/\d+\/?$/i, '/' );
			}

			const { actions } = yield import(
				'@wordpress/interactivity-router'
			);
			yield actions.navigate( url.toString() );
		},
	},
} );

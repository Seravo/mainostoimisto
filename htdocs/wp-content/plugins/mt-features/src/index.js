/* eslint camelcase: "off" */

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import {
	PluginDocumentSettingPanel,
	store as editorStore,
} from '@wordpress/editor';
import { TextControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { registerBlockBindingsSource } from '@wordpress/blocks';

// Register a custom fields bindings source to the editor UI.
registerBlockBindingsSource( {
    name: 'mt-features/office-details',
    label: __( 'Office details', 'mt-features' ),
    getFieldsList() {
        return [
			{
				label: __( 'Office email', 'mt-features' ),
				type: 'string',
				args: {
					key: 'office_email',
				},
			},
			{
				label: __( 'Office phone', 'mt-features' ),
				type: 'string',
				args: {
					key: 'office_phone',
				},
			},
			{
				label: __( 'Office URL', 'mt-features' ),
				type: 'string',
				args: {
					key: 'office_url',
				},
			},
        ];
    },
} );

/**
 * Register a SlotFill to the custom UI to the document settings panel.
 */
registerPlugin( 'mt-office-info', {
	render: () => {
		// Get information from the editor store.
		const { currentPostType, currentPostId } = useSelect( ( select ) => { // eslint-disable-line
			return {
				currentPostType: select( editorStore ).getCurrentPostType(),
				currentPostId: select( editorStore ).getCurrentPostId(),
			};
		}, [] );

		// Get meta data and updater function
		const [ meta, setMeta ] = useEntityProp( // eslint-disable-line
			'postType',
			currentPostType,
			'meta',
			currentPostId
		);

		// This should only show on office post type.
		if ( currentPostType !== 'office' ) {
			return null;
		}

		return (
			<>
				<PluginDocumentSettingPanel
					name="guest-author-meta"
					title={ __( 'Office info', 'mt-features' ) }
				>
					<TextControl
						label={ __( 'Email', 'mt-features' ) }
						value={ meta?.office_email }
						onChange={ ( office_email ) => {
							setMeta( { ...meta, office_email } );
						} }
						__next40pxDefaultSize
					/>

					<TextControl
						label={ __( 'Phone', 'mt-features' ) }
						value={ meta?.office_phone }
						onChange={ ( office_phone ) => {
							// eslint-disable-line-camel-case
							setMeta( { ...meta, office_phone } );
						} }
						__next40pxDefaultSize
					/>

					<TextControl
						label={ __( 'URL', 'mt-features' ) }
						value={ meta?.office_url }
						onChange={ ( office_url ) => {
							setMeta( { ...meta, office_url } );
						} }
						__next40pxDefaultSize
					/>
				</PluginDocumentSettingPanel>
			</>
		);
	},
} );

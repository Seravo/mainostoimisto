/* eslint camelcase: "off" */

import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import {
	PluginDocumentSettingPanel,
	store as editorStore,
} from '@wordpress/editor';
import { TextControl, ToggleControl, CheckboxControl, RadioControl, SelectControl, TextareaControl, DateTimePicker, RangeControl, ColorPalette, BaseControl, __experimentalSpacer as Spacer  } from '@wordpress/components';
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

		// Checkbox options.
		const checkboxes = meta?.office_checkboxes || [];
		const checkboxOptions = [
			{ label: __( 'Option 1', 'example-dynamic' ), value: 'option1' },
			{ label: __( 'Option 2', 'example-dynamic' ), value: 'option2' },
			{ label: __( 'Option 3', 'example-dynamic' ), value: 'option3' },
		];

        const handleCheckboxChange = ( value, isChecked ) => {
            const newCheckboxes = isChecked
                ? [ ...checkboxes, value ]
                : checkboxes.filter( ( item ) => item !== value );
            setMeta( { ...meta, office_checkboxes: newCheckboxes } );
        };

		// Radio button options.
		const radiobuttons = meta?.office_radionbuttons || [];
		const radioOptions = [
			{ label: __( 'Option 1', 'example-dynamic' ), value: 'option1' },
			{ label: __( 'Option 2', 'example-dynamic' ), value: 'option2' },
			{ label: __( 'Option 3', 'example-dynamic' ), value: 'option3' },
		];

		// Select options.
		const select = meta?.office_select || 'option1';
		const selectOptions = [
			{ label: __( 'Option 1', 'example-dynamic' ), value: 'option1' },
			{ label: __( 'Option 2', 'example-dynamic' ), value: 'option2' },
			{ label: __( 'Option 3', 'example-dynamic' ), value: 'option3' },
		];

		// Color options.
		const colors = [
			{ name: 'red', color: '#f00' },
			{ name: 'white', color: '#fff' },
			{ name: 'blue', color: '#00f' },
		];

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

					<Spacer marginTop={ 6 } />

					<TextControl
						label={ __( 'Phone', 'mt-features' ) }
						value={ meta?.office_phone }
						onChange={ ( office_phone ) => {
							// eslint-disable-line-camel-case
							setMeta( { ...meta, office_phone } );
						} }
						__next40pxDefaultSize
					/>

					<Spacer marginTop={ 6 } />

					<TextControl
						label={ __( 'URL', 'mt-features' ) }
						value={ meta?.office_url }
						onChange={ ( office_url ) => {
							setMeta( { ...meta, office_url } );
						} }
						__next40pxDefaultSize
					/>

					<Spacer marginTop={ 8 } />

					<ToggleControl
						label={ __( 'Show in contact form', 'example-dynamic' ) }
						checked={ meta?.office_has_boolean }
						onChange={ ( office_has_boolean ) => {
							setMeta( {
								...meta,
								office_has_boolean: office_has_boolean,
							} );
						} }
						__next40pxDefaultSize
					/>

					<Spacer marginTop={ 8 } />

					<BaseControl
                        label={ __( 'Checkbox Options', 'example-dynamic' ) }
                        __nextHasNoMarginBottom
                    >
                        { checkboxOptions.map( ( option ) => (
                            <CheckboxControl
                                key={ option.value }
                                label={ option.label }
                                checked={ checkboxes.includes( option.value ) }
                                onChange={ ( isChecked ) =>
                                    handleCheckboxChange( option.value, isChecked )
                                }
                            />
                        ) ) }
                    </BaseControl>

					<Spacer marginTop={ 8 } />

					<RadioControl
						label={ __( 'Radio Options', 'example-dynamic' ) }
						selected={ radiobuttons }
						options={ radioOptions }
						onChange={ ( value ) => {
							setMeta( { ...meta, office_radionbuttons: value } );
						} }
					/>

					<Spacer marginTop={ 8 } />

					<SelectControl
						label={ __( 'Select Options', 'example-dynamic' ) }
						value={ select }
						options={ selectOptions }
						onChange={ ( value ) => {
							setMeta( { ...meta, office_select: value } );
						} }
					/>

					<Spacer marginTop={ 8 } />

					<TextareaControl
						label={ __( 'Office Info', 'example-dynamic' ) }
						value={ meta?.office_info }
						onChange={ ( office_info ) => {
							setMeta( { ...meta, office_info } );
						} }
						__next40pxDefaultSize
					/>

					<Spacer marginTop={ 8 } />

					<p>{ __( 'Set time and date', 'example-dynamic' ) }</p>
					<DateTimePicker
						currentDate={ meta?.office_date }
						onChange={ ( newDate ) => setMeta( { ...meta, office_date: newDate } ) }
						is12Hour={ false }
						startOfWeek={ 1 }
					/>

					<Spacer marginTop={ 8 } />

					<RangeControl
						label={ __( 'Office Range', 'example-dynamic' ) }
						value={ meta?.office_range }
						onChange={ ( office_range ) => {
							setMeta( { ...meta, office_range } );
						} }
						min={ 0 }
						max={ 10 }
					/>

					<Spacer marginTop={ 8 } />

					<p>{ __( 'Office Color', 'example-dynamic' ) }</p>
					<ColorPalette
						colors={ colors }
						value={ meta?.office_color }
						asButtons={ true }
						onChange={ ( office_color ) => {
							setMeta( { ...meta, office_color } );
						} }
					/>
				</PluginDocumentSettingPanel>
			</>
		);
	},
} );

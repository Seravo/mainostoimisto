import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	TextControl,
	ToggleControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const labels = {
	newest: 'labelNewest',
	oldest: 'labelOldest',
	'alphabetical-a-z': 'labelTitleAsc',
	'alphabetical-z-a': 'labelTitleDesc',
	random: 'labelRandom',
};

const optionLabels = {
	newest: __( 'Option Label Newest', 'query-filter' ),
	oldest: __( 'Option Label Oldest', 'query-filter' ),
	'alphabetical-a-z': __( 'Option Label Alphabetical A-Z', 'query-filter' ),
	'alphabetical-z-a': __( 'Option Label Alphabetical Z-A', 'query-filter' ),
	random: __( 'Option Label Random', 'query-filter' ),
};

export default function Edit( { attributes, setAttributes } ) {
	const { defaultOption, label, orderOptions, showLabel } = attributes;
	const options = orderOptions.map( ( option ) => ( {
		label: option.label,
		value: option.slug,
	} ) );

	return (
		<div { ...useBlockProps( { className: 'wp-block-query-filter' } ) }>
			<InspectorControls>
				<PanelBody title={ __( 'Order Settings', 'query-filter' ) }>
					<SelectControl
						label={ __( 'Default Order', 'query-filter' ) }
						value={ defaultOption }
						options={ options }
						onChange={ ( value ) =>
							setAttributes( { defaultOption: value } )
						}
					/>
					<TextControl
						label={ __( 'Label', 'query-filter' ) }
						value={ label }
						placeholder={ __( 'Order by', 'query-filter' ) }
						onChange={ ( value ) =>
							setAttributes( { label: value } )
						}
					/>
					<ToggleControl
						label={ __( 'Show Label', 'query-filter' ) }
						checked={ showLabel }
						onChange={ ( value ) =>
							setAttributes( { showLabel: value } )
						}
					/>
					{ Object.entries( labels ).map( ( [ slug, attribute ] ) => (
						<TextControl
							key={ attribute }
							label={ optionLabels[ slug ] }
							value={ attributes[ attribute ] }
							onChange={ ( value ) =>
								setAttributes( { [ attribute ]: value } )
							}
						/>
					) ) }
				</PanelBody>
			</InspectorControls>
			{ showLabel && (
				<label
					className="wp-block-query-filter__label"
					htmlFor="query-filter-order-preview"
				>
					{ label || __( 'Order by', 'query-filter' ) }
				</label>
			) }
			<select
				id="query-filter-order-preview"
				value={ defaultOption }
				readOnly
			>
				{ orderOptions.map( ( option ) => (
					<option key={ option.slug } value={ option.slug }>
						{ attributes[ labels[ option.slug ] ] || option.label }
					</option>
				) ) }
			</select>
		</div>
	);
}

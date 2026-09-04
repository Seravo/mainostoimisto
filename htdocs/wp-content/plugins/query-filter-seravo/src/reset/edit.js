import { RichText, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export default function Edit( { attributes, setAttributes } ) {
	return (
		<button { ...useBlockProps( { className: 'query-filter__button' } ) }>
			<RichText
				tagName="span"
				value={ attributes.label }
				onChange={ ( label ) => setAttributes( { label } ) }
				placeholder={ __( 'Reset filters', 'query-filter' ) }
			/>
		</button>
	);
}

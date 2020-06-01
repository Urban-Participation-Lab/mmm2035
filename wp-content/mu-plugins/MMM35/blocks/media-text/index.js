/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { mediaAndText as icon } from '@wordpress/icons';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';

export const settings = {
	title: __( 'Media & Text' ),
};

registerBlockType( 'mmm35/media-text', {
  title: __( 'Media & Text', 'MMM35'),
  description: __( 'Set media and words side-by-side for a richer layout.' ),
  icon,
  category: 'mmm35-blocks',
  supports: {
    html: false,
  },
  edit,
  save,
});

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { paragraph as icon } from '@wordpress/icons';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';

registerBlockType( 'mmm35/highlight', {
  title: __( 'MMM35 Highlight', 'MMM35'),
  description: __( 'Highlight text' ),
  icon,
  category: 'mmm35-blocks',
  supports: {
    html: false,
  },
  edit,
  save,
});

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { button as icon } from '@wordpress/icons';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';

registerBlockType( 'mmm35/button', {
  title: __( 'MMM35 Button', 'MMM35'),
  description: __( 'Link button' ),
  icon,
  category: 'mmm35-blocks',
  supports: {
    html: false,
  },
  edit,
  save,
});

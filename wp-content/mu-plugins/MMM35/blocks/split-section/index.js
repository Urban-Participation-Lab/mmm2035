/*
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { registerBlockType } from '@wordpress/blocks';
import { Toolbar, IconButton } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';

import SplitSection from './edit';
import SplitSectionImage from './image-section';
import SplitSectionContent from './image-section';

registerBlockType( 'mmm35/split-section-image', {
  title: __( 'MMM35', 'Split Section Image' ),
  category: 'mmm35-blocks',
  supports: {
    html: false,
  },

  edit: compose([
    withSelect((select) => {
      const { getSettings } = select('core/block-editor');
      const { mediaUpload } = getSettings();
      return { mediaUpload };
    }),
  ])(SplitSection),

  save: () => null,
} );

registerBlockType( 'mmm35/split-section', {
  title: __( 'MMM35', 'Split Section' ),
  category: 'mmm35-blocks',
  supports: {
    html: false,
  },

  edit: compose([
    withSelect((select) => {
      const { getSettings } = select('core/block-editor');
      const { mediaUpload } = getSettings();
      return { mediaUpload };
    }),
  ])(SplitSection),

  save: () => null,
} );

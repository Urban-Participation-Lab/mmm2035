/**
 * WordPress dependencies
 */
import { Toolbar, IconButton } from '@wordpress/components';
import { InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';

export default class SplitSectionImage extends Component {
  constructor() {
    super(...arguments);
  }

  componentDidMount() {
  }

  render() {
    return (
      <InnerBlocks
        template={ [
          ['core/heading', {}],
          ['core/paragraph', {}],
          //['mmm35/button', {}],
        ] }
        renderAppender={ false }
      />
    );
  }
};

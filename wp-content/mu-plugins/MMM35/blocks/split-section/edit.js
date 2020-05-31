import {
  every,
  filter,
  find,
  forEach,
  map,
  some,
} from 'lodash';

/**
 * WordPress dependencies
 */
import { Toolbar, IconButton } from '@wordpress/components';
import {
  BlockToolbar,
  BlockControls,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import SplitSectionImage from './image-section';
import SplitSectionContent from './content-section';

export default class SplitSection extends Component {
  constructor() {
    super(...arguments);

    this.state = { shownIndex: 0 };
  }

  componentDidMount() {
    const { attributes } = this.props;
    const { layout } = attributes;
  }

  render() {
    const {
      shownIndex,
    } = this.state;
    const {
      attributes,
      className,
    } = this.props;
    const {
      layout,
    } = attributes;

    return (
      <>
        <BlockControls key="controls">
          <Toolbar></Toolbar>
        </BlockControls>

        <SplitSectionContent />
        <SplitSectionImage />
      </>
    );
  }
};

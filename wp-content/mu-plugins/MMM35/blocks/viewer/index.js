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
import { compose } from '@wordpress/compose';
import { registerBlockType } from '@wordpress/blocks';
import { Toolbar, IconButton } from '@wordpress/components';
import {
  BlockToolbar,
  BlockControls,
  MediaPlaceholder,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { getBlobByURL, isBlobURL, revokeBlobURL } from '@wordpress/blob';
import { withSelect } from '@wordpress/data';
import { Component } from '@wordpress/element';

class ThreeDViewer extends Component {
  constructor() {
    super(...arguments);

    this.onSelectImages = this.onSelectImages.bind(this);
    this.onMoveBackward = this.onMoveBackward.bind(this);
    this.onMoveForward = this.onMoveForward.bind(this);
    this.onRemove = this.onRemove.bind(this);
    this.state = { shownIndex: 0 };
  }

  onRemove() {
    const { shownIndex } = this.state;
    const { images } = this.props.attributes;
    this.props.setAttributes({
      images: images.filter((_, index) => index !== shownIndex),
    });
    this.setState({
      shownIndex: Math.min(Math.max(shownIndex, 0), images.length - 2),
    });
  }

  onMoveBackward() {
    const { shownIndex } = this.state;
    const { images } = this.props.attributes;
    const newImages = [
      ...images.slice(0, shownIndex - 1),
      images[shownIndex],
      images[shownIndex - 1],
      ...images.slice(shownIndex + 1),
    ];
    this.props.setAttributes({ images: newImages });
    this.setState({ shownIndex: shownIndex - 1 });
  }

  onMoveForward() {
    const { shownIndex } = this.state;
    const { images } = this.props.attributes;
    const newImages = [
      ...images.slice(0, shownIndex),
      images[shownIndex + 1],
      images[shownIndex],
      ...images.slice(shownIndex + 2),
    ];
    this.props.setAttributes({ images: newImages });
    this.setState({ shownIndex: shownIndex + 1 });
  }

  onSelectImages(selected) {
    this.props.setAttributes({ images: selected.flat() });
  }

  componentDidMount() {
    const { attributes, mediaUpload } = this.props;
    const { images } = attributes;

    if (every(images, ({ url }) => isBlobURL(url))) {
      const filesList = map(images, ({ url }) => getBlobByURL(url) );
      forEach(images, ({ url }) => revokeBlobURL(url));
      mediaUpload( {
        filesList,
        onFileChange: this.onSelectImages,
        allowedTypes: ['image'],
      });
    }
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
      images,
    } = attributes;
    const hasImages = !!images.length;
    const hasImagesWithId = hasImages && images.some(({ id }) => id);

    const image = images[shownIndex];
    const isFirstItem = shownIndex === 0;
    const isLastItem = shownIndex === images.length - 1;

    return (
      <>
        <BlockControls key="controls">
          <Toolbar controls={images.map((image, index) => ({
            icon: 'marker',
            title: `Select image number ${index + 1}`,
            isActive: index === shownIndex,
            onClick: () => this.setState({ shownIndex: index }),
          }))} />
          <Toolbar>
            <IconButton
              icon="arrow-left-alt"
              onClick={ isFirstItem ? undefined : this.onMoveBackward }
              className="wp-block-fbx-hero-gallery__move-backward"
              label={ __( 'Move image backward' ) }
              aria-disabled={ isFirstItem }
            />
            <IconButton
              icon="arrow-right-alt"
              onClick={ isLastItem ? undefined : this.onMoveForward }
              className="wp-block-fbx-hero-gallery__move-backward"
              label={ __( 'Move image forward' ) }
              aria-disabled={ isLastItem }
            />
            <IconButton
              icon="no"
              onClick={ this.onRemove }
              className="wp-block-fbx-hero-gallery__move-backward"
              label={ __( 'Delete Image' ) }
            />
          </Toolbar>
        </BlockControls>

        <div className={ className }>
          { images.length ?
            <div className="wp-block-flexbox-hero-gallery__images">
              <img
                src={ image.url }
                className="wp-block-flexbox-hero-gallery__image"
              />
            </div>
            : null
          }

          <MediaPlaceholder
            addToGallery={ hasImagesWithId }
            isAppender={ hasImages }
            onSelect={ this.onSelectImages }
            value={ hasImagesWithId ? images : undefined }
            accept="image/*"
            multiple
          />
        </div>
      </>
    );
  }
};

registerBlockType( 'jbng/viewer', {
  title: __( 'MMM35', '3D Viewer' ),
  category: 'jbng-blocks',
  supports: {
    html: false,
  },

  getEditWrapperProps(attributes) {
    return { 'data-align': 'full' };
  },

  edit: compose([
    withSelect((select) => {
      const { getSettings } = select('core/block-editor');
      const { mediaUpload } = getSettings();
      return { mediaUpload };
    }),
  ])(ThreeDViewer),

  save: () => null,
} );

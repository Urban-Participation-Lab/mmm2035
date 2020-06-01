/**
 * External dependencies
 */
import classnames from 'classnames';
import { get } from 'lodash';

/**
 * WordPress dependencies
 */
import { __, _x } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect } from '@wordpress/data';
import {
  BlockControls,
  BlockVerticalAlignmentToolbar,
  InnerBlocks,
  InspectorControls,
  __experimentalImageURLInputUI as ImageURLInputUI,
} from '@wordpress/block-editor';
import { Component } from '@wordpress/element';
import {
  PanelBody,
  TextareaControl,
  ToggleControl,
  ToolbarGroup,
  ExternalLink,
  FocalPointPicker,
} from '@wordpress/components';
import { pullLeft, pullRight } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import MediaContainer from './media-container';

/**
 * Constants
 */
const TEMPLATE = [
  [
    'core/paragraph',
    {
      fontSize: 'large',
      placeholder: _x( 'Content…', 'content placeholder' ),
    },
  ],
];

const LINK_DESTINATION_MEDIA = 'media';
const LINK_DESTINATION_ATTACHMENT = 'attachment';

class MediaTextEdit extends Component {
  constructor() {
    super( ...arguments );

    this.onSelectMedia = this.onSelectMedia.bind( this );
    this.state = { };
    this.onSetHref = this.onSetHref.bind( this );
  }

  onSelectMedia( media ) {
    const { setAttributes } = this.props;
    const { linkDestination, href } = this.props.attributes;

    let mediaType;
    let src;
    // for media selections originated from a file upload.
    if ( media.media_type ) {
      if ( media.media_type === 'image' ) {
        mediaType = 'image';
      } else {
        // only images and videos are accepted so if the media_type is not an image we can assume it is a video.
        // video contain the media type of 'file' in the object returned from the rest api.
        mediaType = 'video';
      }
    } else {
      // for media selections originated from existing files in the media library.
      mediaType = media.type;
    }

    if ( mediaType === 'image' ) {
      // Try the "large" size URL, falling back to the "full" size URL below.
      src =
        get( media, [ 'sizes', 'large', 'url' ] ) ||
        get( media, [
          'media_details',
          'sizes',
          'large',
          'source_url',
        ] );
    }

    let newHref = href;
    if ( linkDestination === LINK_DESTINATION_MEDIA ) {
      // Update the media link.
      newHref = media.url;
    }

    // Check if the image is linked to the attachment page.
    if ( linkDestination === LINK_DESTINATION_ATTACHMENT ) {
      // Update the media link.
      newHref = media.link;
    }

    setAttributes( {
      mediaAlt: media.alt,
      mediaId: media.id,
      mediaType,
      mediaUrl: src || media.url,
      mediaLink: media.link || undefined,
      href: newHref,
    } );
  }

  onSetHref( props ) {
    this.props.setAttributes( props );
  }

  renderMediaArea() {
    const { attributes, isSelected } = this.props;
    const {
      mediaAlt,
      mediaId,
      mediaPosition,
      mediaType,
      mediaUrl,
      imageFill,
    } = attributes;
    return (
      <MediaContainer
        className="wp-block-mmm35-media-text__media"
        onSelectMedia={ this.onSelectMedia }
        { ...{
          mediaAlt,
          mediaId,
          mediaType,
          mediaUrl,
          mediaPosition,
          imageFill,
          isSelected,
        } }
      />
    );
  }

  render() {
    const {
      attributes,
      className,
      isSelected,
      setAttributes,
      image,
    } = this.props;
    const {
      mediaAlt,
      mediaPosition,
      mediaType,
      mediaUrl,
      rel,
      href,
      linkTarget,
      linkClass,
      linkDestination,
    } = attributes;

    const classNames = classnames( className, {
      'has-media-on-the-left': 'left' === mediaPosition,
      'has-media-on-the-top': 'top' === mediaPosition,
      'has-media-on-the-right': 'right' === mediaPosition,
      'is-selected': isSelected,
    } );
    const toolbarControls = [
      {
        icon: pullLeft,
        title: __( 'Show media on left' ),
        isActive: mediaPosition === 'left',
        onClick: () => setAttributes( { mediaPosition: 'left' } ),
      },
      {
        icon: pullLeft,
        title: __( 'Show media on top' ),
        isActive: mediaPosition === 'top',
        onClick: () => setAttributes( { mediaPosition: 'top' } ),
      },
      {
        icon: pullRight,
        title: __( 'Show media on right' ),
        isActive: mediaPosition === 'right',
        onClick: () => setAttributes( { mediaPosition: 'right' } ),
      },
    ];
    const onMediaAltChange = ( newMediaAlt ) => {
      setAttributes( { mediaAlt: newMediaAlt } );
    };
    const mediaTextGeneralSettings = (
      <PanelBody title={ __( 'Media & Text settings' ) }>
        { mediaType === 'image' && (
          <TextareaControl
            label={ __( 'Alt text (alternative text)' ) }
            value={ mediaAlt }
            onChange={ onMediaAltChange }
            help={
              <>
                <ExternalLink href="https://www.w3.org/WAI/tutorials/images/decision-tree">
                  { __(
                    'Describe the purpose of the image'
                  ) }
                </ExternalLink>
                { __(
                  'Leave empty if the image is purely decorative.'
                ) }
              </>
            }
          />
        ) }
      </PanelBody>
    );

    return (
      <>
        <InspectorControls>
          { mediaTextGeneralSettings }
        </InspectorControls>
        <BlockControls>
          <ToolbarGroup controls={ toolbarControls } />
          { mediaType === 'image' && (
            <ToolbarGroup>
              <ImageURLInputUI
                url={ href || '' }
                onChangeUrl={ this.onSetHref }
                linkDestination={ linkDestination }
                mediaType={ mediaType }
                mediaUrl={ image && image.source_url }
                mediaLink={ image && image.link }
                linkTarget={ linkTarget }
                linkClass={ linkClass }
                rel={ rel }
              />
            </ToolbarGroup>
          ) }
        </BlockControls>
        <div className={ classNames }>
          { this.renderMediaArea() }
          <InnerBlocks
            template={ TEMPLATE }
            templateInsertUpdatesSelection={ false }
          />
        </div>
      </>
    );
  }
}

export default compose( [
  withSelect( ( select, props ) => {
    const { getMedia } = select( 'core' );
    const {
      attributes: { mediaId },
      isSelected,
    } = props;
    return {
      image: mediaId && isSelected ? getMedia( mediaId ) : null,
    };
  } ),
] )( MediaTextEdit );

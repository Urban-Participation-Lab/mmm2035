/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { withNotices } from '@wordpress/components';
import {
  BlockControls,
  BlockIcon,
  MediaPlaceholder,
  MediaReplaceFlow,
} from '@wordpress/block-editor';
import { Component } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { compose, useViewportMatch } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';

/**
 * Internal dependencies
 */
import icon from './media-container-icon';

/**
 * Constants
 */
const ALLOWED_MEDIA_TYPES = [ 'image', 'video' ];

export function imageFillStyles( url, focalPoint ) {
  return url
    ? {
        backgroundImage: `url(${ url })`,
        backgroundPosition: focalPoint
          ? `${ focalPoint.x * 100 }% ${ focalPoint.y * 100 }%`
          : `50% 50%`,
      }
    : {};
}

class MediaContainer extends Component {
  constructor() {
    super( ...arguments );
    this.onUploadError = this.onUploadError.bind( this );
  }

  onUploadError( message ) {
    const { noticeOperations } = this.props;
    noticeOperations.removeAllNotices();
    noticeOperations.createErrorNotice( message );
  }

  renderToolbarEditButton() {
    const { onSelectMedia, mediaUrl, mediaId } = this.props;
    return (
      <BlockControls>
        <MediaReplaceFlow
          mediaId={ mediaId }
          mediaURL={ mediaUrl }
          allowedTypes={ ALLOWED_MEDIA_TYPES }
          accept="image/*,video/*"
          onSelect={ onSelectMedia }
        />
      </BlockControls>
    );
  }

  renderImage() {
    const {
      mediaAlt,
      mediaCaption,
      mediaUrl,
      className,
      imageFill,
      focalPoint,
    } = this.props;
    const backgroundStyles = imageFill
      ? imageFillStyles( mediaUrl, focalPoint )
      : {};
    return (
      <>
        { this.renderToolbarEditButton() }
        <figure className={ className + ' mmm35-figure' } style={ backgroundStyles }>
          <img src={ mediaUrl } alt={ mediaAlt } />
          <figcaption className="mmm35-figure__caption">{mediaCaption}</figcaption>
        </figure>
      </>
    );
  }

  renderVideo() {
    const { mediaUrl, mediaCaption = '', className } = this.props;
    return (
      <>
        { this.renderToolbarEditButton() }
        <figure className={ className + ' mmm35-figure' }>
          <video controls src={ mediaUrl } />
          <figcaption className="mmm35-figure__caption">{mediaCaption}</figcaption>
        </figure>
      </>
    );
  }

  renderPlaceholder() {
    const { onSelectMedia, className, noticeUI } = this.props;
    return (
      <MediaPlaceholder
        icon={ <BlockIcon icon={ icon } /> }
        labels={ {
          title: __( 'Media area' ),
        } }
        className={ className }
        onSelect={ onSelectMedia }
        accept="image/*,video/*"
        allowedTypes={ ALLOWED_MEDIA_TYPES }
        notices={ noticeUI }
        onError={ this.onUploadError }
      />
    );
  }

  render() {
    const {
      mediaPosition,
      mediaUrl,
      mediaType,
      toggleSelection,
      isSelected,
      isStackedOnMobile,
    } = this.props;
    if ( mediaType && mediaUrl ) {
      const enablePositions = {
        right: mediaPosition === 'left',
        left: mediaPosition === 'right',
      };

      let mediaElement = null;
      switch ( mediaType ) {
        case 'image':
          return this.renderImage();
        case 'video':
          return this.renderVideo();
      }
    }
    return this.renderPlaceholder();
  }
}

export default compose( [
  withDispatch( ( dispatch ) => {
    const { toggleSelection } = dispatch( 'core/block-editor' );

    return {
      toggleSelection,
    };
  } ),
  withNotices,
] )( MediaContainer );

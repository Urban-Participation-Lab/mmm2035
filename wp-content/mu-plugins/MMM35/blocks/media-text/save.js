/**
 * External dependencies
 */
import classnames from 'classnames';
import { noop, isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import { InnerBlocks } from '@wordpress/block-editor';

const DEFAULT_MEDIA_WIDTH = 50;

export default function save( { attributes } ) {
  const {
    mediaAlt,
    mediaCaption,
    mediaPosition,
    mediaType,
    mediaUrl,
    mediaId,
    href,
    linkTarget,
    rel,
  } = attributes;
  const newRel = isEmpty( rel ) ? undefined : rel;

  let image = (
    <img
      src={ mediaUrl }
      alt={ mediaAlt }
      className={
        mediaId && mediaType === 'image'
          ? `wp-image-${ mediaId }`
          : null
      }
    />
  );

  if ( href ) {
    image = (
      <a
        className={ linkClass }
        href={ href }
        target={ linkTarget }
        rel={ newRel }
      >
        { image }
      </a>
    );
  }

  const mediaTypeRenders = {
    image: () => image,
    video: () => <video controls src={ mediaUrl } />,
  };
  const className = classnames( {
    'has-media-on-the-right': 'right' === mediaPosition,
    'has-media-on-the-top': 'top' === mediaPosition,
    'has-media-on-the-left': 'left' === mediaPosition,
  } );

  return (
    <div className={ className }>
      <figure className="wp-block-media-text__media">
        { ( mediaTypeRenders[ mediaType ] || noop )() }
        <figcaption>{mediaCaption}</figcaption>
      </figure>
      <div className="wp-block-media-text__content">
        <InnerBlocks.Content />
      </div>
    </div>
  );
}

/**
 * External dependencies
 */
import classnames from 'classnames';
import { noop, isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import { InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes } ) {
  const {
    mediaAlt,
    mediaCaption,
    mediaPosition,
    mediaType,
    mediaUrl,
    mediaId,
    rel,
  } = attributes;
  const newRel = isEmpty( rel ) ? undefined : rel;

  const image = (
    <a
      href={ mediaUrl }
      class="wp-block-mmm35-media-text__media-link"
      target="_blank"
      rel="noopener noreferrer"
    >
      <img
        src={ mediaUrl }
        alt={ mediaAlt }
        className={
          mediaId && mediaType === 'image'
            ? `wp-image-${ mediaId }`
            : null
        }
      />
    </a>
  );

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
      <figure className="mmm35-figure wp-block-mmm35-media-text__media">
        { ( mediaTypeRenders[ mediaType ] || noop )() }
        <figcaption className="mmm35-figure__caption">{mediaCaption}</figcaption>
      </figure>
      <div
        className="wp-block-mmm35-media-text__content animate"
        data-josh-anim-name="fadeInUp"
        data-josh-duration="800ms"
        data-josh-anim-delay="400ms"
      >
        <InnerBlocks.Content />
      </div>
    </div>
  );
}

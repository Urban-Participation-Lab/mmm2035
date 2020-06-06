/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { RichText } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
export default function save( { attributes } ) {
  const { linkTarget, rel, text, title, url } = attributes;
  const buttonClasses = classnames('wp-block-mmm35-button__link');

  // The use of a `title` attribute here is soft-deprecated, but still applied
  // if it had already been assigned, for the sake of backward-compatibility.
  // A title will no longer be assigned for new or updated button block links.

  return (
    <div>
      <RichText.Content
        tagName="a"
        className={ buttonClasses }
        href={ url }
        title={ title }
        value={ text }
        target={ linkTarget }
        rel={ rel }
      />
    </div>
  );
}

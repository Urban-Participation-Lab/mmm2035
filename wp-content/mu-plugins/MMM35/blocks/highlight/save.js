/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
  const { align, content, dropCap, direction } = attributes;

  return (
    <RichText.Content
      tagName="p"
      value={ content }
      dir={ direction }
    />
  );
}

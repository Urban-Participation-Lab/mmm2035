/**
 * WordPress dependencies
 */
import { RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
  const { content } = attributes;

  return (
    <RichText.Content
      tagName="p"
      className="mmm35-highlight"
      value={ content }
    />
  );
}

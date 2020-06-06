/**
 * WordPress dependencies
 */
import { __, _x } from '@wordpress/i18n';
import { PanelBody, ToggleControl, ToolbarGroup } from '@wordpress/components';
import {
  AlignmentToolbar,
  BlockControls,
  InspectorControls,
  RichText,
  getFontSize,
  __experimentalUseEditorFeature as useEditorFeature,
} from '@wordpress/block-editor';
import { createBlock } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { useEffect, useState, useRef } from '@wordpress/element';
import { formatLtr } from '@wordpress/icons';

/**
 * Browser dependencies
 */
const { getComputedStyle } = window;
const querySelector = window.document.querySelector.bind( document );

function ParagraphBlock( {
  attributes,
  mergeBlocks,
  onReplace,
  onRemove,
  setAttributes,
} ) {
  const {
    align,
    content,
    placeholder,
  } = attributes;
  const ref = useRef();

  return (
    <>
      <RichText
        ref={ ref }
        identifier="content"
        tagName="p"
        className="mmm35-highlight"
        allowedFormats={['core/bold', 'core/link', 'core/italic']}
        value={ content }
        onChange={ ( newContent ) =>
          setAttributes( { content: newContent } )
        }
        onSplit={ ( value ) => {
          console.log('onsplit', value);
          if ( ! value ) {
            return createBlock( 'core/paragraph' );
          }

          return createBlock( 'mmm35/highlight', {
            ...attributes,
            content: value,
          } );
        } }
        onMerge={ mergeBlocks }
        onReplace={ onReplace }
        onRemove={ onRemove }
        aria-label={
          content
            ? __( 'Highlight block' )
            : __(
                'Empty block; start writing or type forward slash to choose a block'
              )
        }
        placeholder={
          placeholder ||
          __( 'Start writing or type / to choose a block' )
        }
        __unstableEmbedURLOnPaste
        __unstableAllowPrefixTransformations
      />
    </>
  );
}

export default ParagraphBlock;

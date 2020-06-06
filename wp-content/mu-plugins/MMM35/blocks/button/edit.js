/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useCallback, useState } from '@wordpress/element';
import {
  KeyboardShortcuts,
  PanelBody,
  RangeControl,
  TextControl,
  ToggleControl,
  ToolbarButton,
  ToolbarGroup,
  Popover,
} from '@wordpress/components';
import {
  BlockControls,
  InspectorControls,
  RichText,
  __experimentalLinkControl as LinkControl,
} from '@wordpress/block-editor';
import { rawShortcut, displayShortcut } from '@wordpress/keycodes';
import { link } from '@wordpress/icons';
import { createBlock } from '@wordpress/blocks';

const NEW_TAB_REL = 'noreferrer noopener';


function URLPicker( {
  isSelected,
  url,
  setAttributes,
  opensInNewTab,
  onToggleOpenInNewTab,
} ) {
  const [ isURLPickerOpen, setIsURLPickerOpen ] = useState( false );
  const openLinkControl = () => {
    setIsURLPickerOpen( true );

    // prevents default behaviour for event
    return false;
  };
  const linkControl = isURLPickerOpen && (
    <Popover
      position="bottom center"
      onClose={ () => setIsURLPickerOpen( false ) }
    >
      <LinkControl
        className="wp-block-navigation-link__inline-link-input"
        value={ { url, opensInNewTab } }
        onChange={ ( {
          url: newURL = '',
          opensInNewTab: newOpensInNewTab,
        } ) => {
          setAttributes( { url: newURL } );

          if ( opensInNewTab !== newOpensInNewTab ) {
            onToggleOpenInNewTab( newOpensInNewTab );
          }
        } }
      />
    </Popover>
  );
  return (
    <>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton
            name="link"
            icon={ link }
            title={ __( 'Link' ) }
            shortcut={ displayShortcut.primary( 'k' ) }
            onClick={ openLinkControl }
          />
        </ToolbarGroup>
      </BlockControls>
      { isSelected && (
        <KeyboardShortcuts
          bindGlobal
          shortcuts={ {
            [ rawShortcut.primary( 'k' ) ]: openLinkControl,
          } }
        />
      ) }
      { linkControl }
    </>
  );
}

function ButtonEdit( props ) {
  const {
    attributes,
    setAttributes,
    className,
    isSelected,
    onReplace,
    mergeBlocks,
  } = props;
  const {
    linkTarget,
    placeholder,
    rel,
    text,
    url,
  } = attributes;
  const onSetLinkRel = useCallback(
    ( value ) => {
      setAttributes( { rel: value } );
    },
    [ setAttributes ]
  );

  const onToggleOpenInNewTab = useCallback(
    ( value ) => {
      const newLinkTarget = value ? '_blank' : undefined;

      let updatedRel = rel;
      if ( newLinkTarget && ! rel ) {
        updatedRel = NEW_TAB_REL;
      } else if ( ! newLinkTarget && rel === NEW_TAB_REL ) {
        updatedRel = undefined;
      }

      setAttributes( {
        linkTarget: newLinkTarget,
        rel: updatedRel,
      } );
    },
    [ rel, setAttributes ]
  );

  return (
    <>
      <div>
        <RichText
          placeholder={ placeholder || __( 'Add text…' ) }
          value={ text }
          onChange={ ( value ) => setAttributes( { text: value } ) }
          withoutInteractiveFormatting
          className={ classnames(
            className,
            'wp-block-mmm35-button__link',
          ) }
          onSplit={ ( value ) =>
            createBlock( 'core/button', {
              ...attributes,
              text: value,
            } )
          }
          onReplace={ onReplace }
          onMerge={ mergeBlocks }
          identifier="text"
        />
      </div>
      <URLPicker
        url={ url }
        setAttributes={ setAttributes }
        isSelected={ isSelected }
        opensInNewTab={ linkTarget === '_blank' }
        onToggleOpenInNewTab={ onToggleOpenInNewTab }
      />
      <InspectorControls>
        <PanelBody title={ __( 'Link settings' ) }>
          <ToggleControl
            label={ __( 'Open in new tab' ) }
            onChange={ onToggleOpenInNewTab }
            checked={ linkTarget === '_blank' }
          />
          <TextControl
            label={ __( 'Link rel' ) }
            value={ rel || '' }
            onChange={ onSetLinkRel }
          />
        </PanelBody>
      </InspectorControls>
    </>
  );
}

export default ButtonEdit;

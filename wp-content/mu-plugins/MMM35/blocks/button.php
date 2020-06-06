<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package MMM35
 */

function mmm35_button_init() {
  // Skip block registration if Gutenberg is not enabled/merged.
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }
  $dir = dirname( __FILE__ );

  $index_js = 'button/dist.js';
  wp_register_script(
    'mmm35-button-editor',
    plugins_url( $index_js, __FILE__ ),
    array(
      'wp-block-editor',
      'wp-blocks',
      'wp-i18n',
      'wp-element',
    ),
    filemtime( "$dir/$index_js" )
  );

  $editor_css = 'button/editor.css';
  wp_register_style(
    'mmm35-button-editor',
    plugins_url( $editor_css, __FILE__ ),
    array(),
    filemtime( "$dir/$editor_css" )
  );

  $style_css = 'button/style.css';
  wp_register_style(
    'mmm35-button',
    plugins_url( $style_css, __FILE__ ),
    array(),
    filemtime( "$dir/$style_css" )
  );

  register_block_type( 'mmm35/button', array(
    'editor_script' => 'mmm35-button-editor',
    'editor_style'  => 'mmm35-button-editor',
    'style'   => 'mmm35-button',
    'attributes'  => array(
      'url' => array(
        'type' => 'string',
        'source' => 'attribute',
        'selector' => 'a',
        'attribute' => 'href'
      ),
      'title' => array(
        'type' => 'string',
        'source' => 'attribute',
        'selector' => 'a',
        'attribute' => 'title'
      ),
      'text' => array(
        'type' => 'string',
        'source' => 'html',
        'selector' => 'a'
      ),
      'linkTarget' => array(
        'type' => 'string',
        'source' => 'attribute',
        'selector' => 'a',
        'attribute' => 'target'
      ),
      'rel' => array(
        'type' => 'string',
        'source' => 'attribute',
        'selector' => 'a',
        'attribute' => 'rel'
      ),
      /*
		"placeholder": {
			"type": "string"
		},
		"borderRadius": {
			"type": "number"
		},
		"style": {
			"type": "object"
		},
		"backgroundColor": {
			"type": "string"
		},
		"textColor": {
			"type": "string"
		},
		"gradient": {
			"type": "string"
		}
       */
    ),
  ));
}
add_action( 'init', 'mmm35_button_init' );

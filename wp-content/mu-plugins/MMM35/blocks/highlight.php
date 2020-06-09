<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package MMM35
 */

function mmm35_highlight_init() {
  // Skip block registration if Gutenberg is not enabled/merged.
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }
  $dir = dirname( __FILE__ );

  $index_js = 'highlight/dist.js';
  wp_register_script(
    'mmm35-highlight-editor',
    plugins_url( $index_js, __FILE__ ),
    array(
      'wp-block-editor',
      'wp-blocks',
      'wp-i18n',
      'wp-element',
    ),
    filemtime( "$dir/$index_js" )
  );

  $editor_css = 'highlight/editor.css';
  wp_register_style(
    'mmm35-highlight-editor',
    plugins_url( $editor_css, __FILE__ ),
    array(),
    filemtime( "$dir/$editor_css" )
  );

  $style_css = 'highlight/style.css';
  wp_register_style(
    'mmm35-highlight',
    plugins_url( $style_css, __FILE__ ),
    array(),
    filemtime( "$dir/$style_css" )
  );

  register_block_type( 'mmm35/highlight', array(
    'editor_script' => 'mmm35-highlight-editor',
    'editor_style'  => 'mmm35-highlight-editor',
    'style'   => 'mmm35-highlight',
    'attributes'  => array(
        'content' => array(
          'type' => 'string',
          'source' => 'html',
          'selector' => 'p',
          'default' => ''
        ),
        'placeholder' => array(
          'type' => 'string'
        ),
    ),
  ));
}
add_action( 'init', 'mmm35_highlight_init' );

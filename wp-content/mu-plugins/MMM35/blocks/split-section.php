<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package MMM35
 */

function mmm35_render($attributes, $content) {
  return '<flp-mmm35 class="alignfull" v-bind="'.htmlspecialchars(json_encode($attributes)).'" />';
}

function mmm35_block_init() {
  // Skip block registration if Gutenberg is not enabled/merged.
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }
  $dir = dirname( __FILE__ );

  $index_js = 'split-section/dist.js';
  wp_register_script(
    'mmm35-block-editor',
    plugins_url( $index_js, __FILE__ ),
    array(
      'wp-block-editor',
      'wp-blocks',
      'wp-i18n',
      'wp-element',
    ),
    filemtime( "$dir/$index_js" )
  );

  $editor_css = 'split-section/editor.css';
  wp_register_style(
    'mmm35-block-editor',
    plugins_url( $editor_css, __FILE__ ),
    array(),
    filemtime( "$dir/$editor_css" )
  );

  $style_css = 'split-section/style.css';
  wp_register_style(
    'mmm35-block',
    plugins_url( $style_css, __FILE__ ),
    array(),
    filemtime( "$dir/$style_css" )
  );

  register_block_type( 'mmm35/split-section', array(
    'editor_script' => 'mmm35-block-editor',
    'editor_style'  => 'mmm35-block-editor',
    'style'   => 'mmm35-block',
    'attributes'  => array(
      'image' => array(
        'type' => 'object'
      ),
    ),
    'render_callback' => 'mmm35_render',
  ) );
}
add_action( 'init', 'mmm35_block_init' );

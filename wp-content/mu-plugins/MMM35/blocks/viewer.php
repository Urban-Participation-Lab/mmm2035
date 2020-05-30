<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package MMM35
 */

function jbng_render($attributes, $content) {
  return '<flp-jbng class="alignfull" v-bind="'.htmlspecialchars(json_encode($attributes)).'" />';
}

function jbng_block_init() {
  // Skip block registration if Gutenberg is not enabled/merged.
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }
  $dir = dirname( __FILE__ );

  $index_js = 'viewer/viewer.js';
  wp_register_script(
    'jbng-block-editor',
    plugins_url( $index_js, __FILE__ ),
    array(
      'wp-block-editor',
      'wp-blocks',
      'wp-i18n',
      'wp-element',
    ),
    filemtime( "$dir/$index_js" )
  );

  $editor_css = 'viewer/editor.css';
  wp_register_style(
    'jbng-block-editor',
    plugins_url( $editor_css, __FILE__ ),
    array(),
    filemtime( "$dir/$editor_css" )
  );

  $style_css = 'viewer/style.css';
  wp_register_style(
    'jbng-block',
    plugins_url( $style_css, __FILE__ ),
    array(),
    filemtime( "$dir/$style_css" )
  );

  register_block_type( 'jbng/viewer', array(
    'editor_script' => 'jbng-block-editor',
    'editor_style'  => 'jbng-block-editor',
    'style'   => 'jbng-block',
    'attributes'  => array(
      'images' => array(
        'default' => array(),
        'type' => 'array',
        'items' => array(
          'type' => 'object'
        )
      ),
    ),
    'render_callback' => 'jbng_render',
  ) );
}
add_action( 'init', 'jbng_block_init' );

<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package MMM35
 */

function mmm35_media_text_init() {
  // Skip block registration if Gutenberg is not enabled/merged.
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }
  $dir = dirname( __FILE__ );

  $index_js = 'media-text/dist.js';
  wp_register_script(
    'mmm35-media-text-editor',
    plugins_url( $index_js, __FILE__ ),
    array(
      'wp-block-editor',
      'wp-blocks',
      'wp-i18n',
      'wp-element',
    ),
    filemtime( "$dir/$index_js" )
  );

  $editor_css = 'media-text/editor.css';
  wp_register_style(
    'mmm35-media-text-editor',
    plugins_url( $editor_css, __FILE__ ),
    array(),
    filemtime( "$dir/$editor_css" )
  );

  $style_css = 'media-text/style.css';
  wp_register_style(
    'mmm35-media-text',
    plugins_url( $style_css, __FILE__ ),
    array(),
    filemtime( "$dir/$style_css" )
  );

  register_block_type( 'mmm35/media-text', array(
    'editor_script' => 'mmm35-media-text-editor',
    'editor_style'  => 'mmm35-media-text-editor',
    'style'   => 'mmm35-media-text',
    'attributes'  => array(
      "mediaAlt" => array(
              "type" => "string",
              "source" => "attribute",
              "selector" => "figure img",
              "attribute" => "alt",
              "default" => ""
      ),
      "mediaCaption" => array(
              "type" => "string",
              "source" => "attribute",
              "selector" => "figure figcaption",
              "default" => ""
      ),
      "mediaPosition" => array(
              "type" => "string",
              "default" => "left"
      ),
      "mediaId" => array(
              "type" => "number"
      ),
      "mediaUrl" => array(
              "type" => "string",
              "source" => "attribute",
              "selector" => "figure video,figure img",
              "attribute" => "src"
      ),
      "mediaLink" => array(
              "type" => "string"
      ),
      "linkDestination" => array(
              "type" => "string"
      ),
      "linkTarget" => array(
              "type" => "string",
              "source" => "attribute",
              "selector" => "figure a",
              "attribute" => "target"
      ),
      "href" => array(
        "type" => "string",
        "source" => "attribute",
        "selector" => "figure a",
        "attribute" => "href"
      ),
      "rel" => array(
        "type" => "string",
        "source" => "attribute",
        "selector" => "figure a",
        "attribute" => "rel"
      ),
      "linkClass" => array(
        "type" => "string",
        "source" => "attribute",
        "selector" => "figure a",
        "attribute" => "class"
      ),
      "mediaType" => array(
        "type" => "string"
      )
    ),
  ));
}
add_action( 'init', 'mmm35_media_text_init' );

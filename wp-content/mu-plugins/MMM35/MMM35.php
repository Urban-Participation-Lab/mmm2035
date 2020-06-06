<?php
/**
 * Plugin Name:     MMM35
 * Description:     MMM35 Gutenberg Blocks
 * Author:          Benjamin Bädorf
 * Author URI:      https://benjaminbaedorf.eu
 * Text Domain:     MMM35
 * Version:         0.1.0
 *
 * @package         MMM35
 */

define( 'MMM35_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function mmm35_block_category( $categories, $post ) {
  return array_merge(
    array(
      array(
        'slug' => 'mmm35-blocks',
        'title' => __( 'MMM35', 'MMM35' ),
      ),
    ),
    $categories
  );
}
add_filter( 'block_categories', 'mmm35_block_category', 10, 2);

require_once( MMM35_PLUGIN_DIR . '/blocks/media-text.php' );
// require_once( MMM35_PLUGIN_DIR . '/blocks/introduction.php' );
require_once( MMM35_PLUGIN_DIR . '/blocks/button.php' );

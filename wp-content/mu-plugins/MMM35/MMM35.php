<?php
/**
 * Plugin Name:     MMM35
 * Description:     View 3D models with three.js
 * Author:          Benjamin Bädorf
 * Author URI:      https://benjaminbaedorf.eu
 * Text Domain:     3dviewer
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

function mmm35_file_mimes( $mimes ) {
  $mimes['json'] = 'application/json'; 

  return $mimes;
}
add_filter( 'upload_mimes', 'mmm35_file_mimes' );

require_once( MMM35_PLUGIN_DIR . '/blocks/split-section.php' );

<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

require_once( get_template_directory() . '/classes/WalkerNavMenu.php' );

function mmm35_theme_support() {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 1200, 9999 );

  // Add custom image size used in Cover Template.
  add_image_size( 'mmm35-fullscreen', 1980, 9999 );
  // Add support for full and wide align images.
  add_theme_support( 'align-wide' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'mmm35_theme_support' );

function mmm35_register_styles() {
  $theme_version = wp_get_theme()->get( 'Version' );
  wp_enqueue_style( 'mmm35-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'mmm35_register_styles' );

function mmm35_register_scripts() {
  $theme_version = wp_get_theme()->get( 'Version' );
  wp_enqueue_style( 'mmm35-3d', get_template_directory() . '/main.js', array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'mmm35_register_scripts' );

function mmm35_menus() {

  $locations = array(
    'primary'  => __( 'Top navigation menu', 'mmm35' ),
    'footer'   => __( 'Footer Menu', 'mmm35' ),
  );

  register_nav_menus( $locations );
}

add_action( 'init', 'mmm35_menus' );
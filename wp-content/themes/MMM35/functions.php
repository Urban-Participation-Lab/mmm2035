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

  add_theme_support( 'custom-logo', array(
    'height'      => 200,
    'width'       => 400,
    'flex-height' => false,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );
  add_theme_support( 'align-wide' );

  add_editor_style( 'editor-styles.css' );
  add_theme_support( 'editor-styles' );

  // Disable breakage
  add_theme_support( 'disable-custom-font-sizes' );
  add_theme_support( 'disable-custom-colors' );
  add_theme_support( 'disable-custom-gradients' );
}
add_action( 'after_setup_theme', 'mmm35_theme_support' );

function mmm35_register_styles() {
  $theme_version = wp_get_theme()->get( 'Version' );
  wp_enqueue_style( 'mmm35-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'mmm35_register_styles' );

function mmm35_register_scripts() {
  $theme_version = wp_get_theme()->get( 'Version' );
  wp_enqueue_script( 'mmm35-josh', 'https://cdn.jsdelivr.net/npm/joshjs@1.0.0/dist/josh.es5.min.js', array(), $theme_version, true );
  wp_enqueue_script( 'mmm35-main', get_template_directory_uri() . '/main.js', array(), $theme_version, true );
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

function mmm35_pre_get_posts( $query ) {
  // do not modify queries in the admin
  if( is_admin() ) {
    return $query;
  }
  
  if( isset( $query->query_vars['category_name']) && $query->query_vars['category_name'] == 'veranstaltungen' ) {
    $show_past = isset( $_GET['show_past_events'] ); 
    $query-> set(
      'meta_query',
      array(
        'key' => 'end_date',
        'compare' => $show_past ? '<' : '>',
        'value' => date('Ymd'),
        'type' => 'numeric'
      )
    );

    $query->set( 'orderby', 'meta_value' );  
    $query->set( 'meta_key', 'end_date' );   
    $query->set( 'order', 'ASC' ); 
  }
  // return
  return $query;
}

add_action('pre_get_posts', 'mmm35_pre_get_posts');

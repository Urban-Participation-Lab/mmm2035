<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <script>document.getElementsByClassName('no-js')[0].classList.remove('no-js');</script>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <?php $viewport_content = apply_filters( 'mmm35_viewport_content', 'width=device-width, initial-scale=1' ); ?>
  <meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <?php
  // Output the nav.
  get_template_part( 'template-parts/navigation' );

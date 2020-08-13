<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

$ctas = new WP_Query( array( 'meta_key' => 'cta', 'meta_value' => '', 'meta_compare' => '!=' ) );

if ($ctas->found_posts === "0") {
  return;
}

?>
<div class="mmm35-ctas">
  <?php
  foreach ( $ctas->posts as $post ) {
    $meta = get_post_meta( $post->ID, 'cta' );
    if ( count( $meta ) === 0 ) {
      continue;
    }
  ?>
    <div class="wp-block-mmm35-button wp-block-mmm35-button_cta">
      <a
        class="wp-block-mmm35-button__link"
        href="<?php echo get_permalink( $post ); ?>"
        title="<?php echo $post->post_title; ?>"
      ><?php echo $meta[0]; ?></a>
    </div>
  <? } ?>
</div>

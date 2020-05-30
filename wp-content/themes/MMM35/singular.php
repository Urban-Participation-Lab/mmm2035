<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
get_header();
?>

<main class="mmm35-main mmm35-post">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="alignfull">
      <?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'mmm35-post__hero' ] ); ?>
  </header>
  
  <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>

<?php
get_footer();

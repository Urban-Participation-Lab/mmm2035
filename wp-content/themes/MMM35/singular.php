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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php if (has_post_thumbnail()) : ?>
    <header class="mmm35-hero">
        <?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'mmm35-hero__image' ] ); ?>
    </header>
  <?php endif; ?>
  <main class="mmm35-main mmm35-post">
    <?php the_content(); ?>
  </main>
<?php endwhile; endif; ?>

<?php
get_footer();

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

<main class="mmm35-main">
  <header></header>
  
  <div class="mmm35-project-list">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <a
        href="<?php the_permalink(); ?>"
        title="<?php the_title_attribute(); ?>"
        class="mmm35-project-list__item"
      >
        <?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'mmm35-project-list__item-image' ] ); ?>
        <?php the_title(); ?>
        <?php
          $meta = array_filter(array(
            get_post_custom_values( 'description' )[0],
            get_post_custom_values( 'year' )[0],
          ), function ($v) { return $v !== NULL; });
          if (count( $meta ) > 0) { 
        ?>
          <br /><?php echo implode( ', ', $meta ) ?>
        <?php } ?>
      </a>
    <?php endwhile; else : ?>
      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();

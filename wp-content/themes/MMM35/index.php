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
  
  <div class="mmm35-post-list">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <a
        href="<?php the_permalink(); ?>"
        title="<?php the_title_attribute(); ?>"
        class="mmm35-post-list__item"
      >
        <?php if (has_post_thumbnail()) : ?>
          <figure class="mmm35-figure mmm35-post-list__item-image">
            <?php the_post_thumbnail( 'post-thumbnail', [ 'class' => '' ] ); ?>
            <figcaption class="mmm35-figure__caption"><?php the_post_thumbnail_caption(); ?></figcaption>
          </figure>
        <?php endif; ?>
        <?php
          $types = get_post_meta( $post->ID, 'type' );
          $dates = get_post_meta( $post->ID, 'date' );
          $meta = array();
          if (!empty($types)) { array_push( $meta, implode( $types, ', ' ) ); }
          if (!empty($dates)) { array_push( $meta, implode( $dates, ', ' ) ); }
          if (!empty($meta)) :
        ?>
          <div class="mmm35-post-list__item-meta"><?php echo implode($meta, ', '); ?></div>
        <?php endif; ?>
        <h2 class="mmm35-post-list__item-title"><?php the_title(); ?></h2>
        <p><?php echo wp_trim_words( wp_strip_all_tags( get_the_content() ), 15, '...' ); ?></p>
      </a>
    <?php endwhile; else : ?>
      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();

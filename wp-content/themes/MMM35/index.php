<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
get_header();

$index = 0;
?>

<div class="mmm35-page">
  <header></header>
  
  <main class="mmm35-main">
    <div class="mmm35-post-list">
      <div class="mmm35-post-list__items">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $index++; ?>
        <a
          href="<?php the_permalink(); ?>"
          title="<?php the_title_attribute(); ?>"
          class="mmm35-post-list__item animate"
          data-josh-anim-name="fadeInUp"
          data-josh-duration="400ms"
          data-josh-delay="<?php echo $index * 50 ?>ms"
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
    </div>
  </main>
</div>

<?php
  get_footer();

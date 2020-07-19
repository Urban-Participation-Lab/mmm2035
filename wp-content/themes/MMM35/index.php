<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

global $wp_query;
global $query_string;

$queried_object = get_queried_object();
$category_id = $queried_object->term_id;
wp_parse_str( $query_string, $search_query );
$search = new WP_Query( $search_query );
$total_results = $wp_query->found_posts;

get_header();
?>

<div class="mmm35-page">
  <header class="mmm35-hero">
    <h1 class="mmm35-hero__title">
      <?php echo $queried_object->name ?>
    </h1>
    <?php get_search_form(); ?>
  </header>
  
  <main class="mmm35-main">
    <div class="mmm35-post-list">
      <div class="mmm35-post-list__items">
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
          <div
            class="mmm35-post-list__item-data animate"
            data-josh-anim-name="fadeInUp"
            data-josh-duration="400ms"
            data-josh-anim-delay="400ms"
          >
            <?php
              $types = get_post_meta( $post->ID, 'type' );
              $dates = get_post_meta( $post->ID, 'date_description' );
              $meta = array();
              if (!empty($types)) { array_push( $meta, implode( $types, ', ' ) ); }
              if (!empty($dates)) { array_push( $meta, implode( $dates, ', ' ) ); }
              if (!empty($meta)) :
            ?>
              <div class="mmm35-post-list__item-meta"><?php echo implode($meta, ', '); ?></div>
            <?php endif; ?>
            <h2 class="mmm35-post-list__item-title"><?php the_title(); ?></h2>
            <p><?php echo wp_trim_words( wp_strip_all_tags( get_the_content() ), 15, '...' ); ?></p>
          </div>
        </a>
      <?php endwhile; else : ?>
        <p>Keine <?php echo $queried_object->name ?> gefunden</p>
      <?php endif; ?>
      </div>
      <div class="mmm35-post-list__pagination">
        <?php posts_nav_link(); ?>
      </div>
    </div>
  </main>
</div>

<?php
  get_footer();

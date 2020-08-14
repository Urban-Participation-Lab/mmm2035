<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

function has_content($str) {
  var_dump($str);
  return $str != '';
}

$categories = get_the_category();
if (empty($categories)) {
  return;
}

$category = $categories[0];
$posts = get_posts(array( 'numberposts' => 3, 'category' => $category->cat_ID, 'exclude' => array(get_the_ID()) ) );
?>
<div class="mmm35-post-list mmm35-post-list_category-item-list">
  <h2 class="mmm35-post-list__title">Weitere <?php echo $category->name ?></h2>
  <div class="mmm35-post-list__items">
  <?php foreach ( $posts as $post ) : ?>
    <a
      class="mmm35-post-list__item"
      href="<?php the_permalink( $post->ID ); ?>"
      title="<?php the_title_attribute($post->ID); ?>"
    >
      <?php if (has_post_thumbnail( $post->ID )) : ?>
        <figure class="mmm35-figure mmm35-post-list__item-image">
          <?php the_post_thumbnail( $post->ID, 'post-thumbnail', [ 'class' => '' ] ); ?>
          <figcaption class="mmm35-figure__caption"><?php the_post_thumbnail_caption( $post->ID ); ?></figcaption>
        </figure>
      <?php endif; ?>
      <div
        class="mmm35-post-list__item-data animate"
        data-josh-anim-name="fadeInUp"
        data-josh-duration="400ms"
        data-josh-anim-delay="400ms"
      >
        <?php
          // TODO: Dedupe this whole section with index.php at some point
          $types = array_filter( get_post_meta( $post->ID, 'type' ), 'has_content' );
          $dates = array_filter( get_post_meta( $post->ID, 'date_description' ), 'has_content' );
          $meta = array();
          if ( !empty($types) ) { array_push( $meta, implode( $types, ', ' ) ); }
          if ( !empty($dates) ) { array_push( $meta, implode( $dates, ', ' ) ); }
          if ( !empty($meta) ) :
        ?>
          <div class="mmm35-post-list__item-meta"><?php echo implode($meta, ', '); ?></div>
        <?php endif; ?>
        <h2 class="mmm35-post-list__item-title"><?php echo get_the_title( $post ); ?></h2>
        <p><?php echo wp_trim_words( wp_strip_all_tags( get_the_content( null, false, $post->ID ) ), 15, '...' ); ?></p>
      </div>
    </a>
  <?php endforeach; ?>
  </div>
</div>

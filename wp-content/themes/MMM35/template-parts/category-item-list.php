<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

$categories = get_the_category();
if (empty($categories)) {
  return;
}

$category = $categories[0];
$posts = get_posts(array( 'numberposts' => 10, 'category' => $category->cat_ID ) );
?>
<div class="mmm35-post-list">
  <h2 class="mmm35-post-list__title">Weitere <?php echo $category->name ?></h2>
  <div class="mmm35-post-list__items">
  <?php foreach ( $posts as $index=>$post ) : ?>
    <a
      href="<?php the_permalink( $post->ID ); ?>"
      title="<?php the_title_attribute($post->ID); ?>"
      class="mmm35-post-list__item animate"
      data-josh-anim-name="fadeInUp"
      data-josh-duration="400ms"
      data-josh-anim-delay="<?php echo $index * 50 ?>ms"
    >
      <?php if (has_post_thumbnail( $post->ID )) : ?>
        <figure class="mmm35-figure mmm35-post-list__item-image">
          <?php the_post_thumbnail( $post->ID, 'post-thumbnail', [ 'class' => '' ] ); ?>
          <figcaption class="mmm35-figure__caption"><?php the_post_thumbnail_caption( $post->ID ); ?></figcaption>
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
      <h2 class="mmm35-post-list__item-title"><?php echo get_the_title( $post ); ?></h2>
      <p><?php echo wp_trim_words( wp_strip_all_tags( get_the_content( $post->ID ) ), 15, '...' ); ?></p>
    </a>
  <?php endforeach; ?>
  </div>
</div>

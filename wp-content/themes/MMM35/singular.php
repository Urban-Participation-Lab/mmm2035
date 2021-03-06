<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

get_header();

$has_featured_images = false;
if ( class_exists( 'Simple_Multiple_Featured_Images' ) && isset( $simple_multiple_featured_images ) ) {
  $smfi_api = $simple_multiple_featured_images -> get_public_api();
  if (isset($smfi_api) && $smfi_api->is_smfi_showed() ) {
    $featured_image_ids = $smfi_api->get_all_featured_image_ids( get_the_ID(), 'full', [ 'class' => 'mmm35-hero__image' ] );
    $has_featured_images = count( $featured_image_ids ) > 0;
  }
}
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="mmm35-hero <?php if ( has_post_thumbnail() || $has_featured_images ) { echo 'mmm35-hero_has-image'; } ?>">
    <?php if ( is_front_page() ) : ?>
      <?php get_template_part( 'template-parts/ctas' ); ?>
    <?php else : ?>
      <h1 class="mmm35-hero__title"><?php the_title(); ?></h1>
    <?php endif; ?>
    <?php if ( $has_featured_images ) :
        foreach ($featured_image_ids as $id) :
          $caption = $smfi_api->get_image_caption_by_id( $id );
    ?>
      <figure class="mmm35-hero__figure mmm35-figure">
        <?php echo $smfi_api->get_featured_image_tag( $id, 'full', [ 'class' => 'mmm35-hero__image' ] ); ?>
        <figcaption class="mmm35-figure__caption"><?php echo $caption ?></figcaption>
      </figure> 
    <?php endforeach; ?>
      <script type="text/javascript">
        const images = document.getElementsByClassName('mmm35-hero__figure');
        let active = 0;
        function nextImage() {
          active = (active === images.length - 1) ? 0 : active + 1;
          for (let i = 0; i < images.length; i++) {
            if (i === active) {
              images[i].classList.remove('mmm35-hero__figure_hidden');
            } else {
              images[i].classList.add('mmm35-hero__figure_hidden');
            }
          }
        }
        setInterval(nextImage, 5000);
      </script>
    <?php elseif ( has_post_thumbnail() ) : ?>
      <figure class="mmm35-hero__figure mmm35-figure">
        <?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'mmm35-hero__image' ] ); ?>
        <figcaption class="mmm35-figure__caption"><?php the_post_thumbnail_caption(); ?></figcaption>
      </figure> 
    <?php endif; ?>
  </header>
  <div class="mmm35-page">
    <main class="mmm35-main mmm35-post">
      <?php the_content(); ?>
    </main>
    <?php if ( is_single() ) : ?>
      <?php get_template_part( 'template-parts/category-post-list' ) ?>
    <?php endif; ?>
  </div>
<?php endwhile; endif; ?>
<?php
  get_footer();

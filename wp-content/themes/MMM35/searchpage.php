
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
    <h1 class="mmm35-hero__title"><?php echo $queried_object->name ?></h1>
  </header>
  
  <main class="mmm35-main">
    <?php get_template_part( 'template-parts/main-post-list' ) ?>
  </main>
</div>

<?php
  get_footer();

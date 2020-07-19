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
    <form
      action="./"
      method="get"
      class="mmm35-search-form"
    >
      <label
        class="mmm35-search-form__input"
        value="<?php the_search_query(); ?>"
      >
        <input
          type="checkbox"
          name="show_full_history"
          <?php echo isset( $_GET['show_full_history'] ) ? 'checked' : ''; ?>
        />
        Vergangene Anzeigen
      </label>
      <input
        class="mmm35-search-form__input"
        placeholder="Suchen"
        name="s"
        value="<?php the_search_query(); ?>"
      />
      <button
        class="mmm35-search-form__submit"
        type="submit"
        aria-label="Suchen"
      >
        <?php require_once( get_template_directory() . '/assets/icons/search.svg' ); ?>
      </button>
    </form>
  </header>
  
  <main class="mmm35-main">
    <?php get_template_part( 'template-parts/main-post-list' ) ?>
  </main>
</div>

<?php
  get_footer();

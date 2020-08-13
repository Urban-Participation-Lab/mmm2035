<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

$queried_object = get_queried_object();
?>

<form
  action="./"
  method="get"
  id="searchform"
  class="mmm35-search-form"
>
  <?php if ($queried_object->slug === 'veranstaltungen') : ?>
    <label
      class="mmm35-search-form__input"
      value="<?php the_search_query(); ?>"
    >
      <input
        type="checkbox"
        name="show_full_history"
        <?php echo isset( $_GET['show_full_history'] ) ? 'checked' : ''; ?>
        onchange="document.getElementById('searchform').submit()"
      />
      Vergangene Anzeigen
    </label>
  <?php endif; ?>
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

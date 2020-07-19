<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>

<form
  action="./"
  method="get"
  class="mmm35-search-form"
>
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

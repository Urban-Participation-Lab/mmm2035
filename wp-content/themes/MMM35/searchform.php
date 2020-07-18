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
  action="/"
  method="get"
  class="mmm35-search-form"
>
  <input
    class="mmm35-search-form__input"
    name="s"
    value="<?php the_search_query(); ?>"
    required
  />
  <button
    class="mmm35-search-form__submit"
    type="submit"
    aria-label="Suchen"
  >
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg"
      alt="Suche"
    />
  </button>
</form>

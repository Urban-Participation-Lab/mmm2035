<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>
<nav class="mmm35-head">
  <a
    href="/"
    class="mmm35-head__logo"
  >
    <img
      src="<?php echo get_template_directory_uri(); ?>/assets/move-logo.png"
      alt="Logo MoVe"
    />
  </a> 

  <button
    class="mmm35-head__mobile-nav-toggle"
    type="button"
    onclick="($event) => console.log($event); }"
  >Menu</button>
  <script type="text/javascript">
    Array.from(document.getElementsByClassName('mmm35-head__mobile-nav-toggle')).forEach(function (el) {
      el.addEventListener('click', function ($event) {
        $event.target.parentElement.classList.toggle('mmm35-head_mobile-nav-open'); 
      });
    });
  </script>
  <?php if ( has_nav_menu( 'primary' ) ) { ?>
    <?php
      wp_nav_menu(
        array(
          'container'  => '',
          'items_wrap' => '<ul class="mmm35-nav">%3$s</ul>',
          'theme_location' => 'primary',
          'depth' => 1,
          'walker' => new MMM35WalkerNavMenu(),
        )
      );
    ?>
  <?php } ?>
</nav>

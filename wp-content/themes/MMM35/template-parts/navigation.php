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
  ><?php echo get_bloginfo( 'name' ) ?></a> 

  <?php if ( has_nav_menu( 'primary' ) ) { ?>
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
    <ul class="mmm35-nav">
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

      if ( class_exists( 'WPGlobus' ) ) {
          foreach( WPGlobus::Config()->enabled_languages as $lang ) {
            if ( $lang == WPGlobus::Config()->language ) {
              continue;
            }
            $flag = WPGlobus::Config()->flags_url . WPGlobus::Config()->flag[ $lang ];
            echo '<li class="mmm35-nav__item mmm35-nav__item-lang"><a class="mmm35-nav__item-link" href="' . WPGlobus_Utils::localize_current_url( $lang ). '">';
            echo $lang;
            echo '</a></li>';

          }
      }
    ?>
    </ul>
  <?php } ?>
</nav>

<?php
/**
 *
 * @package MMM35
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
?>
    <footer class="mmm35-footer">
      <p class="mmm35-footer__credits">
        MOVE |
        <a href="https://uplab.space" rel="noreferrer" target="_blank">Urban Participation Lab</a>
      </p>

      <?php if ( has_nav_menu( 'footer' ) ) { ?>
        <?php wp_nav_menu(
          array(
            'container'  => '',
            'items_wrap' => '<ul class="mmm35-footer__nav">%3$s</ul>',
            'theme_location' => 'footer',
            'depth' => 1,
            'walker' => new MMM35WalkerNavMenu('mmm35-footer__nav'),
          )
        ); ?>
      <?php } ?>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>

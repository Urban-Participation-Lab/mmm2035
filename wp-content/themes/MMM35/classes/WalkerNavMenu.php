<?php

class MMM35WalkerNavMenu extends Walker_Nav_Menu {
  private $baseClass = 'mmm35-nav';

  function __construct( $baseClass = 'mmm35-nav' ) {
    $this->baseClass = $baseClass;
  }

  // Tell Walker where to inherit it's parent and id values
  var $db_fields = array(
    'parent' => 'menu_item_parent', 
    'id'     => 'db_id' 
  );

  public function start_lvl ( &$output, $depth = 0, $args = array() ) {
    $output .= "<ul class=\"" . $this->baseClass . "\">\n";
  }

  public function end_lvl ( &$output, $depth = 0, $args = array() ) {
    $output .= "</ul>\n";
  }

  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $title = apply_filters( 'nav_menu_item_title', $item->title, $item, $args, $depth );

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
    $class_names = $class_names ? esc_attr( $class_names ) : '';

    $is_image_link = strpos($title, 'wp-content/uploads') !== false;

    $output .= sprintf( "\n<li class=\"" . $class_names . " " . $this->baseClass . "__item%s%s\"><a href=\"%s\" rel=\"noreferrer noopener\" class=\"" . $this->baseClass . "__item-link\">%s</a></li>\n",
      $item->current ? ' ' . $this->baseClass . '__item_current' : '',
      $is_image_link ? ' ' . $this->baseClass . '__item_image' : '',
      $item->url,
      $title
    );
  }
}

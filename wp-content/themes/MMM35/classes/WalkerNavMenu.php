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
    $output .= sprintf( "\n<li class=\"" . $this->baseClass . "__item%s\"><a href=\"%s\" class=\"" . $this->baseClass . "__item-link\">%s</a></li>\n",
      ( $item->object_id === get_the_ID() ) ? ' ' . $this->baseClass . '__item_current' : '',
      $item->url,
      $item->title
    );
  }
}

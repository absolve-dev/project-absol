<?php

/*
  Author: Cristian F. // Zero
  Description: Dynamic menu functionality for Wordpress (General), needs styling.
  Version: 1.0
*/

// functions.php
function register_additional_menus() { // function required if theme doesn't support more than 1 menu
  register_nav_menus( // registers menus in wordpress through an array
    array(
      'menu-name' => __('Menu Title')
    )
  );
}

add_action('init', 'register_menus'); // initializes function

// walkers.php
class custom_menu_walker extends Walker_Nav_Menu { // menu walker class for styling purposes
  function start_el(&$output, $item, $id = 0) { // messes with list and anchor elements
    $link = ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : ''; // is $item->url empty? if not, escape for safe text and add to variable
    $link_output = '<a' . $link . '> '. apply_filters('the_title', $item->title, $item->ID) .' </a>'; // anchor tag output, can change output for styling
    $output .= apply_filters ('walker_nav_menu_start_el', $link_output);
  }
}

// nav_location.php
if(has_nav_menu('menu-name')): // check if menu exists in settings (static name)
  if (class_exists('custom_menu_walker')): // check if our walker exists
    echo strip_tags(wp_nav_menu(
      array(
        'theme_location' => 'menu-name', // our menu
        'echo' => false, // return menu because we're already echoing
        'items_wrap' => '%3$s', // strip unordered list elements
        'walker' => new custom_menu_walker() // new walker object for styling
      )
    ), '<a>'); // strip everything but anchor elements
  endif;
endif;
?>

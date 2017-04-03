<?php

/*
  Author: Cristian F. // Zero
  Description: Repeater logic for Advanced Custom Fields on WordPress
  Version: 1.0
*/

$field_group = NULL;
$post_object = NULL;

if(have_rows($field_group)): // check if "field_group_name" has any data to show elements on a page
  while(have_rows($field_group)): the_row(); // iterate through the rows

    if(get_sub_field($post_object)): // checking if theres a post object, should probably loop through repeater with while anyway... I'll try later
      $post_object = get_sub_field($post_object); // add post object to variable
      $post = $post_object; // override post
      setup_postdata($post); // set overriden data

      the_permalink(); // get post object link
      the_post_thumbnail_url(); // get post object image url
      // theres more of these, will add as I use them
    endif;
    wp_reset_postdata(); // reset $post for the rest of the page

    $var1 = get_sub_field('non_object_field_name'); // add regular field data to variable
    //assumes these fields contain 1 value, if they do not a loop is required
?>

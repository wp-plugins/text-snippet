<?php

/**
 *  Plugin Name: Text Snippets
 *  Author: Jakob Snedled,
 *  Description: Create you small Text Snippets for use in posts or pages. Include a Text Snippet with the shortcode [ts w="the word"]. Create a Text Snippet with the title "the word", and the Shortcode will be replaced by the Text Snippet Content
 *  Idea: Allan Bo Jensen
 *  Version: 0.0.1
 **/

/**
------------------------------------------------------------------------
Copyright 2011 Snedled.dk

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/


/**
 * Text Snippet post type
*/
add_action('init', 'textsnippets_init');
function textsnippets_init(){
  $labels = array(
    'name' => _x('Text Snippet', 'post type general name'),
    'singular_name' => _x('Snippet', 'post type singular name'),
    'add_new' => _x('Add New', 'book'),
    'add_new_item' => __('Add New Snippet'),
    'edit_item' => __('Edit Snippet'),
    'new_item' => __('New Snippet'),
    'all_items' => __('All Snippets'),
    'view_item' => __('View Snippet'),
    'search_items' => __('Search Snippets'),
    'not_found' =>  __('No snippets found'),
    'not_found_in_trash' => __('No snippets found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Text Snippets'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor')
  ); 
  register_post_type('textsnippet',$args);
}

/**
 * Text Snippet shortcode function 
 *
*/

function textsnippet_func($atts) {
  if( !trim($atts['w']) ) return false; // returns false, if no "w"-attribute
  $post = get_page_by_title( $atts['w'] , ARRAY_A, 'textsnippet'); // get the textsnippet
  if(!$post) return $atts['w'];  // if no textsnippet, return the word
  return $post['post_content']; // else return the textsnippet content
}
add_shortcode('ts', 'textsnippet_func');

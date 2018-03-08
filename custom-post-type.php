<?php
/*
Plugin Name: Custom Post Type
Plugin URI: https://github.com/ggonzalezq/skeletor
Description: Create and manage custom post types.
Version: 1.0
Author: Gabriel Gonzalez
Author URI: https://github.com/ggonzalezq
License: GPLv2
*/

define( 'CUSTOM_POST_TYPE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( CUSTOM_POST_TYPE__PLUGIN_DIR . 'class.custom-post-type.php' );

add_action( 'init', function(){

  $custom_post_types = new CustomPostType( 'movies', array(
      'label' => 'Movies',
      'labels' => array(
        'name' => 'Movies',
        'singular_name' => 'Movie'
      )
  ) );

  $custom_post_types->register_post_type();
} );

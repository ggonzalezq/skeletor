<?php

class CustomPostType {


  public $post_type = '';

  public function __construct( $args = array() ){

    if( ! is_array($args) || ! sizeof($args) ) {
      return;
    }

    if( isset($args['post_type']) ) {
      $this->post_type = $args['post_type'];
    }
  }

  public function init(){
    register_post_type( $this->post_type,
      array(
        'labels' => array(
          'name' => __( 'Movies' ),
          'singular_name' => __( 'Movie' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'movies'),
      )
    );
  }
}
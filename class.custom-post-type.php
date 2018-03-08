<?php

class CustomPostType {

  public $post_type = '';
  public $singular_name = '';
  public $plural_name = '';
  public $args = array();

  public function __construct( $post_type = '', $args = array() ) {
    //TODO, check if the post type is available

    if ( ! is_string( $post_type ) || $post_type === '' || ! is_array($args) || ! sizeof($args) ) {
      $this->error( 'invalid parameters.' );
    }

    $this->post_type = $post_type;
    $this->singular_name = $args['labels']['singular_name'];
    $this->plural_name = $args['labels']['name'];
    $this->args = array_replace_recursive($this->get_default_args(), $args);
  }

  public function register_post_type(){
    if ( ! post_type_exists( $this->post_type ) ) {
      register_post_type( $this->post_type, $this->args);
    }
    else {
      $this->error( sprintf( 'The post name %s is already in use.', $this->post_type ) );
    }
  }

  public function get_default_args() {
    return array(
      'label' => sprintf( '%s', $this->singular_name ),
      'labels' => array(
        'name' => sprintf( '%s', $this->singular_name ),
        'singular_name' => sprintf( '%s', $this->plural_name ),
        'add_new' => 'Add New',
        'add_new_item' => sprintf( 'Add New %s', $this->singular_name ),
        'edit_item' => sprintf( 'Edit %s', $this->singular_name ),
        'new_item' => sprintf( 'New %s', $this->singular_name ),
        'view_item' => sprintf( 'View %s', $this->singular_name ),
        'view_items' => sprintf( 'View %s', $this->plural_name ),
        'search_items' => sprintf( 'Search %s', $this->plural_name ),
        'not_found' => sprintf( 'No %s found.', strtolower( $this->plural_name ) ),
        'not_found_in_trash' => sprintf('No %s found in Trash.', strtolower( $this->plural_name ) ),
        'parent_item_colon' => null,
        'all_items' => sprintf( 'All %s', $this->plural_name ),
        'archives' => sprintf( '%s Archives', $this->singular_name ),
        'attributes' => sprintf( '%s Attributes', $this->singular_name ),
        'insert_into_item' => sprintf( 'Insert into %s', strtolower( $this->singular_name ) ),
        'uploaded_to_this_item' => sprintf( 'Uploaded to this %s', strtolower( $this->singular_name ) ),
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image' => 'Use as featured image',
        'menu_name' => sprintf( '%s', $this->plural_name ),
        'filter_items_list' => sprintf( 'Filter %s list', strtolower( $this->plural_name ) ),
        'items_list_navigation' => sprintf( '%s list navigation', $this->plural_name ),
        'items_list' => sprintf( '%s list', $this->plural_name ),
        'name_admin_bar' => sprintf( '%s', $this->singular_name ),
      ),
      'description' => '',
      'public' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'show_in_menu' => true,
      'show_in_admin_bar' => true,
      'menu_position' => null,
      'menu_icon' => null,
      'capability_type' => 'post',
      'capabilities' => array(),
      'map_meta_cap' => null,
      'hierarchical' => false,
      'supports' => array('tltle', 'editor'),
      'register_meta_box_cb' => null,
      'taxonomies' => array(),
      'has_archive' => false,
      'rewrite' => true,
      'permalink_epmask' => EP_PERMALINK,
      'query_var' => true,
      'can_export' => true,
      'delete_with_user' => null,
      'show_in_rest' => false,
      'rest_base' => false,
      'rest_controller_class' => false,
    );
  }

  // TODO, move this function to a helper class
  /**
   * Helper function for display an error message on the frontend
   * @param string $message
   * @return null
   */
  public function error( $message = '' ) {
    if ( ! $message ) {
      return;
    }

    add_action( 'admin_notices', function () use ($message){
      printf( '<div class="notice notice-error"><p>%s</p></div>', $message );
    } );
  }
}
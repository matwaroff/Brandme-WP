<?php

function brandme_create_portfolio_types(){
  $labels = array(
    'name'               => 'Portfolios',
    'singular_name'      => 'Portfolio',
    'menu_name'          => 'Portfolios',
    'name_admin_bar'     => 'Portfolio',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Portfolio',
    'new_item'           => 'New Portfolio',
    'edit_item'          => 'Edit Portfolio',
    'view_item'          => 'View Portfolio',
    'all_items'          => 'All Portfolios',
    'search_items'       => 'Search Portfolios',
    'parent_item_colon'  => 'Parent Portfolio',
    'not_found'          => 'No Portfolios Found',
    'not_found_in_trash' => 'No Portfolios Found in Trash'
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-appearance',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
    'has_archive'         => true,
    'rewrite'             => array( 'slug' => 'portfolios', 'with_front' => false ),
    'query_var'           => true
  );

  register_post_type( 'bm_portfolio', $args );
    
  $labels = array(
    'name'               => 'Business Cards',
    'singular_name'      => 'Business Card',
    'menu_name'          => 'Business Cards',
    'name_admin_bar'     => 'Business Card',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Business Card',
    'new_item'           => 'New Business Card',
    'edit_item'          => 'Edit Business Card',
    'view_item'          => 'View Business Card',
    'all_items'          => 'All Business Cards',
    'search_items'       => 'Search Business Cards',
    'parent_item_colon'  => 'Parent Business Card',
    'not_found'          => 'No Business Cards Found',
    'not_found_in_trash' => 'No Business Cards Found in Trash'
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-appearance',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
    'has_archive'         => true,
    'rewrite'             => array( 'slug' => 'business-card', 'with_front' => false ),
    'query_var'           => true
  );

  register_post_type( 'bm_business_card', $args );
}
register_activation_hook( __FILE__, 'brandme_create_portfolio_types');

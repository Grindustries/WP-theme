<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function my_styles() {
    wp_enqueue_style('smallbusiness', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'my_styles');

/*
 * Register navigation menus so tht they can be access in the admin dashboard
 */
register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),
));

/*
 * Create a new post type (Book)
 */
add_action('init', 'create_post_type');

function create_post_type() {
    register_post_type('Books', array(
        'labels' => array(
            'name' => __('books'),
            'singular_name' => __('books')
        ),
        'public' => true,
        'has_archive' => true,
            )
    );
}

add_action('init', 'create_customer');

function create_customer() {
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonials')
        ),
        'public' => true,
        'has_archive' => true,
            )
    );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_testim_taxonomies', 0);

// create two taxonomies, genres and writers for the post type "book"
function create_testim_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Customer Types', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Customer Type', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Customer Types', 'textdomain'),
        'all_items' => __('All Customer Types', 'textdomain'),
        'parent_item' => __('Parent Customer Type', 'textdomain'),
        'parent_item_colon' => __('Parent Customer Type:', 'textdomain'),
        'edit_item' => __('Edit Customer Type', 'textdomain'),
        'update_item' => __('Update Customer Type', 'textdomain'),
        'add_new_item' => __('Add New Customer Type', 'textdomain'),
        'new_item_name' => __('New Customer Type Name', 'textdomain'),
        'menu_name' => __('Customer Type', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'customer_type'),
    );

    register_taxonomy('customer_type', array('testimonials'), $args);


}

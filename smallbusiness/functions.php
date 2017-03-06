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

// hook into the init action and call create_book_taxonomies when it fires




//add_action('init', 'create_book_taxonomies', 0);

// create two taxonomies, genres and writers for the post type "book"
function create_book_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Genres', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Genre', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Genres', 'textdomain'),
        'all_items' => __('All Genres', 'textdomain'),
        'parent_item' => __('Parent Genre', 'textdomain'),
        'parent_item_colon' => __('Parent Genre:', 'textdomain'),
        'edit_item' => __('Edit Genre', 'textdomain'),
        'update_item' => __('Update Genre', 'textdomain'),
        'add_new_item' => __('Add New Genre', 'textdomain'),
        'new_item_name' => __('New Genre Name', 'textdomain'),
        'menu_name' => __('Genre', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );

    register_taxonomy('genre', array('book'), $args);

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name' => _x('Writers', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Writer', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Writers', 'textdomain'),
        'popular_items' => __('Popular Writers', 'textdomain'),
        'all_items' => __('All Writers', 'textdomain'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Writer', 'textdomain'),
        'update_item' => __('Update Writer', 'textdomain'),
        'add_new_item' => __('Add New Writer', 'textdomain'),
        'new_item_name' => __('New Writer Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate writers with commas', 'textdomain'),
        'add_or_remove_items' => __('Add or remove writers', 'textdomain'),
        'choose_from_most_used' => __('Choose from the most used writers', 'textdomain'),
        'not_found' => __('No writers found.', 'textdomain'),
        'menu_name' => __('Writers', 'textdomain'),
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'writer'),
    );

    register_taxonomy('writer', 'book', $args);
}
//add_action( 'init', 'create_book_tax' );
//
//function create_book_tax() {
//	register_taxonomy(
//		'genre',
//		'book',
//		array(
//			'label' => __( 'Genre' ),
//			'rewrite' => array( 'slug' => 'genre' ),
//			'hierarchical' => true,
//		)
//	);
//}
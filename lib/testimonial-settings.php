<?php

if ( ! function_exists('testimonial') ) {

// Register Custom Post Type
function testimonial() {

	$labels = array(
		'name'                  => _x( 'testimonials', 'Post Type General Name', 'THEME_DOMAIN' ),
		'singular_name'         => _x( 'Testimonials', 'Post Type Singular Name', 'THEME_DOMAIN' ),
		'menu_name'             => __( 'Testimonial', 'THEME_DOMAIN' ),
		'name_admin_bar'        => __( 'Testimonial', 'THEME_DOMAIN' ),
		'archives'              => __( 'Item Testimonial', 'THEME_DOMAIN' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'THEME_DOMAIN' ),
		'all_items'             => __( 'All Testimonials', 'THEME_DOMAIN' ),
		'add_new_item'          => __( 'Add New Testimonial', 'THEME_DOMAIN' ),
		'add_new'               => __( 'Add New', 'THEME_DOMAIN' ),
		'new_item'              => __( 'New Testimonial', 'THEME_DOMAIN' ),
		'edit_item'             => __( 'Edit Testimonial', 'THEME_DOMAIN' ),
		'update_item'           => __( 'Update Testimonial', 'THEME_DOMAIN' ),
		'view_item'             => __( 'View Testimonial', 'THEME_DOMAIN' ),
		'search_items'          => __( 'Search Testimonial', 'THEME_DOMAIN' ),
		'not_found'             => __( 'Testimonial Not found', 'THEME_DOMAIN' ),
		'not_found_in_trash'    => __( 'Testimonial Not found in Trash', 'THEME_DOMAIN' ),
		'featured_image'        => __( 'Avatar', 'THEME_DOMAIN' ),
		'set_featured_image'    => __( 'Set featured Avatar', 'THEME_DOMAIN' ),
		'remove_featured_image' => __( 'Remove featured avatar', 'THEME_DOMAIN' ),
		'use_featured_image'    => __( 'Use as featured avatar', 'THEME_DOMAIN' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'THEME_DOMAIN' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'THEME_DOMAIN' ),
		'items_list'            => __( 'Testimonial Items list', 'THEME_DOMAIN' ),
		'items_list_navigation' => __( 'Items list navigation', 'THEME_DOMAIN' ),
		'filter_items_list'     => __( 'Filter items list', 'THEME_DOMAIN' ),
	);
	$args = array(
		'label'                 => __( 'Testimonials', 'THEME_DOMAIN' ),
		'description'           => __( 'Records testimonials', 'THEME_DOMAIN' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'testimonial', 0 );

}

 ?>

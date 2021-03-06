<?php 
//Post type slider

if ( ! function_exists('Slider') ) {

// Register Custom Post Type
function Slider() {

	$labels = array(
		'name'                  => _x( 'Sliders', 'Post Type General Name', THEME_DOMAIN ),
		'singular_name'         => _x( 'Slider', 'Post Type Singular Name', THEME_DOMAIN ),
		'menu_name'             => __( 'Slider', THEME_DOMAIN ),
		'name_admin_bar'        => __( 'Slider', THEME_DOMAIN ),
		'archives'              => __( 'Slider Archives', THEME_DOMAIN ),
		'parent_item_colon'     => __( 'Parent Slider:', THEME_DOMAIN ),
		'all_items'             => __( 'All Sliders', THEME_DOMAIN ),
		'add_new_item'          => __( 'Add New Slider', THEME_DOMAIN ),
		'add_new'               => __( 'Add New Slider', THEME_DOMAIN ),
		'new_item'              => __( 'New Slider', THEME_DOMAIN ),
		'edit_item'             => __( 'Edit Slider', THEME_DOMAIN ),
		'update_item'           => __( 'Update Slider', THEME_DOMAIN ),
		'view_item'             => __( 'View Slider', THEME_DOMAIN ),
		'search_items'          => __( 'Search Slider', THEME_DOMAIN ),
		'not_found'             => __( 'Slider Not found', THEME_DOMAIN ),
		'not_found_in_trash'    => __( 'Not found in Trash', THEME_DOMAIN ),
		'featured_image'        => __( 'Featured Image', THEME_DOMAIN ),
		'set_featured_image'    => __( 'Set featured image', THEME_DOMAIN ),
		'remove_featured_image' => __( 'Remove featured image', THEME_DOMAIN ),
		'use_featured_image'    => __( 'Use as featured image', THEME_DOMAIN ),
		'insert_into_item'      => __( 'Insert into slider', THEME_DOMAIN ),
		'uploaded_to_this_item' => __( 'Uploaded to this slider', THEME_DOMAIN ),
		'items_list'            => __( 'Items slider list', THEME_DOMAIN ),
		'items_list_navigation' => __( 'Items slider navigation', THEME_DOMAIN ),
		'filter_items_list'     => __( 'Filter items list', THEME_DOMAIN ),
	);
	$args = array(
		'label'                 => __( 'Slider', THEME_DOMAIN ),
		'description'           => __( 'Slider description here', THEME_DOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'Slider', $args );

}
add_action( 'init', 'Slider', 0 );

}

// Add to admin_init function
function add_new_slider_columns($columns) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title'),
        'featured_image' => __('Featured Image'),
        'content' => __('Content'),
    );
}
add_filter('manage_slider_posts_columns' , 'add_new_slider_columns');

// SHOW THE FEATURED IMAGE
function xx_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = xx_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    } 

    if ($column_name == 'content') {
        $post_featured_content= xx_get_featured_content($post_ID);
        if ($post_featured_content) {
            echo $post_featured_content;
        }
    }
}

add_action('manage_slider_posts_custom_column', 'xx_columns_content', 10, 2);




?>


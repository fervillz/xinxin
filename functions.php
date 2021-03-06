<?php
/**
 * xinxin functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xinxin
 */

define( 'THEME_DOMAIN', 'xinxin' );

if ( ! function_exists( 'xinxin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function xinxin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on xinxin, use a find and replace
	 * to change THEME_DOMAIN to the name of your theme in all the template files.
	 */
	load_theme_textdomain( THEME_DOMAIN, get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('featured_preview', 55, 55, true);
	add_image_size( 'slider-image', 1880, 917, true );
	add_image_size( 'project-image', 289, 404, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', THEME_DOMAIN ),
		'secondary' => esc_html__( 'Secondary', THEME_DOMAIN ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'xinxin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'xinxin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xinxin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'xinxin_content_width', 640 );
}
add_action( 'after_setup_theme', 'xinxin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xinxin_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', THEME_DOMAIN ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'xinxin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function xinxin_scripts() {
	wp_enqueue_style( 'xinxin-style', get_stylesheet_uri() );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'google_fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic|Roboto+Slab:400,700', false );
	wp_enqueue_script( 'xx_scripts', get_template_directory_uri() . '/scripts/owl.carousel.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'owl', get_template_directory_uri() . '/scripts/scripts.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'xinxin-skip-link-focus-fix', get_template_directory_uri() . '/scripts/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'xinxin_scripts' );


/**
 * Binds JS handlers to make Theme Customizer controls reload changes asynchronously.
 */
function xinxin_customize_control_js() {
	wp_enqueue_style( 'customizer', get_template_directory_uri().'/customizer.css' );
	wp_enqueue_script( 'xinxin_customizer_controls', get_template_directory_uri() . '/scripts/active-callback.js', array( 'customize-controls' ), false, true );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/font-awesome/css/font-awesome.min.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'xinxin_customize_control_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xinxin_customize_preview_js() {

    wp_enqueue_script( 'xinxin_customizer', get_template_directory_uri() . '/scripts/customizer.js', array( 'customize-preview' ), false, true );

}
add_action( 'customize_preview_init', 'xinxin_customize_preview_js' );

/**
 * Get the first image in post
 */
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];

	if(empty($first_img)) {
	$first_img = "/path/to/default.png";
	}
	return $first_img;
}

// GET FEATURED IMAGE
function xx_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// GET FEATURED content
function xx_get_featured_content($post_ID) {
    $content_post = get_post($post_ID);
	$content = $content_post->post_content;
	return wp_trim_words( $content, 17 );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom postypes
 */
require get_template_directory() . '/lib/slider-settings.php';

/**
 * Load custom postypes
 */
require get_template_directory() . '/lib/testimonial-settings.php';





/*
	Usage: book_get_meta( 'book_title' )
	Usage: book_get_meta( 'book_author' )
	Usage: book_get_meta( 'book_description' )




add_filter( 'woocommerce_checkout_fields' , 'woo_remove_billing_checkout_fields' );

function woo_remove_billing_checkout_fields( $fields ) {

    	unset($fields['billing']['billing_first_name']);
unset($fields['billing']['billing_last_name']);
unset($fields['billing']['billing_company']);
unset($fields['billing']['billing_address_1']);
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_city']);
unset($fields['billing']['billing_postcode']);
unset($fields['billing']['billing_country']);
unset($fields['billing']['billing_state']);
unset($fields['billing']['billing_email']);
unset($fields['billing']['billing_phone']);
unset($fields['shipping']['shipping_first_name']);
unset($fields['shipping']['shipping_last_name']);
unset($fields['shipping']['shipping_company']);
unset($fields['shipping']['shipping_address_1']);
unset($fields['shipping']['shipping_address_2']);
unset($fields['shipping']['shipping_city']);
unset($fields['shipping']['shipping_postcode']);
unset($fields['shipping']['shipping_country']);
unset($fields['shipping']['shipping_state']);
unset($fields['account']['account_username']);
unset($fields['account']['account_password']);
unset($fields['account']['account_password-2']);
unset($fields['order']['order_comments']);

     return $fields;
}


function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );

*/

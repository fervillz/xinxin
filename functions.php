<?php
/**
 * xinxin functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xinxin
 */

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
	 * to change 'xinxin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'xinxin', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'xinxin' ),
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
		'name'          => esc_html__( 'Sidebar', 'xinxin' ),
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

	wp_enqueue_style( 'sosimple-fonts', xinxin_fonts_url(), array(), null );

	wp_enqueue_script( 'xinxin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'xinxin-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xinxin_scripts' );


/**
 * Binds JS handlers to make Theme Customizer controls reload changes asynchronously.
 */
function xinxin_customize_control_js() {
	wp_enqueue_script( 'xinxin_customizer_controls', get_template_directory_uri() . '/js/active-callback.js', array( 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'xinxin_customize_control_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xinxin_customize_preview_js() {
    wp_enqueue_script( 'xinxin_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'xinxin_customize_preview_js' );

/**
 * Register Google Fonts
 */
function xinxin_fonts_url() {
    $fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Roboto Slab, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$robotoslab = _x( 'on', 'Roboto Slab font: on or off', 'xinxin' );

	if ( 'off' !== $robotoslab  ) {

		$font_families = array();
		$font_families[] = 'Roboto+Slab:400,700';

		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;

}
/**
 * Enqueue Google Fonts for custom headers
 */
function xinxin_admin_styles() {

	wp_enqueue_style( 'xinxin-fonts', xinxin_fonts_url(), array(), null );

}
add_action( 'admin_print_styles-appearance_page_custom-header', 'xinxin_admin_styles' );

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
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function book_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function book_add_meta_box() {
	add_meta_box(
		'book-book',
		__( 'book', 'book' ),
		'book_html',
		'post',
		'normal',
		'default'
	);
	add_meta_box(
		'book-book',
		__( 'book', 'book' ),
		'book_html',
		'page',
		'normal',
		'default'
	);
	add_meta_box(
		'book-book',
		__( 'book', 'book' ),
		'book_html',
		'dashboard',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'book_add_meta_box' );

function book_html( $post) {
	wp_nonce_field( '_book_nonce', 'book_nonce' ); ?>

	<p>books only</p>

	<p>
		<label for="book_title"><?php _e( 'title', 'book' ); ?></label><br>
		<input type="text" name="book_title" id="book_title" value="<?php echo book_get_meta( 'book_title' ); ?>">
	</p>	<p>
		<label for="book_author"><?php _e( 'author', 'book' ); ?></label><br>
		<input type="text" name="book_author" id="book_author" value="<?php echo book_get_meta( 'book_author' ); ?>">
	</p>	<p>
		<label for="book_description"><?php _e( 'description', 'book' ); ?></label><br>
		<textarea name="book_description" id="book_description" ><?php echo book_get_meta( 'book_description' ); ?></textarea>
	
	</p><?php
}

function book_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['book_nonce'] ) || ! wp_verify_nonce( $_POST['book_nonce'], '_book_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['book_title'] ) )
		update_post_meta( $post_id, 'book_title', esc_attr( $_POST['book_title'] ) );
	if ( isset( $_POST['book_author'] ) )
		update_post_meta( $post_id, 'book_author', esc_attr( $_POST['book_author'] ) );
	if ( isset( $_POST['book_description'] ) )
		update_post_meta( $post_id, 'book_description', esc_attr( $_POST['book_description'] ) );
}
add_action( 'save_post', 'book_save' );

/*
	Usage: book_get_meta( 'book_title' )
	Usage: book_get_meta( 'book_author' )
	Usage: book_get_meta( 'book_description' )
*/


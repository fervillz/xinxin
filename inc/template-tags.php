<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xinxin
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'xinxin' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'xinxin' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'xinxin' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'xinxin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function xinxin_posted_on() {

	//Check for author-icon value
	if ( get_theme_mod( 'xx_author_icon' ) ) {
		$icon_author = get_theme_mod( 'xx_author_icon','fa-user' );
	}
	else {
		$icon_author = 'fa-user';
	}

	//Check for date-icon value
	if ( get_theme_mod( 'xx_date_icon' ) ) {
		$icon_date = get_theme_mod( 'xx_date_icon','fa-calendar' );
	}
	else {
		$icon_date = 'fa-calendar';
	}

	$byline = sprintf( '<i class="fa '.$icon_author.'"></i> %s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> '. $byline . '</span><span class="posted-on"> <i class="fa '.$icon_date.'""></i><span>' . get_the_time('d/m/Y') . '</span></span>' ; // WPCS: Xxx OK.

}
endif;

if ( ! function_exists( 'xinxin_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function xinxin_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'xinxin' ) );
		if ( $categories_list && xinxin_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'xinxin' ) . '</span>', $categories_list ); // WPCS: Xxx OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'xinxin' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'xinxin' ) . '</span>', $tags_list ); // WPCS: Xxx OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'xinxin' ), esc_html__( '1 Comment', 'xinxin' ), esc_html__( '% Comments', 'xinxin' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'xinxin' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function xinxin_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'xinxin_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'xinxin_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so xinxin_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so xinxin_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in xinxin_categorized_blog.
 */
function xinxin_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'xinxin_categories' );
}
add_action( 'edit_category', 'xinxin_category_transient_flusher' );
add_action( 'save_post',     'xinxin_category_transient_flusher' );

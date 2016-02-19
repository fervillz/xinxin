<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package xinxin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php xinxin_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="<?php if (is_home()) echo "home"; ?> entry-thumbnail">

	<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'xinxin-featured' ); ?>
	<?php else : ?>
		<img src="<?php echo catch_that_image(); ?>" alt="">
	<?php endif; ?>

	</div><!-- .entry-thumbnail -->

	<div class="entry-content">
	
	<?php 

	$xx_more_text = esc_attr(get_theme_mod( 'xx_more_text' ));
	if ( ! $xx_more_text ){
		$xx_more_text =  'Read More &raquo;';
	}

	$xx_more_position = esc_attr(get_theme_mod( 'xx_more_position' ));
	if ( ! $xx_more_position ){
		$xx_more_position =  'left';
	}

	if ( esc_attr((get_theme_mod('xx_excerpt_type' ) == 'option2') || get_theme_mod( 'xx_excerpt_type' ) == NULL))  {
		the_excerpt();
	}
	else{
		
		if ( esc_attr(get_theme_mod( 'xx_more_type' ) == 'option1') || (get_theme_mod( 'xx_more_type' ) == NULL) ) {
			the_content('',FALSE,'');
		}
		elseif( esc_attr(get_theme_mod( 'xx_more_type' ) == 'option2' )){
			the_content( $xx_more_text );
		}
		elseif( esc_attr(get_theme_mod( 'xx_more_type' ) == 'option3' )){
			
			if ( esc_attr(get_theme_mod( 'xx_more_button' ) == 'option1' )) {
				the_content("<span class='xx_button xx_fill xx_squared'"."style='margin-top: 30px; padding:4px 8px; background-color:".esc_attr(get_theme_mod( 'xx_button_bg' ))."; "."color:".esc_attr(get_theme_mod( 'xx_text_color' ))."; "."float:".$xx_more_position.";'>".$xx_more_text."</div>");
			}
			else{
				the_content("<span class='xx_button xx_fill xx_rounded'"."style='margin-top: 30px; padding:4px 8px; background-color:".esc_attr(get_theme_mod( 'xx_button_bg' ))."; "."color:".esc_attr(get_theme_mod( 'xx_text_color' ))."; "."float:".$xx_more_position.";'>".$xx_more_text."</div>");
			}
			
		}
	}
	?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php xinxin_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

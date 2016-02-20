<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xinxin
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<div id="page" class="site-content <?php if ( get_theme_mod( 'xx_guide', 1 )) { echo "help-on";} ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', THEME_DOMAIN ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-support">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="support">
							<span class="email">
								<i class="fa fa-envelope"></i>
								<span class="email-text">info@website.com</span>
							</span>
							<span class="phone">
								<i class="fa fa-phone"></i>
								<span class="email-text">+639 000 0000 000</span>
							</span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 pull-right">
						<div class="social">
							<ul class="links">
								<li class="social-items"><a href="#" id=""><i class="fa fa-facebook"></i></a></li>
								<li class="social-items"><a href="#" id=""><i class="fa fa-twitter"></i></a></li>
								<li class="social-items"><a href="#" id=""><i class="fa fa-linkedin"></i></a></li>
								<li class="social-items"><a href="#" id=""><i class="fa fa-google-plus"></i></a></li>
								<li class="social-items"><a href="#" id=""><i class="fa fa-dribbble"></i></a></li>
								<li class="social-items search-item"><a href="#" id=""><i class="fa fa-search"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .secondary-navigation -->

		<div class="header-primary">
			<div class="container">
				<div class="row">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<div class="site-branding">
							<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>

							<?php if ( get_theme_mod( THEME_DOMAIN.'_logo' ) ) : ?>

						    <div class='site-logo'>
						        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( THEME_DOMAIN.'_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
						    </div>
							<?php else : ?>
							    <hgroup>
							        <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
							        <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
							    </hgroup>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>

					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div><!-- .header-primary -->
	</header><!-- #masthead -->

	<?php if (is_home()): ?>
		<div class="header-img">
			<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			<?php endif; // End header image check. ?>
		</div><!-- >header-img -->
	<?php endif; ?>

	<?php if (is_home()): ?>
		<div class="xx_slider big offset-top-x">
			<?php get_template_part( 'lib/frontend/slider', ''); ?>
		</div><!-- >header-img -->

		<div class="quick-search">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div><!-- .quick-search -->
	<?php endif; ?>

	<div id="content" class="site-content">


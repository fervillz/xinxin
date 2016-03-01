<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xinxin
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-widgets">
		<div class="container">
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					widgets here
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					widgets here
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					widgets here
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					widgets here
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .footer-widgets -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7">
					<div class="footer-bottom-left-1">
						<span class="footer-bottom-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="" /> </span>
						<span class="footer-bottom-menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> </span>
					</div><!-- .footer-bottom-menu -->
					<div class="footer-bottom-left-2">
						<span class="copyright">
							&copy 2016 Xinxin. All rights reserved. No part of this site may be reproduced without our written permission
						</span>
					</div><!-- .footer-bottom-menu -->
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5">
					<div class="footer-bottom-right-1">
						<span class="social">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>
							<a href=""><i class="fa fa-linkedin"></i></a>
							<a href=""><i class="fa fa-google-plus"></i></a>
							<a href=""><i class="fa fa-dribbble"></i></a>
						</span>
					</div><!-- .footer-bottom-right -->
					<div class="footer-bottom-right-2">
						<span class="contacts"><i class="fa fa-phone"></i>+6393-59563-636 </span>
						<span class="contacts"><i class="fa fa-fax"></i>+6393-59563-636 </span>
					</div><!-- .footer-bottom-right-2 -->
				</div>
			</div><!-- .footer-bottom -->
		</div><!-- .row -->
	</div><!-- .container -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

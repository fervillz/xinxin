<?php
/*
template name: Homepage Full Width
*/

get_header(); ?>

<section class="xx_slider big offset-top-x">
	<?php get_template_part( 'lib/frontend/slider', ''); ?>
</section><!-- >header-img -->

<section class="quick-search">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section><!-- .quick-search -->

<div class="xx_testimonials">
	<?php get_template_part( 'lib/frontend/testimonial', ''); ?>
</div><!-- /.xx_testimonials -->

<?php get_footer(); ?>

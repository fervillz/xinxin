<?php

// WP_Query arguments
$args = array (
	'post_type'              => array( 'testimonial' ),
	'post_status'            => array( 'publish' ),
	'order'                  => 'DESC',
	'orderby'                => 'id',
);

// The Query
$query = new WP_Query( $args );
?>
<div class="owl-carousel">

<?php if ( $query->have_posts() ): ?>

	<?php while ( $query->have_posts() ) :?>
		<div class="item">
			<?php $query->the_post(); ?>

			<div class="testimonial-big text-inside">
				<div class="testimonial-thumbnail black-overlay">
					<?php if (has_post_thumbnail())
						the_post_thumbnail('testimonial-image');

						else {
							echo "<img src='". get_template_directory_uri(). "/images/demo-testimonial1.jpg' alt='xinxin demo image testimonial'>";
						}
					?>
				</div>
				<div class="testimonial-content">
					<div class="container">
						<div class="testimonial-title">
							<?php the_title('<h2>','</h2>'); ?>
						</div>
						<div class="testimonial-desc">
							<?php the_content( ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>

<?php else : ?>
	<?php echo "no post found"; ?>
<?php endif; ?>

<?php
// Restore original Post Data
wp_reset_postdata();

 ?>


</div>

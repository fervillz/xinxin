<?php 

// WP_Query arguments
$args = array (
	'post_type'              => array( 'slider' ),
	'post_status'            => array( 'publish' ),
	'order'                  => 'ASC',
	'orderby'                => 'id',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		the_title( );
		the_post_thumbnail();
		the_content( );
	}
} else {
	echo "no post found";
}

// Restore original Post Data
wp_reset_postdata();

 ?>
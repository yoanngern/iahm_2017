<?php get_header( 'event' ); ?>

<?php

$post = get_post();

$is_mg = false;

$categories = get_the_terms( $post->ID, 'iahm_eventcategory' );

foreach ( $categories as $category ) :

	$parent_cat = $category;

	while ( $parent_cat != null ) {

		$current_cat = get_term( $parent_cat, 'iahm_eventcategory' );

		if ( $current_cat->slug == 'mg' ) {

			$is_mg = true;

			break;
		}

		$parent_cat = $current_cat->parent;

	}

endforeach; ?>

<?php

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		if ( $is_mg ) {
			get_template_part( 'template-parts/event/event-mg', 'single-iahm_event' );
		} else {
			get_template_part( 'template-parts/event/event', 'single-iahm_event' );
		}

	endwhile; ?>

	<?php

else :

	get_template_part( 'template-parts/event/none' );

endif;
?>

<?php get_footer(); ?>
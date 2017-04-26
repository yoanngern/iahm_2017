<?php get_header( 'subnav' ); ?>


<section id="bigimage">

	<?php


	if ( is_tax( 'iahm_eventcategory' ) ):

		$banner_image = get_field_or_parent( 'banner_image', get_queried_object()->term_id, 'iahm_eventcategory', 'term' );
		$title_image  = get_field_or_parent( 'title_image', get_queried_object()->term_id, 'iahm_eventcategory', 'term' );

	elseif ( $post->post_type == "iahm_event" ):


		$default_cat = get_term_by( 'slug', 'other', 'iahm_eventcategory' );

		$banner_image = get_field( 'banner_image', $default_cat );
		$title_image  = get_field( 'title_image', $default_cat );

	else:

		$banner_image = get_field_or_parent( 'banner_image', get_the_ID(), 'iahm_eventcategory' );
		$title_image  = get_field_or_parent( 'title_image', get_the_ID(), 'iahm_eventcategory' );


	endif;


	?>

    <div class="banner"
         style="background-image: url('<?php echo $banner_image['sizes']['banner_image']; ?>')">
    </div>

    <div class="header_title"
         style="background-image: url('<?php echo $title_image['sizes']['title_image']; ?>')"></div>


</section>
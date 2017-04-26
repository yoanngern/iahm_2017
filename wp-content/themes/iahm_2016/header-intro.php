<?php get_header( 'subnav' ); ?>


<section id="bigimage">


	<?php

	$banner = get_field( 'banner' );

	$frontpage_id = get_option( 'page_on_front' );

	$i = 0;

	while ( empty( $banner ) ) {

		$id = get_ancestors( get_the_ID(), 'page' )[0];

		$banner = get_field( 'banner', $id );

		if ( $id == 0 ) {

			$id     = $frontpage_id;
			$banner = get_field( 'banner', $id );

			break;
		}

		$i ++;
		if ( $i == 5 ) {
			break;
		}
	}

	if ( ! empty( $banner ) ): ?>

		<div class="banner"
		     style="background-image: url('<?php echo $banner['sizes']['banner_image']; ?>')"></div>
	<?php endif;

	$title = get_field( 'title' );

	$i = 0;

	while ( empty( $title ) ) {

		$id = get_ancestors( get_the_ID(), 'page' )[0];

		$title = get_field( 'title', $id );

		if ( $id == 0 ) {

			$id    = $frontpage_id;
			$title = get_field( 'title', $id );

			break;
		}

		$i ++;
		if ( $i == 5 ) {
			break;
		}
	}

	if ( ! empty( $title ) ): ?>

		<a href="<?php echo get_permalink(); ?>" class="header_title"
		   style="background-image: url('<?php echo $title['sizes']['title_image']; ?>')"></a>
	<?php endif; ?>

</section>
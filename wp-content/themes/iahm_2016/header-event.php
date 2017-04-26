<?php get_header( 'subnav' ); ?>


<section id="bigimage">

	<?php



	$banner_image = get_field_or_parent( 'banner_image', get_the_ID(), 'iahm_eventcategory' );
	$title_image  = get_field_or_parent( 'title_image', get_the_ID(), 'iahm_eventcategory' );
	$banner_video = get_field( 'banner_video' );

	?>

    <div class="banner"
         style="background-image: url('<?php echo $banner_image['sizes']['banner_image']; ?>')">
		<?php if ( $banner_video ): ?>
            <div class="video-bg">
                <video id="bgvid" autoplay loop>
                    <source src="<?php echo $banner_video; ?>" type="video/mp4">
                </video>
            </div>
		<?php endif; ?>
    </div>

    <div class="header_title"
         style="background-image: url('<?php echo $title_image['sizes']['title_image']; ?>')"></div>


</section>
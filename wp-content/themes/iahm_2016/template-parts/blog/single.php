<?php get_header( 'subnav' ); ?>

<?php if ( have_posts() ) : the_post() ?>

	<?php

	$id = get_the_ID();

	$title = get_the_title( $id );
	$date  = complex_date( $post->post_date, $post->post_date );
	$type  = get_field( 'type', $id );
	$author = get_field('author', $id);

	if ( ! $type ) {
		$type = "article";
	}

	?>

	<?php if ( $type == 'article' ): ?>

        <section id="bigimage">

			<?php

			$thumb = get_field_or_parent( 'thumb', $id, 'category' );

			?>

            <div class="banner"
                 style="background-image: url('<?php echo $thumb['sizes']['banner_image']; ?>')">
            </div>

        </section>

	<?php else: ?>

        <section id="video_header">

			<?php

			$video = get_iframe_video( get_field( 'video', $id ) );


			?>

            <div class="content">

                <article class="video">

					<?php echo $video; ?>

                </article>

            </div>

        </section>

	<?php endif; ?>


    <section id="content" class="blog <?php echo $type; ?>">

        <div class="platter">


            <article class="content-page">
                <h1><?php echo $title; ?></h1>



				<?php the_content(); ?>
	            <?php
	            set_query_var( 'person_id', $author->ID );
	            get_template_part( 'template-parts/people/people_details' );
	            ?>

            </article>

        </div>

    </section>
<?php else :

	get_template_part( 'template-parts/blog/none' );

endif; ?>

<?php get_footer(); ?>
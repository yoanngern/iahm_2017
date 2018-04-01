<?php /* Template Name: Page home */ ?>

<?php get_header(); ?>


<main class="main" data-template="home">
	<?php if ( get_field( 'slider' ) ):

		$slider = get_field( 'slider' );

		$nb_slides = 0;

		?>

		<?php foreach ( $slider as $slide ):

		if ( $slide['show'] ):

			$nb_slides ++;

			?>


		<?php endif; ?>
	<?php endforeach; ?>

        <section id="header_home">
            <div id="slides" class="slidesjs" data-size="<?php echo $nb_slides; ?>" data-nav="true"
                 data-pag="true" data-height="828">
				<?php foreach ( $slider as $slide ):

					if ( $slide['show'] ):

						if ( $slide['black'] ) {
							$color = 'black';
						} else {
							$color = 'white';
						}

						?>

                        <div style="background-image: url('<?php echo $slide['bg']['sizes']['home']; ?>')">

                            <a class="image" href="<?php echo $slide['link']; ?>"
                               style="background-image: url('<?php echo $slide['image']['sizes']['home_title']; ?>')"></a>
                            <h1 class="<?php echo $color; ?>"><?php echo $slide['title']; ?></h1>

                        </div>
					<?php endif; ?>
				<?php endforeach; ?>
            </div>
        </section>

	<?php endif; ?>

	<?php if ( have_rows( 'ads' ) ): ?>

        <section id="pub">

            <ul>

				<?php while ( have_rows( 'ads' ) ): the_row();

					$title      = get_sub_field( 'title' );
					$url        = get_sub_field( 'page' );
					$bg         = get_sub_field( 'bg' );
					$col_top    = get_sub_field( 'color_top' );
					$col_bottom = get_sub_field( 'color_bottom' );

					if ( ! $col_top && ! $col_bottom ) {
						$col_top    = "#B5191D";
						$col_bottom = "#A3191C";
					}


					?>

					<?php if ( $bg ): ?>
                        <li>
                            <a href="<?php echo $url; ?>"
                               style="background-image: url('<?php echo $bg['sizes']['ad']; ?>')">

                                <div class="dark"></div>
                                <h1><?php echo $title; ?></h1>
                            </a>
                        </li>
					<?php else: ?>

                        <li style="background: <?php echo $col_bottom; ?>;
                                background: -webkit-gradient(linear, left bottom, left top, color-stop(0, <?php echo $col_bottom; ?>), color-stop(1, <?php echo $col_top; ?>));
                                background: -ms-linear-gradient(bottom, <?php echo $col_bottom; ?>, <?php echo $col_top; ?>);
                                background: -moz-linear-gradient(center bottom, <?php echo $col_bottom; ?> 0%, <?php echo $col_top; ?> 100%);
                                background: -o-linear-gradient(<?php echo $col_top; ?>, <?php echo $col_bottom; ?>);
                                filter: progid:DXImageTransform.Microsoft.gradient(enabled='false', startColorstr=<?php echo $col_bottom; ?>, endColorstr=<?php echo $col_top; ?>);">

                            <a href="<?php echo $url; ?>">
                                <h1><?php echo $title; ?></h1>
                            </a>
                        </li>
					<?php endif; ?>

				<?php endwhile; ?>

            </ul>

        </section>

	<?php endif; ?>



	<?php get_footer(); ?>


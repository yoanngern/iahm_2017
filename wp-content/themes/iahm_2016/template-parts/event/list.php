<?php get_header( 'events' ); ?>


<section id="content" class="events">

    <div class="platter">


        <header>


			<?php if ( is_home() && ! is_front_page() ) : ?>


                <div id="categories" data-tax="event-category" data-url="<?php echo pll_home_url(); ?>"
                     data-path="events">
					<?php
					wp_dropdown_categories( array(
						'show_option_all' => 'Filter events',
						'value_field'     => 'slug',
						'hierarchical'    => 1,
						'taxonomy'        => 'iahm_eventcategory',
						'selected'        => get_queried_object()->slug
					) ); ?>
                </div>

			<?php else : ?>

                <div id="categories" data-tax="event-category" data-url="<?php echo pll_home_url(); ?>"
                     data-path="events">
					<?php
					wp_dropdown_categories( array(
						'show_option_all' => pll__( 'Filter events' ),
						'value_field'     => 'slug',
						'hierarchical'    => 1,
						'taxonomy'        => 'iahm_eventcategory',
						'selected'        => get_queried_object()->slug
					) ); ?>
                </div>

			<?php endif; ?>

            <h1><?php pll_e( 'Upcoming Events' ); ?></h1>

        </header>


		<?php


		if ( have_posts() ) : ?>


            <section id="listOfEvents" class="small" data-nb="3">
                <article class="content-page">


					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/event/item' );

					endwhile; ?>

                </article>
            </section>


            <nav class="nav_bottom">
                <div class="nav-previous alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
                <div class="nav-next alignright"><?php next_posts_link( 'Next' ); ?></div>
            </nav>

			<?php

		else :

			get_template_part( 'template-parts/blog/none' );

		endif;
		?>
    </div>

</section>

<?php get_footer(); ?>




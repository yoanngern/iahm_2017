<section id="content">

    <div class="platter">
        <article class="content-page iahm_event default">

            <div class="nav">
                <a href="<?php echo get_post_type_archive_link( 'iahm_event' ); ?>"
                   class="back"><?php pll_e( 'Back' ) ?></a>

            </div>

            <div class="top">

                <section class="left">

                    <div class="content">
                        <h1><?php echo get_field( 'title' ); ?></h1>
                        <h2><?php echo get_field( 'subtitle' ); ?></h2>
                    </div>

                </section>

                <section class="right">

                    <div class="content">


						<?php if ( get_field( 'button' ) && get_field( 'button_link' ) ):


							if ( get_field( 'button_text' ) ) {
								$button_text = get_field( 'button_text' );
							} else {
								$button_text = get_field( 'button_link' );
							}

							$button_link = get_field( 'button_link' );

							?>

                            <a target="_blank" href="<?php echo $button_link; ?>"
                               class="button"><?php echo $button_text; ?></a>


						<?php endif; ?>

                        <time><?php echo complex_date( get_field( 'start_date' ), get_field( 'end_date' ) ); ?></time>

                    </div>

                </section>
            </div>

            <div class="middle">
                <section class="left">

                    <div class="content">

						<?php //the_content(); ?>

						<?php echo get_field( 'description' ); ?>


                    </div>

                </section>

                <section class="right">

                    <div class="content">

						<?php if ( get_field( 'pricing' ) ): ?>

                            <h4><?php pll_e( 'Pricing' ); ?></h4>

							<?php
							echo get_field( 'pricing' );

						endif; ?>

						<?php if ( get_field( 'location' ) ):

							$location = get_field( 'location' );

							?>

                            <h4><?php pll_e( 'Address' ); ?></h4>

                            <p><?php echo get_field( 'name', $location->ID ) ?><br/>
								<?php echo get_field( 'address', $location->ID ) ?><br/>
								<?php echo get_field( 'zipcode', $location->ID ) ?> <?php echo get_field( 'city', $location->ID ) ?>
                                <br/>
								<?php echo get_field( 'country', $location->ID ) ?></p>

						<?php endif; ?>

						<?php echo get_field( 'infos_details' ); ?>

                    </div>

                </section>

            </div>


        </article>
    </div>
</section>


<?php

if ( get_field( 'speakers' ) || get_field( 'worship_leaders' ) ):?>


    <section id="guest">
        <div class="platter">
            <article class="content">


				<?php

				if ( get_field( 'speakers' ) ):?>
                    <div class="speakers">

                        <h1><?php pll_e( 'Speakers' ); ?></h1>

						<?php foreach ( get_field( 'speakers' ) as $speaker ) :

							set_query_var( 'person_id', $speaker->ID );
							get_template_part( 'template-parts/people/people_simple' );

						endforeach; ?>
                    </div>

				<?php endif; ?>

				<?php

				if ( get_field( 'worship_leaders' ) ):?>

                    <div class="worship_leaders">


                        <h1><?php pll_e( 'Worship' ); ?></h1>

						<?php foreach ( get_field( 'worship_leaders' ) as $worship_leader ) :

							set_query_var( 'person_id', $worship_leader->ID );
							get_template_part( 'template-parts/people/people_simple' );


						endforeach; ?>
                    </div>

				<?php endif; ?>
            </article>
        </div>
    </section>


<?php endif; ?>



<?php if ( have_rows( 'schedule' ) ): ?>
    <section id="schedule">

        <div class="platter">

            <article class="content">

                <h1><?php pll_e( 'Schedule' ); ?></h1>

				<?php while ( have_rows( 'schedule' ) ): the_row();

					$date = new DateTime( get_sub_field( 'date' ) );

					?>

                    <section class="day">
                        <div class="title">
                            <div class="bullet"></div>
                            <h2><?php echo date_i18n( 'l j', strtotime( $date->format('d-m-Y') ) ); ?></h2>
                        </div>
                        <div class="line"></div>

						<?php while ( have_rows( 'slot' ) ): the_row();

							$date = new DateTime( '01-01-1970 ' . get_sub_field('time') );

							?>
                            <article class="slot">
                                <div class="bullet"></div>

                                <time><?php echo time_trans($date); ?></time>
                                <div class="desc">
                                    <h3><?php echo get_sub_field( 'title' ); ?></h3>
                                    <span><?php echo get_sub_field( 'subtitle' ); ?></span>
                                </div>
                            </article>
						<?php endwhile; ?>

                    </section>


				<?php endwhile; ?>

            </article>
        </div>

    </section>
<?php endif; ?>


<section id="newsletter">
    <div class="platter">

        <article class="content">

            <h1><?php pll_e( 'Stay up to date on our upcoming events' ); ?></h1>

            <a href="/newsletter" class="button">
                <span><?php pll_e( 'Subscribe' ); ?></span>
            </a>

        </article>
    </div>

</section>
<section id="content">

    <div class="platter">
        <article class="content-page iahm_event event_mg">

            <div class="nav">
                <a href="<?php echo get_post_type_archive_link( 'iahm_event' ); ?>"
                   class="back"><?php pll_e( 'Back' ) ?></a>

            </div>

            <h1><?php pll_e( 'Miracles and Healings night' ); ?></h1>

            <time><?php echo complex_date( get_field( 'start_date' ), get_field( 'end_date' ) ); ?><?php

				if ( get_field( 'time' ) ) {


					$date = new DateTime( '01-01-1970 ' . get_field('time') );

					echo "<span> " . pll__( 'at' ) . " " . time_trans($date) . "</span>";
				}

				?></time>

            <p><?php pll_e( "Our desire is to transmit the Gospel of Jesus Christ in a way that is accessible with a demonstration of God's power through signs, miracles and wonders!" ); ?></p>

			<?php echo get_field( 'description' ); ?>

			<?php

			if ( get_field( 'speakers' ) ):?>

				<?php foreach ( get_field( 'speakers' ) as $speaker ) :

					set_query_var( 'person_id', $speaker->ID );
					get_template_part( 'template-parts/people/people_details' );

				endforeach; ?>
			<?php endif; ?>



			<?php

			if ( get_field( 'location' ) ):

				$location = get_field( 'location' );

				?>

                <div class="location">

                    <h2><?php pll_e( 'Getting to the evening' ); ?></h2>
                    <p><?php pll_e( 'Free entry (free participation in the offering)' ); ?></p>

                    <h4><?php pll_e( 'Address' ); ?></h4>

                    <p><?php echo get_field( 'name', $location->ID ) ?><br/>
						<?php echo get_field( 'address', $location->ID ) ?><br/>
						<?php echo get_field( 'zipcode', $location->ID ) ?> <?php echo get_field( 'city', $location->ID ) ?>
                        <br/>
						<?php echo get_field( 'country', $location->ID ) ?></p>

                </div>

			<?php endif; ?>

			<?php echo get_field( 'infos_details' ); ?>


        </article>
    </div>
</section>
<?php /* Template Name: Page live */ ?>

<?php get_header(); ?>

<?php

if ( get_field( 'facebook_video' ) ):

	?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=1160743764014114";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<?php endif; ?>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/live.min.js"></script>


<main class="main" data-template="live">

    <section id="video_header">

        <div class="content">

            <article class="fb-video"
                     data-href="<?php echo get_field( 'live_video_url' ); ?>/"
                     data-width="1280" data-show-text="false">
            </article>

        </div>

    </section>

    <section id="other_videos">

        <article class="content-page">

            <h1 class="page-title">Les soirées précédentes</h1>

			<?php


			$query = new WP_Query( array(
				'posts_per_page'   => 24,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'suppress_filters' => true,
				'post_status'      => 'publish',
				'meta_query'       => array(
					'relation' => 'AND',
					array(
						'key'     => 'type',
						'compare' => '=',
						'value'   => 'video'
					),
				),
			) );

			$items = $query->get_posts();

			$exclude_posts = array();

			if ( $items != null ) : ?>

                <div class="blog_wall cards">

					<?php foreach ( $items as $item ) :

						set_query_var( 'item', $item );
						//get_template_part( 'template-parts/blog/item_wall' );
						get_template_part( 'template-parts/blog/item' );

						$exclude_posts[] = $item->ID;

					endforeach; ?>

                </div>

			<?php endif; ?>
        </article>

    </section>


	<?php get_footer(); ?>


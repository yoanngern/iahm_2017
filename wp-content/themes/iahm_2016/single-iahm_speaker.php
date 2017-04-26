<?php get_header( 'default' ); ?>


<section id="content">

	<div class="platter">

		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post(); ?>

			<article class="content-page">

				<h1><?php the_title(); ?></h1>


			</article>
			<?php

		endwhile;
		?>

	</div>


</section>


<?php get_footer(); ?>


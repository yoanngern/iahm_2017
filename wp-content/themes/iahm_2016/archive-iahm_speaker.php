<?php get_header(); ?>

<section id="content">

	<div class="platter">

		<h1>test</h1>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_title();
			echo '<div class="entry-content">';
			the_content();
			echo '</div>';
		endwhile; endif;

		?>
	</div>


</section>

<?php get_footer(); ?>

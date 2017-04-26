<?php

$id    = get_the_ID();
$title = get_the_title();
$link  = esc_url( get_permalink() );
$image = get_field_or_parent( 'thumb', get_the_ID(), 'iahm_eventcategory' )['sizes']['card'];
$date  = complex_date( get_field( 'start_date' ), get_field( 'end_date' ) );

?>


<div class="event">
	<a href="<?php echo $link; ?>">
		<div id="<?php echo $id; ?>" class="image" style="background-image: url('<?php echo $image; ?>')"></div>

		<h2><?php echo $title; ?></h2>
		<h3><?php echo $date; ?></h3>
	</a>
</div>
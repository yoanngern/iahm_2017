<?php

$id    = $item->ID;
$title = get_the_title( $item );

$date = $item->post_date;

$link = esc_url( get_permalink( $item ) );

$thumb = get_field( 'thumb', $id );


$author = get_field('author', $id);

$subtitle = get_field('first_name', $author->ID) . " " . get_field('last_name', $author->ID);

$type = get_field( 'type', $id );


?>


<div class="post card <?php echo $type; ?>">
    <a href="<?php echo $link; ?>">
        <div id="<?php echo $id; ?>" class="image"
             style="background-image: url('<?php echo $thumb['sizes']['card']; ?>')">
            <div class="play"></div>
            <div class="dark"></div>
        </div>

        <h2><?php echo $title; ?></h2>
        <h3><?php echo $subtitle; ?></h3>
    </a>
</div>
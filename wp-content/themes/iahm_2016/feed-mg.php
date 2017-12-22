<?php
/**
 * Customs RSS template with related posts.
 *
 * Place this file in your theme's directory.
 *
 * @package sometheme
 * @subpackage theme
 */


/**
 * Feed defaults.
 */
header( 'Content-Type: application/atom+xml; charset=' . get_option( 'blog_charset' ), true );

/**
 * Start RSS feed.
 */
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>'; ?>

<feed xmlns:content="http://purl.org/rss/1.0/modules/content/"
      xmlns:atom="http://www.w3.org/2005/Atom"
      xmlns:media="http://search.yahoo.com/mrss/">
    <id><?php bloginfo_rss( 'url' ) ?></id>
    <title><?php echo date_i18n( 'F', date( "U", strtotime( date( 'm', strtotime( '+1 month' ) ) . '/01/' . date( 'Y' ) . ' 00:00:00' ) )); ?></title>
    <updated><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></updated>
    <link rel="self" href="<?php bloginfo_rss( 'url' ) ?>"/>


	<?php do_action( 'rss2_head' ); ?>

	<?php
	//$post_type = get_post_type( $_POST );


	$query = new WP_Query( array(
		'post_type'        => 'iahm_event',
		'post_status'      => 'publish',
		'posts_per_page'   => 16,
		'include_children' => true,
		'tax_query'        => array(
			array(
				'taxonomy' => 'iahm_eventcategory',
				'field'    => 'slug',
				'terms'    => array( 'mg' )
			)
		)

	) );

	$query->set( 'orderby', 'meta_value' );
	$query->set( 'meta_key', 'start_date' );
	$query->set( 'meta_key', 'end_date' );
	$query->set( 'order', 'asc' );

	$today = date( 'Y-m-d' );

	$first = date( "Ymd", strtotime( date( 'm', strtotime( '+1 month' ) ) . '/01/' . date( 'Y' ) . ' 00:00:00' ) );

	//$created_timestamp = date( "Y-m-t  H:i:s", strtotime( "+1 month" ) );


	$last = date( "Ymd", strtotime( date( "Y-m-d  H:i:s", strtotime( "+1 month" ) ) ) );

	$query->set( 'meta_query', array(
		'relation' => 'AND',
		array(
			'key'     => 'end_date',
			'compare' => '>=',
			'value'   => $first,
		),
		array(
			'key'     => 'start_date',
			'compare' => '<=',
			'value'   => $last,
		)
	) );


	$events = $query->get_posts();


	wp_reset_query();


	?>

    <!-- Start loop -->
	<?php

	while ( $query->have_posts() ) : $query->the_post();

		$date = date_create_from_format( 'Ymd H:i:s', get_field( 'start_date' ) . " " . get_field( 'time' ) );

		$speaker_name = "";

		if ( get_field( 'speakers' ) ) {
			foreach ( get_field( 'speakers' ) as $speaker ) :

				$person = get_post( $speaker );

				$first_name = get_field( 'first_name', $person->ID );
				$last_name  = get_field( 'last_name', $person->ID );
				$country_id = get_field( 'country_id', $person->ID );

				if ( $speaker_name != "" ) {
					$speaker_name .= " | ";
				}

				$speaker_name .= $first_name . " " . $last_name;

				if ( $country_id ) {
					$speaker_name .= " (" . $country_id . ")";
				}

			endforeach;
		}


		?>


        <entry>
            <id><?php the_guid(); ?></id>
            <title type="html"><![CDATA[<?php the_title(); ?>]]></title>
            <author>
                <name><?php echo $speaker_name; ?></name>
            </author>
            <description><?php echo date_i18n( 'j F H:i', $date->getTimestamp() ); ?></description>
            <pubDate><?php echo date_format( $date, 'Y-m-d\TH:i:sP' ); ?></pubDate>
            <link rel="alternate" type="text/html" href="<?php the_permalink_rss(); ?>"/>
            <media:content
                    url="<?php echo get_field_or_parent( 'thumb', get_the_ID(), 'iahm_eventcategory' )['sizes']['mailchimp_list']; ?>"
                    type="image/jpg"/>
            <summary type="html"><![CDATA[<?php echo "<p>test</p>" ?>]]></summary>
            <content type="html"><![CDATA[<?php echo "<p>test</p>" ?>]]></content>
        </entry>

	<?php endwhile; ?>
    <!-- End loop -->

</feed>
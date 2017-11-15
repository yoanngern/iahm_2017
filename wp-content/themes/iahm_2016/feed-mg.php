<?php
/**
 * Customs RSS template with related posts.
 *
 * Place this file in your theme's directory.
 *
 * @package sometheme
 * @subpackage theme
 */


$date = complex_date( get_field( 'start_date' ), get_field( 'end_date' ) );

if ( get_field( 'time' ) ) {


	$date_time = new DateTime( '01-01-1970 ' . get_field( 'time' ) );

	$date .= pll__( 'at' ) . " " . time_trans( $date_time );
}


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
    <title><?php bloginfo_rss( 'name' ); ?></title>
    <updated><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></updated>
    <link rel="self" href="<?php bloginfo_rss( 'url' ) ?>"/>


	<?php do_action( 'rss2_head' ); ?>

	<?php
	//$post_type = get_post_type( $_POST );


	$query = new WP_Query( array(
		'post_type'   => 'iahm_event',
		'post_status' => 'publish'
	) );


	$events = $query->get_posts();

	//var_dump( $events );

	wp_reset_query();


	?>

    <!-- Start loop -->
	<?php foreach ( $events as $event ):

		$post = $event;

		?>


        <entry>
            <id><?php the_guid(); ?></id>
            <title type="html"><![CDATA[<?php the_title(); ?>]]></title>
            <author>
                <name>Claire-Lise Cherpillod</name>
                <name>Jean-Luc Trachsel</name>
            </author>
            <pubDate><?php echo $date; ?></pubDate>
            <link rel="alternate" type="text/html" href="<?php the_permalink_rss(); ?>"/>
            <media:content
                    url="<?php echo get_field_or_parent( 'thumb', get_the_ID(), 'iahm_eventcategory' )['sizes']['card']; ?>"
                    type="image/jpg"/>
            <summary type="html"><![CDATA[<?php echo "<p>test</p>" ?>]]></summary>
            <content type="html"><![CDATA[<?php echo "<p>test</p>" ?>]]></content>
        </entry>

	<?php endforeach; ?>
    <!-- End loop -->

</feed>
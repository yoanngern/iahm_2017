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
header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
$frequency  = 1;        // Default '1'. The frequency of RSS updates within the update period.
$duration   = 'hourly'; // Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
$postlink   = '<br /><a href="' . get_permalink() . '">See the rest of the story at mysite.com</a><br /><br />';
$email      = get_the_author_meta( 'email' );
$author     = get_the_author();
$postimages = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
// Check for post image. If none, fallback to a default.
$postimage = ( $postimages ) ? $postimages[0] : get_stylesheet_directory_uri() . '/images/default.jpg';
/**
 * Start RSS feed.
 */
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>'; ?>

<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php do_action( 'rss2_ns' ); ?>
>

    <!-- RSS feed defaults -->
    <channel>
        <title><?php bloginfo_rss( 'name' ); ?></title>
        <link><?php bloginfo_rss( 'url' ) ?></link>
        <description><?php bloginfo_rss( 'description' ) ?></description>
        <lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
        <language><?php bloginfo_rss( 'language' ); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml"/>

        <!-- Feed Logo (optional) -->
        <image>
            <url>http://mysite.com/somelogo.png</url>
            <title><?php bloginfo_rss( 'name' ) ?></title>
            <link><?php bloginfo_rss( 'url' ) ?></link>
        </image>

		<?php do_action( 'rss2_head' ); ?>

		<?php
		$post_type = get_post_type( $_POST );


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


            <item>
                <title><?php the_title_rss(); ?></title>
                <link><?php the_permalink_rss(); ?></link>
                <guid isPermaLink="false"><?php the_guid(); ?></guid>
                <media:content
                        url="<?php echo get_field_or_parent( 'thumb', get_the_ID(), 'iahm_eventcategory' )['sizes']['card']; ?>"
                        type="image/jpg"/>
                <image>
                    <url><?php echo get_field_or_parent( 'thumb', get_the_ID(), 'iahm_eventcategory' )['sizes']['card']; ?>
                        "/>
                    </url>
                </image>
                <pubDate><?php echo complex_date( get_field( 'start_date' ), get_field( 'end_date' ) ); ?></pubDate>

                <!-- Echo content and related posts -->
                <content:encoded>
                    <![CDATA[<?php echo the_excerpt_rss();
					echo $postlink;
					?>]]>
                </content:encoded>
            </item>

		<?php endforeach; ?>
        <!-- End loop -->
    </channel>
</rss>
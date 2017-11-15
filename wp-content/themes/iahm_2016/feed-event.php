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
        <title><?php bloginfo_rss( 'name' );
			wp_title_rss(); ?></title>
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
            <title>
				<?php bloginfo_rss( 'description' ) ?>
            </title>
            <link><?php bloginfo_rss( 'url' ) ?></link>
        </image>

		<?php do_action( 'rss2_head' ); ?>

		<?php
		$post_type = get_post_type( $_POST );

		var_dump( $_POST );

		?>

        <!-- Start loop -->
		<?php while ( have_posts() ) : the_post();

			if ( get_post_type() != 'iahm_event' ) {
				return;
			}

			$post = get_post();

			$is_mg = false;

			$categories = get_the_terms( $post->ID, 'iahm_eventcategory' );

			foreach ( $categories as $category ) :

				$parent_cat = $category;

				while ( $parent_cat != null ) {

					$current_cat = get_term( $parent_cat, 'iahm_eventcategory' );

					if ( $current_cat->slug == 'mg' ) {

						$is_mg = true;

						break;
					}

					$parent_cat = $current_cat->parent;

				}

			endforeach; ?>

			?>


            <item>
                <title><?php the_title_rss(); ?></title>
                <link><?php the_permalink_rss(); ?></link>
                <guid isPermaLink="false"><?php the_guid(); ?></guid>
                <author><?php echo $email ?><?php echo ' (' . $author . ')' ?></author>
                <image>
                    <url><?php echo esc_url( $postimage ); ?>"/></url>
                </image>
                <pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>

                <!-- Echo content and related posts -->
                <content:encoded>
                    <![CDATA[<?php echo the_excerpt_rss();
					echo $postlink;
					?>]]>
                </content:encoded>
            </item>

		<?php endwhile; ?>
        <!-- End loop -->
    </channel>
</rss>
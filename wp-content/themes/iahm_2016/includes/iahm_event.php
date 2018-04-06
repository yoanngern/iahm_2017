<?php


/**
 * Event
 */
function create_events() {
	register_post_type( 'iahm_event',
		array(
			'labels'                => array(
				'name'          => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'add_new'       => 'Add an event',
				'all_items'     => 'All events',
			),
			'public'                => true,
			'can_export'            => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => 'events',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'_builtin'              => false,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array( "slug" => "events" ),
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'menu_position'         => null,
			'supports'              => array(
				'title',
			),
			'menu_icon'             => 'dashicons-calendar-alt',
			'taxonomies'            => array( 'iahm_eventcategory' ),
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_events' );


function create_eventcategory_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Event categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Event category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Categories' ),
		'popular_items'              => __( 'Popular Categories' ),
		'all_items'                  => __( 'All event categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category' ),
		'update_item'                => __( 'Update Category' ),
		'add_new_item'               => __( 'Add New Category' ),
		'new_item_name'              => __( 'New Category Name' ),
		'separate_items_with_commas' => __( 'Separate categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories' ),
	);

	register_taxonomy( 'iahm_eventcategory', 'iahm_event', array(
		'label'        => __( 'Event Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'event-category' ),
	) );
}

add_action( 'init', 'create_eventcategory_taxonomy', 0 );

function custom_disable_months_dropdown( $false, $post_type ) {

	$disable_months_dropdown = $false;

	$disable_post_types = array( 'iahm_event' );

	if ( in_array( $post_type, $disable_post_types ) ) {

		$disable_months_dropdown = true;

	}

	return $disable_months_dropdown;

}

add_filter( 'disable_months_dropdown', 'custom_disable_months_dropdown', 10, 2 );

/**
 * Event column
 *
 * @param $columns
 *
 * @return array
 */
function iahm_event_column( $columns ) {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		//'title'      => 'Title',
		'event_title' => 'Title',
		'event_date'  => 'Date',
		'category'    => 'Category',
	);

	return $columns;
}

add_filter( 'manage_edit-iahm_event_columns', 'iahm_event_column' );

/**
 * Event column content
 *
 * @param $column
 */
function iahm_event_custom_column( $column ) {
	global $post;

	$curr_cat = get_query_var( "iahm_eventcategory" );

	$start = get_field( 'start_date', $post );
	$end   = get_field( 'end_date', $post );

	$start_o = new DateTime( $start );
	$end_o   = new DateTime( $end );

	$start_t = $start_o->getTimestamp();
	$end_t   = $end_o->getTimestamp();

	if ( $column == "event_title" ) {

		$id = $post->ID;

		$txt = get_the_title();

		echo "<a class='row-title' href='/wp-admin/post.php?post=$id&action=edit'>$txt</a>";

	} elseif ( $column == 'event_date' ) {

		echo complex_date( $start, $end );

		//echo date_i18n( get_option( 'date_format' ), strtotime( get_field( 'start_date', $post ) ) );

	} elseif ( $column == 'category' ) {

		foreach ( get_the_terms( $post, array( 'taxonomy' => 'iahm_eventcategory' ) ) as $cat ) {

			$name  = $cat->name;
			$slug  = $cat->slug;
			$class = "";

			if ( $curr_cat == $slug ) {
				$class = 'current';
			}

			echo "<a class='$class' href='edit.php?post_type=iahm_event&iahm_eventcategory=$slug'>$name</a>";


		}

	}
}

add_action( "manage_posts_custom_column", "iahm_event_custom_column" );


/**
 * @param $views
 *
 * @return mixed
 */
function iahm_service_views( $views ) {


	unset( $views['publish'] );
	unset( $views['draft'] );
	unset( $views['trash'] );
	unset( $views['pending'] );
	unset( $views['all'] );


	$post_timing = $_GET['post_timing'];
	$post_status = $_GET['post_status'];
	$category    = $_GET['iahm_eventcategory'];


	$tabs = array(
		array(
			'timing' => 'future',
			'name'   => pll__( 'Next events' )
		),
		array(
			'timing' => 'past',
			'name'   => pll__( 'Previous events' )
		)
	);


	foreach ( $tabs as $tab ) {

		$timing = $tab['timing'];
		$name   = $tab['name'];

		if ( $post_timing == $timing ) {
			$class = 'current';
		} else {
			$class = "";
		}

		if ( $post_status == '' && $timing == 'future' && $post_timing == '' ) {
			$class = 'current';
		}

		$views[ $timing ] = "<a class='$class' href='edit.php?post_type=iahm_event&iahm_eventcategory=$category&post_timing=$timing'>$name</a>";

	}

	$statuses = array(
		array(
			'slug'   => 'post_draft',
			'name'   => pll__( 'Drafts' ),
			'status' => 'draft'
		),
		array(
			'slug'   => 'post_trash',
			'name'   => pll__( 'Trash' ),
			'status' => 'trash'
		),
	);

	foreach ( $statuses as $status ) {

		$slug        = $status['slug'];
		$name        = $status['name'];
		$status_name = $status['status'];

		if ( $status_name == $post_status ) {
			$class = 'current';
		} else {
			$class = '';
		}

		$views[ $slug ] = "<a class='$class' href='edit.php?post_type=iahm_event&iahm_eventcategory=$category&post_status=$status_name'>$name</a>";

	}

	return $views;

}

add_filter( 'views_edit-iahm_event', 'iahm_service_views' );


function iahm_filter_events() {
	$screen = get_current_screen();
	global $wp_query;
	if ( $screen->post_type == 'iahm_event' ) {
		wp_dropdown_categories( array(
			'show_option_all' => 'Show All Categories',
			'taxonomy'        => 'iahm_eventcategory',
			'name'            => 'iahm_eventcategory',
			'orderby'         => 'name',
			'selected'        => ( isset( $wp_query->query['iahm_eventcategory'] ) ? $wp_query->query['iahm_eventcategory'] : '' ),
			'hierarchical'    => false,
			'depth'           => 3,
			'show_count'      => false,
			'hide_empty'      => true,
		) );
	}
}

add_action( 'restrict_manage_posts', 'iahm_filter_events' );

function perform_filtering( $query ) {
	$qv = &$query->query_vars;

	if ( ( $qv['iahm_eventcategory'] ) && is_numeric( $qv['iahm_eventcategory'] ) ) {
		$term                     = get_term_by( 'id', $qv['iahm_eventcategory'], 'iahm_eventcategory' );
		$qv['iahm_eventcategory'] = $term->slug;
	}
}

add_filter( 'parse_query', 'perform_filtering' );


/**
 * Order Event
 *
 * @param $query
 *
 * @return mixed
 */
function iahm_order_events( $query ) {

	$post_status = $_GET['post_status'];
	$post_timing = $_GET['post_timing'];
	$category    = $_GET['iahm_eventcategory'];

	if ( $query->query_vars['post_type'] != 'iahm_event' ) {
		return;
	}


	if ( $post_status == '' ) {
		$post_status = 'all';
	}

	if ( $post_timing == '' ) {
		$post_timing = 'all';
	}

	if ( is_admin()
	     && $query->is_main_query()
	     && ! filter_input( INPUT_GET, 'post_status' )
	     //&& ! filter_input( INPUT_GET, 'iahm_eventcategory' )
	     && ( $screen = get_current_screen() ) instanceof \WP_Screen
	     && $post_timing == ''
	) {

		$post_timing = 'future';

	}


	$query = order_dates( $query, 'iahm_event', 'iahm_eventcategory', $post_status, $post_timing );

	return $query;


}

add_action( 'pre_get_posts', 'iahm_order_events' );


/**
 * Register custom RSS template.
 */
function iahm_event_rss_template() {
	add_feed( 'event', 'iahm_event_rss_render' );

	add_feed( 'mg', 'iahm_mg_rss_render' );
}

add_action( 'after_setup_theme', 'iahm_event_rss_template' );


/**
 * Custom RSS template callback.
 */
function iahm_event_rss_render() {
	get_template_part( 'feed', 'event' );
}

/**
 * Custom RSS template callback.
 */
function iahm_mg_rss_render() {
	get_template_part( 'feed', 'mg' );
}
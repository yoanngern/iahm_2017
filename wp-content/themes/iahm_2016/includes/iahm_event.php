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

add_action( 'rest_api_init', function () {
	register_rest_field( 'iahm_event', 'event_title', array(
		'get_callback' => function ( $event_arr ) {
			$event_obj = get_post( $event_arr['id'] );

			return (string) $event_obj->post_title;
		},
		'schema'       => array(
			'description' => __( 'event_title' ),
			'type'        => 'String'
		),
	) );

	register_rest_field( 'iahm_event', 'event_start_date', array(
		'get_callback' => function ( $event_arr ) {
			$event_obj = get_post( $event_arr['id'] );

			return get_field( 'start_date', $event_obj->ID );
		},
		'schema'       => array(
			'description' => __( 'event_start_date' ),
			'type'        => 'String'
		),
	) );

	register_rest_field( 'iahm_event', 'event_end_date', array(
		'get_callback' => function ( $event_arr ) {
			$event_obj = get_post( $event_arr['id'] );

			return get_field( 'end_date', $event_obj->ID );
		},
		'schema'       => array(
			'description' => __( 'event_end_date' ),
			'type'        => 'String'
		),
	) );

	register_rest_field( 'iahm_event', 'order', array(
		'get_callback' => function ( $event_arr ) {
			$event_obj = get_post( $event_arr['id'] );

			return (int) strtotime( get_field( 'start_date', $event_obj->ID ) );
		},
		'schema'       => array(
			'description' => __( 'order' ),
			'type'        => 'int'
		),
	) );

	register_rest_field( 'iahm_event', 'upcoming', array(
		'get_callback' => function ( $event_arr ) {
			$event_obj = get_post( $event_arr['id'] );

			$return = false;

			if ( strtotime( get_field( 'start_date', $event_obj->ID ) ) ) {
				$return = true;
			}

			return (boolean) $return;
		},
		'schema'       => array(
			'description' => __( 'upcoming' ),
			'type'        => 'boolean'
		),
	) );
} );

add_filter( 'rest_query_vars', 'test_query_vars' );
function test_query_vars( $vars ) {
	$vars[] = 'meta_query';

	return $vars;
}



function time_trans( $date ) {
	if ( get_locale() == "fr_FR" ) :

		$time = date_i18n( 'H:i', strtotime( $date->format( 'H:i' ) ) );

	else:
		$time = date_i18n( 'g:i a', strtotime( $date->format( 'H:i' ) ) );
	endif;

	return $time;
}

function complex_date( $start, $end ) {

	if ( $start != $end ):

		// French
		if ( get_locale() == "fr_FR" ) :

			if ( date( 'Y', strtotime( $start ) ) == date( 'Y', strtotime( $end ) ) ):

				if ( date( 'm', strtotime( $start ) ) == date( 'm', strtotime( $end ) ) ):

					$date = date_i18n( 'j', strtotime( $start ) ) . ' - ' . date_i18n( 'j F Y', strtotime( $end ) );

				else:

					$date = date_i18n( 'j M', strtotime( $start ) ) . ' - ' . date_i18n( 'j M Y', strtotime( $end ) );

				endif;

			else:

				$date = date_i18n( 'j M Y', strtotime( $start ) ) . ' - ' . date_i18n( 'j M Y', strtotime( $end ) );

			endif;


		// English
		else:

			if ( date( 'Y', strtotime( $start ) ) == date( 'Y', strtotime( $end ) ) ):

				if ( date( 'm', strtotime( $start ) ) == date( 'm', strtotime( $end ) ) ):

					$date = date_i18n( 'M jS', strtotime( $start ) ) . ' - ' . date_i18n( 'jS Y', strtotime( $end ) );

				else:

					$date = date_i18n( 'M jS', strtotime( $start ) ) . ' - ' . date_i18n( 'M jS Y', strtotime( $end ) );

				endif;

			else:

				$date = date_i18n( 'M j, Y', strtotime( $start ) ) . ' - ' . date_i18n( 'M j, Y', strtotime( $end ) );

			endif;

		endif;

	// one day
	else:

		//$start = new DateTime($start);

		$date = date_i18n( get_option( 'date_format' ), strtotime( $start ) );

	endif;

	return $date;

}

function iahm_order_events( $query ) {


	if ( is_admin() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == 'iahm_event' ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'order', 'asc' );

		return;
	}

	if ( ! $query->is_main_query() ) {

		return;
	}

	// only modify queries for 'iahm_eventcategory' term
	if ( isset( $query->query_vars['iahm_eventcategory'] ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_key', 'end_date' );
		$query->set( 'order', 'asc' );

		$today = date( 'Ymd' );

		$query->set( 'meta_query', array(
			array(
				'key'     => 'end_date',
				'compare' => '>=',
				'value'   => $today,
			)
		) );
	}


	// only modify queries for 'iahm_event' post type
	if ( ! is_single() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == 'iahm_event' ) {

		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_key', 'end_date' );
		$query->set( 'order', 'asc' );

		$today = date( 'Ymd' );

		$query->set( 'meta_query', array(
			array(
				'key'     => 'end_date',
				'compare' => '>=',
				'value'   => $today,
			)
		) );


		/*
		$query->set( 'meta_query', array(
			array(
				'key'     => 'start_date',
				'compare' => '>=',
				'value'   => $today,
			)
		) );
		*/


	}

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
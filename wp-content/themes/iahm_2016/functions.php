<?php

function themeslug_enqueue_style() {
	wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css', false );
}

function themeslug_enqueue_script() {
	wp_enqueue_script( 'my-js', get_template_directory_uri() . '/js/main.min.js', false );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );


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
				//'editor',
				//'excerpt',
				//'thumbnail',
				//'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				//'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			'menu_icon'             => 'dashicons-calendar-alt',
			'taxonomies'            => array( 'iahm_eventcategory' ),
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_events' );

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

	register_taxonomy( 'iahm_eventcategory', 'iahm_events', array(
		'label'        => __( 'Event Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'event-category' ),
	) );
}

add_action( 'init', 'create_eventcategory_taxonomy', 0 );


/**
 * Speaker
 */
function create_people() {
	register_post_type( 'iahm_people',
		array(
			'labels'                => array(
				'name'          => __( 'People' ),
				'singular_name' => __( 'Person' ),
				'add_new'       => 'Add a person',
				'all_items'     => 'All people',
			),
			'public'                => true,
			'can_export'            => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => 'people',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'_builtin'              => false,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array( "slug" => "people" ),
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'supports'              => array(
				'title',
				//'editor',
				//'excerpt',
				//'thumbnail',
				//'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				//'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			'menu_icon'             => 'dashicons-businessman',
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_people' );


/**
 * Speaker
 */
function create_location() {
	register_post_type( 'iahm_location',
		array(
			'labels'              => array(
				'name'          => __( 'Locations' ),
				'singular_name' => __( 'Location' ),
				'add_new'       => 'Add a location',
				'all_items'     => 'All locations',
			),
			'public'              => true,
			'can_export'          => true,
			'show_ui'             => true,
			'_builtin'            => false,
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'rewrite'             => array( "slug" => "locations" ),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array(
				'title',
				//'editor',
				//'excerpt',
				//'thumbnail',
				//'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				//'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			'menu_icon'           => 'dashicons-location-alt',
			'exclude_from_search' => false,
		)
	);
}

add_action( 'init', 'create_location' );


function register_my_menu() {
	register_nav_menu( 'principal', __( 'Menu principal', 'iahm_conference' ) );
	register_nav_menu( 'events', __( 'Menu events', 'iahm_conference' ) );
	register_nav_menu( 'language-menu', __( 'Menu language', 'iahm_conference' ) );
	register_nav_menu( 'footer-menu', __( 'Menu footer', 'iahm_conference' ) );
}

add_action( 'init', 'register_my_menu' );


//add_action( 'acf/init', 'my_acf_init' );

add_theme_support( 'post-thumbnails' );

add_image_size( 'banner', 1050, 445, true );
add_image_size( 'home', 1352, 1003, true );
add_image_size( 'card', 300, 169, true );
add_image_size( 'signature', 80, 80, true );
add_image_size( 'banner_image', 1960, 524, true );
add_image_size( 'title_image', 350, 180, false );
add_image_size( 'avatar', 200, 200, true );


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 *
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 18;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function my_theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

function get_attachment_url_by_slug( $slug ) {

	$args    = array(
		'post_type'      => 'attachment',
		'name'           => sanitize_title( $slug ),
		'posts_per_page' => 1,
		'post_status'    => 'inherit',
	);
	$_header = get_posts( $args );

	$header = $_header ? array_pop( $_header ) : null;

	return $header ? wp_get_attachment_url( $header->ID ) : '';
}


function is_child( $pageSlug ) {

	$id = get_the_ID();

	do {

		$parent_id = wp_get_post_parent_id( $id );

		$parent_slug = get_page_uri( $parent_id );

		if ( $parent_slug == $pageSlug ) {

			return true;
		} else {
			$id = $parent_id;
		}

	} while ( $parent_id != 0 && true );

	return false;
}


// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( isset( $args->sub_menu ) ) {
		$root_id = 0;

		// find the current menu item
		foreach ( $sorted_menu_items as $menu_item ) {
			if ( $menu_item->current ) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}

		// find the top level parent
		if ( ! isset( $args->direct_parent ) ) {
			$prev_root_id = $root_id;
			while ( $prev_root_id != 0 ) {
				foreach ( $sorted_menu_items as $menu_item ) {
					if ( $menu_item->ID == $prev_root_id ) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ( $prev_root_id != 0 ) {
							$root_id = $menu_item->menu_item_parent;
						}
						break;
					}
				}
			}
		}
		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if ( $item->ID == $root_id ) {
				$menu_item_parents[] = $item->ID;
			}
			if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
				// not part of sub-tree: away with it!
				unset( $sorted_menu_items[ $key ] );
			}
		}

		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}

function get_field_or_parent( $field, $post_id, $taxonomy = 'category', $term = "" ) {

	if ( $term !== "" ) {
		global $post;

		$term_id = $term . "_" . $post_id;

		$field_return = get_field( $field, $term_id );

	} else {

		if ( $post_id === null ) {
			global $post;
		} else {
			$post = get_post( $post_id );
		}

		$field_return = get_field( $field, $post->ID );
	}


	if ( ! $field_return ) :

		$categories = get_the_terms( $post->ID, $taxonomy );

		foreach ( $categories as $category ) :

			$field_return = get_field( $field, $category );

			if ( $field_return ) {
				break;
			}

			while ( ! $field_return && $category->parent != null ) {

				$current_cat      = get_term( $category->parent, $taxonomy );
				$new_field_return = get_field( $field, $current_cat );

				if ( $new_field_return ) {
					$field_return = $new_field_return;
				}

				if ( $field_return ) {
					break;
				}

				$category = $current_cat;

			}

		endforeach;

		return $field_return;

	else:

		return $field_return;

	endif;
}

function get_related_posts( $post, $nb = 3 ) {
	$orig_post = $post;
	global $post;

	$posts = Array();

	$tags = wp_get_post_tags( $post->ID );


	if ( $tags ) {
		$tag_ids = array();
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args = array(
			'tag__in'          => $tag_ids,
			'post__not_in'     => array( $post->ID ),
			'posts_per_page'   => $nb, // Number of related posts to display.
			'caller_get_posts' => 1
		);

		$my_query = new wp_query( $args );


		foreach ( $my_query->get_posts() as $curr_post ) {


			array_push( $posts, $curr_post );
		}

	}


	$categories = get_categories( $post->ID );


	if ( ( sizeof( $posts ) < $nb ) && sizeof( $categories ) ) {


		$nb_needed = $nb - sizeof( $posts );


		foreach ( $categories as $category ) {


			$exclude = Array();

			array_push( $exclude, $post->ID );

			foreach ( $posts as $curr ) {
				array_push( $exclude, $curr->ID );
			}

			$recent_posts = wp_get_recent_posts( array(
				'numberposts'      => $nb_needed,
				'offset'           => 0,
				'category'         => $category->term_id,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'suppress_filters' => true,
				'exclude'          => $exclude
			) );

			foreach ( $recent_posts as $curr_post ) {


				$post_obj = get_post( $curr_post['ID'] );


				if ( sizeof( $posts ) < $nb ) {
					array_push( $posts, $post_obj );
				}
			}
		}

	}


	wp_reset_query();

	array_slice( $posts, 0, $nb );

	return $posts;
}

function time_trans( $date ) {
	if ( get_locale() == "fr_FR" ) :

		$time = date_i18n('H:i', strtotime( $date->format('H:i') ));

	else:
		$time = date_i18n('g:i a', strtotime( $date->format('H:i') ));
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

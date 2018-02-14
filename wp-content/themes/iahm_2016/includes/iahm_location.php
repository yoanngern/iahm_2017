<?php


/**
 * Location
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
			),
			'menu_icon'           => 'dashicons-location-alt',
			'exclude_from_search' => false,
		)
	);
}

add_action( 'init', 'create_location' );

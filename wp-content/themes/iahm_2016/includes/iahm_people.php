<?php


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
			),
			'menu_icon'             => 'dashicons-businessman',
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_people' );
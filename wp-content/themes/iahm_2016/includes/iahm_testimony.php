<?php


/**
 * Testimonies
 */
function create_testimonies() {
	register_post_type( 'iahm_testimony',
		array(
			'labels'                => array(
				'name'          => __( 'Testimonies' ),
				'singular_name' => __( 'Testimony' ),
				'add_new'       => 'Add a testimony',
				'all_items'     => 'All testimonies',
			),
			'public'                => true,
			'can_export'            => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => 'testimonies',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'_builtin'              => false,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array( "slug" => "testimonies" ),
			'capability_type'       => 'post',
			'hierarchical'          => false,
			'menu_position'         => null,
			'supports'              => array(
				'title',
				'editor',
			),
			'menu_icon'             => 'dashicons-testimonial',
			'taxonomies'            => array( 'iahm_testimonycategory', 'post_tag' ),
			'exclude_from_search'   => false,
		)
	);
}

add_action( 'init', 'create_testimonies' );

function create_testimonycategory_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Testimony category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Testimonies' ),
		'popular_items'              => __( 'Popular Testimonies' ),
		'all_items'                  => __( 'All testimony categories' ),
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

	register_taxonomy( 'iahm_testimonycategory', 'iahm_testimony', array(
		'label'        => __( 'Testimony Category' ),
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'testimony-category' ),
	) );
}

add_action( 'init', 'create_testimonycategory_taxonomy', 0 );
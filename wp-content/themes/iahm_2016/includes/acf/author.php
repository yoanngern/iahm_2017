<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_58f4bb11abb70',
		'title' => 'Author',
		'fields' => array(
			array(
				'key' => 'field_58f4bb2c43256',
				'label' => 'Author',
				'name' => 'author',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'iahm_people',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
				array(
					'param' => 'post_template',
					'operator' => '!=',
					'value' => 'page_live.php',
				),
				array(
					'param' => 'post_template',
					'operator' => '!=',
					'value' => 'page_home.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;
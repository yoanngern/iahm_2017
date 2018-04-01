<?php

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5878a9fb07de9',
		'title' => 'Event',
		'fields' => array(
			array(
				'key' => 'field_58f4d8c683f63',
				'label' => 'Simple event',
				'name' => 'simple_event',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_58f4d8e453d82',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_58f4d8f453d83',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_58f4d909b3e42',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			),
			array(
				'key' => 'field_58f4d919b3e43',
				'label' => 'Start date',
				'name' => 'start_date',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'Ymd',
				'first_day' => 1,
			),
			array(
				'key' => 'field_58f4d93f8b9dd',
				'label' => 'End date',
				'name' => 'end_date',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'Ymd',
				'first_day' => 1,
			),
			array(
				'key' => 'field_58f4e20679f42',
				'label' => 'Time',
				'name' => 'time',
				'type' => 'time_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'g:i a',
				'return_format' => 'H:i:s',
			),
			array(
				'key' => 'field_58f4d9518b9de',
				'label' => 'Location',
				'name' => 'location',
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
					0 => 'iahm_location',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_58f4d96dc59d9',
				'label' => 'Speakers',
				'name' => 'speakers',
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
				'multiple' => 1,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_58f4d983805a0',
				'label' => 'Worship leaders',
				'name' => 'worship_leaders',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'iahm_people',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 1,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_58f4d9a7a610f',
				'label' => 'Thumb',
				'name' => 'thumb',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_58f4d9bda6110',
				'label' => 'Title image',
				'name' => 'title_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_58f4d9d7a6111',
				'label' => 'Banner image',
				'name' => 'banner_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_58f4d9f514762',
				'label' => 'Banner video',
				'name' => 'banner_video',
				'type' => 'url',
				'instructions' => 'URL of the background video.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_58f4da0814763',
				'label' => 'Pricing',
				'name' => 'pricing',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'visual',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 1,
			),
			array(
				'key' => 'field_58f4da296e725',
				'label' => 'Infos details',
				'name' => 'infos_details',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'visual',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 1,
			),
			array(
				'key' => 'field_58f4da3d6e726',
				'label' => 'Schedule',
				'name' => 'schedule',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add a day',
				'sub_fields' => array(
					array(
						'key' => 'field_58f4da6682a8c',
						'label' => 'Date',
						'name' => 'date',
						'type' => 'date_picker',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'd/m/Y',
						'return_format' => 'Y-m-d',
						'first_day' => 1,
					),
					array(
						'key' => 'field_58f4da7b82a8d',
						'label' => 'Slot',
						'name' => 'slot',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => 'Add a slot',
						'sub_fields' => array(
							array(
								'key' => 'field_58f4da9882a8e',
								'label' => 'Time',
								'name' => 'time',
								'type' => 'time_picker',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'display_format' => 'g:i a',
								'return_format' => 'H:i:s',
							),
							array(
								'key' => 'field_58f4daa882a8f',
								'label' => 'Title',
								'name' => 'title',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_58f4dab582a90',
								'label' => 'Subtitle',
								'name' => 'subtitle',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
						),
					),
				),
			),
			array(
				'key' => 'field_58f4dac720351',
				'label' => 'Display a button',
				'name' => 'button',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_58f4dae420352',
				'label' => 'Button text',
				'name' => 'button_text',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4dac720351',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '51',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_58f4daff20353',
				'label' => 'Button link',
				'name' => 'button_link',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4dac720351',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '49',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_58f4db1420354',
				'label' => 'Display an alert message',
				'name' => 'alert',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4d8c683f63',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_58f4db2720355',
				'label' => 'Alert title',
				'name' => 'alert_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4db1420354',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_58f4db3c20356',
				'label' => 'Alert text',
				'name' => 'alert_text',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_58f4db1420354',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'iahm_event',
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
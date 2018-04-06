<?php

/**
 * @param $query
 * @param string $post_type
 * @param string $post_cat
 *
 * @return mixed
 */
function order_dates( $query, $post_type = 'iahm_event', $post_cat = 'iahm_eventcategory', $post_status = 'publish', $post_timing = 'all' ) {


	if ( $post_status == 'all' ) {
		$post_status = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit' );
	}

	if ( is_admin() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == $post_type ) {

		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_key', 'end_date' );
		$query->set( 'order', 'asc' );
		$query->set( 'post_status', $post_status );

		$today = date( 'Ymd' );

		if($post_timing == 'future') {
			$query->set( 'meta_query', array(
				array(
					'key'     => 'end_date',
					'compare' => '>=',
					'value'   => $today,
				)
			) );
		} elseif ($post_timing == 'past') {
			$query->set( 'order', 'desc' );

			$query->set( 'meta_query', array(
				array(
					'key'     => 'end_date',
					'compare' => '<',
					'value'   => $today,
				)
			) );
		}

		return $query;
	}

	if ( ! $query->is_main_query() ) {

		return $query;
	}

	// only modify queries for category
	if ( isset( $query->query_vars[ $post_cat ] ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_key', 'end_date' );
		$query->set( 'order', 'asc' );

		//$today = date( 'Y-m-d H:i:s' );
		$today = date( 'Ymd' );

		$query->set( 'meta_query', array(
			array(
				'key'     => 'end_date',
				'compare' => '>=',
				'value'   => $today,
			)
		) );

		return $query;
	}


	// only modify queries for specific post type
	if ( ! is_single() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == $post_type ) {

		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'start_date' );
		$query->set( 'meta_key', 'end_date' );
		$query->set( 'order', 'asc' );

		//$today = date( 'Y-m-d H:i:s' );
		$today = date( 'Ymd' );

		$query->set( 'meta_query', array(
			'relation' => 'AND',
			array(
				'key'     => 'end_date',
				'compare' => '>=',
				'value'   => $today,
			)
		) );

		return $query;


	}


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

<?php
//////////////////////////////////////////////////////
// Create cron job function
//////////////////////////////////////////////////////

function tagregator_revamped_get_api_hashtags() {
	$terms = get_terms( array(
		'taxonomy' => 'tagrev-hashtags',
		'hide_empty' => false,
	) );
	foreach ( $terms as $term ) {
		error_log( $term->slug );
	}

}// end tagregator_revamped_get_api_hashtags

add_action( 'tagregator_revamped_do_api_calls', 'tagregator_revamped_get_api_hashtags' );
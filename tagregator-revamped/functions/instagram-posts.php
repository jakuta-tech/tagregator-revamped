<?php
//////////////////////////////////////////////////////
// Insert Instagram Posts
//////////////////////////////////////////////////////

function tagregator_revamped_get_instagram_posts( $the_term ) {
	$tr_options = get_option( 'tagregator_revamped_options' );
	if ( empty( $tr_options['tagregator_revamped_instagram_access_token'] ) ||
		empty( $tr_options['tagregator_revamped_instagram_client_id'] ) ) {
		error_log( 'somethings empty' );
		return;
	}

	if ( 'no' == $tr_options['tagregator_revamped_instagram_sandbox'] ) {
		error_log( 'no' );
		error_log( $url );
		// url for PUBLIC tags // https://api.instagram.com/v1/tags/XXXX/media/recent/?access_token=XXXX
		$url = TAGREGATOR_REVAMPED_INSTAGRAM_API . 'v1/tags/' . $the_term . '/media/recent?access_token=' . $tr_options['tagregator_revamped_instagram_access_token'];
	} else {
		error_log( 'yes' );
		// url for SELF posts https://api.instagram.com/v1/users/self/media/recent/?access_token=XXXX
		$url = TAGREGATOR_REVAMPED_INSTAGRAM_API . 'v1/users/self/media/recent?access_token=' . $tr_options['tagregator_revamped_instagram_access_token'];
		error_log( $url );
	}

	$response = wp_remote_get( $url );
	$body     = json_decode( wp_remote_retrieve_body( $response ) );

	error_log( print_r( $body, true ) );

}// end tagregator_revamped_get_instagram_posts

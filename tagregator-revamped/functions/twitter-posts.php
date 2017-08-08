<?php
//////////////////////////////////////////////////////
// Insert Twitter Posts
//////////////////////////////////////////////////////

function tagregator_revamped_get_twitter_posts( $the_term ) {
	$tr_options = get_option( 'tagregator_revamped_options' );
	if ( 'yes' == $tr_options['tagregator_revamped_twitter_enabled'] ) {
		if ( empty( $tr_options['tagregator_revamped_twitter_key'] ) || empty( $tr_options['tagregator_revamped_twitter_secret'] ) ) {
			return;
		}

		$mple = $the_term;

		$twitter_key = $tr_options['tagregator_revamped_twitter_key'];
		$twitter_secret = $tr_options['tagregator_revamped_twitter_secret'];

		$since_id = '894767665251704832';

		$url = TAGREGATOR_REVAMPED_TWITTER_API . '1.1/search/tweets.json?q=' . $the_term . '&count=20&since_id=' . $since_id;
		error_log( $url );

		function twitter_call_the_api( $url, $twitter_access_token ) {
			$response = wp_remote_get(
				$url,
				array(
					'headers' => array(
						'Authorization' => 'Bearer ' . $twitter_access_token,
					),
				)
			);

			$the_result = json_decode( wp_remote_retrieve_body( $response ), true );
			$tag_user = get_user_by( 'login', 'TagregatorRevamped' );
			error_log( print_r( $the_result, true ) );
		}

		function get_bearer_token( $url, $credentials ) {
			$response = wp_remote_post(
				TAGREGATOR_REVAMPED_TWITTER_API . 'oauth2/token',
				array(
					'headers' => array(
						'Authorization' => 'Basic ' . $credentials,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => 'grant_type=client_credentials'
				)
			);

			$twitter_access_token = json_decode( wp_remote_retrieve_body( $response ) );
			if ( isset( $twitter_access_token->token_type ) && 'bearer' == $twitter_access_token->token_type ) {
				$twitter_access_token = $twitter_access_token->access_token;
			} else {
				$twitter_access_token = false;
			}
			twitter_call_the_api( $url, $twitter_access_token );
		}

		function get_bearer_credentials($url, $twitter_key, $twitter_secret ) {
			$credentials = $twitter_key . ':' . $twitter_secret;
			$credentials = base64_encode( $credentials );
			get_bearer_token($url, $credentials );
		}

		get_bearer_credentials( $url, $twitter_key, $twitter_secret );

//		if ( ! empty( $body['photos']['photo'] ) ) {
//			foreach ( $body['photos']['photo'] as $flickr_post ) {
//
//				$post_date = date( 'Y-m-d H:i:s', $flickr_post['dateupload'] );
//
//				// Create post object
//				$my_post = array(
//					'post_title' => $flickr_post['title'],
//					'post_content' => $flickr_post['description']['_content'],
//					'post_date' => $post_date,
//					'post_status' => 'publish',
//					'post_author' => $tag_user->ID,
//					'post_type' => 'tagrev-flickr',
//					'meta_input' => array(
//						'tagrev_meta_id' => $flickr_post['id'],
//						'tagrev_meta_name' => $flickr_post['ownername'],
//						'tagrev_meta_username' => $flickr_post['ownername'],
//						'tagrev_meta_profile_url' => 'https://www.flickr.com/photos/' . $flickr_post['owner'] . '/',
//						'tagrev_meta_profile_img' => 'http://farm' . $flickr_post['iconfarm'] . 'staticflickr.com/' . $flickr_post['iconserver'] . '/buddyicons/' . $flickr_post['owner'] . '.jpg',
//						'tagrev_meta_img' => $flickr_post['url_l'],
//						'tagrev_meta_url' => 'https://www.flickr.com/photos/' . $flickr_post['owner'] . '/' . $flickr_post['id'],
//					),
//				);
//
//				// Check if post exists in database
//				$find_post = array(
//					'post_type' => 'tagrev-flickr',
//					'meta_query' => array(
//						array(
//							'key' => 'tagrev_meta_id',
//							'value' => $flickr_post['id'],
//						),
//					),
//				);
//
//				$post_exists = new WP_Query( $find_post );
//
//				if ( ! $post_exists->have_posts() ) {
//					// Insert the post into the database
//					$my_post_id = wp_insert_post( $my_post );
//					// Add term to post
//					if ( $my_post_id ) {
//						wp_set_object_terms( $my_post_id, $the_term, 'tagrev-hashtags', true );
//					}
//				}
//			}// end foreach ( $body['photos']['photo'] as $flickr_post )
//		}
	}
}// end tagregator_revamped_get_twitter_posts

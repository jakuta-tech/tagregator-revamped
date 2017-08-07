<?php
//////////////////////////////////////////////////////
// Insert Instagram Posts
//////////////////////////////////////////////////////

function tagregator_revamped_get_instagram_posts( $the_term ) {
	$tr_options = get_option( 'tagregator_revamped_options' );
	if ( 'yes' == $tr_options['tagregator_revamped_instagram_enabled'] ) {
		if ( empty( $tr_options['tagregator_revamped_instagram_access_token'] ) ) {
			return;
		}

		if ( 'no' == $tr_options['tagregator_revamped_instagram_sandbox'] ) {
			// url for PUBLIC tags // https://api.instagram.com/v1/tags/XXXX/media/recent/?access_token=XXXX
			$url = TAGREGATOR_REVAMPED_INSTAGRAM_API . 'v1/tags/' . $the_term . '/media/recent?access_token=' . $tr_options['tagregator_revamped_instagram_access_token'];
		} else {
			// url for SELF posts https://api.instagram.com/v1/users/self/media/recent/?access_token=XXXX
			$url = TAGREGATOR_REVAMPED_INSTAGRAM_API . 'v1/users/self/media/recent?access_token=' . $tr_options['tagregator_revamped_instagram_access_token'];
		}

		$response = wp_remote_get( $url );
		$the_result = wp_remote_retrieve_body( $response );
		$body = json_decode( $the_result, true );
		$tag_user = get_user_by( 'login', 'TagregatorRevamped' );

		foreach ( $body['data'] as $insta_post ) {
			$post_date = date( 'Y-m-d H:i:s', $insta_post['created_time'] );
			// Create post object
			$my_post = array(
				'post_title' => $insta_post['caption']['text'],
				'post_content' => $insta_post['caption']['text'],
				'post_date' => $post_date,
				'post_status' => 'publish',
				'post_author' => $tag_user->ID,
				'post_type' => 'tagrev-instagram',
				'meta_input' => array(
					'tagrev_meta_id' => $insta_post['id'],
					'tagrev_meta_name' => $insta_post['user']['full_name'],
					'tagrev_meta_username' => $insta_post['user']['username'],
					'tagrev_meta_profile_url' => 'https://instagram.com/' . $insta_post['user']['username'],
					'tagrev_meta_img' => $insta_post['images']['standard_resolution']['url'],
					'tagrev_meta_url' => $insta_post['link'],
				),
			);

			// Check if post exists in database
			$find_post = array(
				'post_type' => 'tagrev-instagram',
				'meta_query' => array(
					array(
						'key' => 'tagrev_meta_id',
						'value' => $insta_post['id'],
					),
				),
			);

			$post_exists = new WP_Query( $find_post );

			if ( ! $post_exists->have_posts() ) {
				// Insert the post into the database
				$my_post_id = wp_insert_post( $my_post );
				// Add term to post
				if ( $my_post_id ) {
					wp_set_object_terms( $my_post_id, $the_term, 'tagrev-hashtags', true );
				}
			}
		}// end foreach ( $body['data'] as $insta_post )
	}
}// end tagregator_revamped_get_instagram_posts

<?php
//////////////////////////////////////////////////////
// Insert Flickr Posts
//////////////////////////////////////////////////////

function tagregator_revamped_get_flickr_posts( $the_term ) {
	$tr_options = get_option( 'tagregator_revamped_options' );
	if ( 'yes' == $tr_options['tagregator_revamped_flickr_enabled'] ) {
		if ( empty( $tr_options['tagregator_revamped_flickr_key'] ) ) {
			return;
		}

		$latest_flickr_date = new WP_Query(
			array(
				'post_type' => 'tagrev-flickr',
				'post_status' => 'publish',
				'posts_per_page' => 1,
				'orderby' => 'modified',
				'order' => 'DESC',
			)
		);

		if ( $latest_flickr_date->have_posts() ) {
			$min_date = $latest_flickr_date->posts[0]->post_modified;
		} else {
			$min_date = date( 'Y-m-d 0:00:00' );
		}

		$url = TAGREGATOR_REVAMPED_FLICKR_API . '?method=flickr.photos.search&tags=' . $the_term . '&min_upload_date=' . $min_date . '&extras=date_upload,description,owner_name,url_n,url_l,icon_farm,icon_server&format=json&nojsoncallback=1&api_key=' . $tr_options['tagregator_revamped_flickr_key'];

		$response = wp_remote_get( $url );
		$the_result = wp_remote_retrieve_body( $response );
		$body = json_decode( $the_result, true );
		$tag_user = get_user_by( 'login', 'TagregatorRevamped' );
		error_log( $min_date );

		// TODO: FIND POSTS WITH AVATAR, CHECK MIN DATE

		foreach ( $body['photos']['photo'] as $flickr_post ) {

			$post_date = date( 'Y-m-d H:i:s', $flickr_post['dateupload'] );

			// Create post object
			$my_post = array(
				'post_title' => $flickr_post['title'],
				'post_content' => $flickr_post['description']['content'],
				'post_date' => $post_date,
				'post_status' => 'publish',
				'post_author' => $tag_user->ID,
				'post_type' => 'tagrev-flickr',
				'meta_input' => array(
					'tagrev_meta_id' => $flickr_post['id'],
					'tagrev_meta_name' => $flickr_post['ownername'],
					'tagrev_meta_username' => $flickr_post['ownername'],
					'tagrev_meta_profile_url' => 'https://www.flickr.com/photos/' . $flickr_post['owner'] . '/',
					'tagrev_meta_profile_img' => '',
					'tagrev_meta_img' => $flickr_post['url_n'],
					'tagrev_meta_url' => 'https://www.flickr.com/photos/' . $flickr_post['owner'] . '/' . $flickr_post['id'],
				),
			);

			// Check if post exists in database
			$find_post = array(
				'post_type' => 'tagrev-flickr',
				'meta_query' => array(
					array(
						'key' => 'tagrev_meta_id',
						'value' => $flickr_post['id'],
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
		}// end foreach ( $body['photos']['photo'] as $flickr_post )
	}
}// end tagregator_revamped_get_flickr_posts

<?php
//////////////////////////////////////////////////////
// Insert Google+ Posts
//////////////////////////////////////////////////////

function tagregator_revamped_get_googleplus_posts( $the_term ) {
	$tr_options = get_option( 'tagregator_revamped_options' );
	if ( 'yes' == $tr_options['tagregator_revamped_googleplus_enabled'] ) {
		if ( empty( $tr_options['tagregator_revamped_googleplus_key'] ) ) {
			return;
		}

		$url = TAGREGATOR_REVAMPED_GOOGLEPLUS_API . 'v1/activities?query=#' . $the_term . '&key=' . $tr_options['tagregator_revamped_googleplus_key'];

		$response = wp_remote_get( $url );
		$the_result = wp_remote_retrieve_body( $response );
		$body = json_decode( $the_result, true );
		$tag_user = get_user_by( 'login', 'TagregatorRevamped' );

		if ( ! empty( $body['items'] ) ) {
			foreach ( $body['items'] as $gplus_post ) {

				$post_date = str_replace( 'T', ' ', $gplus_post['updated'] );
				$post_date = substr( $post_date, 0, -5 );

				// Create post object
				$my_post = array(
					'post_title' => $gplus_post['title'],
					'post_content' => $gplus_post['object']['content'],
					'post_date' => $post_date,
					'post_status' => 'publish',
					'post_author' => $tag_user->ID,
					'post_type' => 'tagrev-googleplus',
					'meta_input' => array(
						'tagrev_meta_id' => $gplus_post['id'],
						'tagrev_meta_name' => $gplus_post['actor']['displayName'],
						'tagrev_meta_username' => $gplus_post['actor']['displayName'],
						'tagrev_meta_profile_url' => $gplus_post['actor']['url'],
						'tagrev_meta_profile_img' => $gplus_post['actor']['image']['url'],
						'tagrev_meta_img' => '',
						'tagrev_meta_url' => $gplus_post['url'],
					),
				);

				// Check if post exists in database
				$find_post = array(
					'post_type' => 'tagrev-googleplus',
					'meta_query' => array(
						array(
							'key' => 'tagrev_meta_id',
							'value' => $gplus_post['id'],
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
			}// end foreach ( $body['items'] as $gplus_post )
		}
	}
}// end tagregator_revamped_get_googleplus_posts

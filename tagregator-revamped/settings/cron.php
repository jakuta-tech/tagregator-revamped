<?php
//////////////////////////////////////////////////////
// Create cron job function
//////////////////////////////////////////////////////

function tagregator_revamped_get_api_hashtags() {
	$terms = get_terms( array(
		'taxonomy' => 'tagrev-hashtags',
		'hide_empty' => false,
	) );
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$the_term = $term->name;
			tagregator_revamped_get_instagram_posts( $the_term );
			tagregator_revamped_get_googleplus_posts( $the_term );
			tagregator_revamped_get_flickr_posts( $the_term );
		}
	}
}// end tagregator_revamped_get_api_hashtags

add_action( 'tagregator_revamped_do_api_calls', 'tagregator_revamped_get_api_hashtags' );

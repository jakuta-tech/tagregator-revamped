<?php
//////////////////////////////////////////////////////
// Shortcode [tagregator-revamped show="#hashtag"]
//////////////////////////////////////////////////////

function tagregator_revamped_shortcode( $the_hashtags ) {

	// create array from hashtags
	$hashtags = explode( ',', $the_hashtags['show'] );

	// create terms if they don't exist
	foreach ( $hashtags as $hashtag ) {
		$remove_hashtag_spaces = str_replace( ' ', '', $hashtag );
		$cleantag = str_replace( '#', '', $remove_hashtag_spaces );
		$term = term_exists( $cleantag, 'tagrev-hashtags' );
		if ( 0 == $term && null == $term ) {
			wp_insert_term(
				'#' . $cleantag,
				'tagrev-hashtags',
				array(
					'description' => '#' . $cleantag,
					'slug'        => $cleantag,
				)
			);
		}
	}// end foreach ( $hashtags as $hashtag )
	// end create terms if they don't exist

}// end tagregator_revamped_shortcode

add_shortcode( 'tagregator-revamped', 'tagregator_revamped_shortcode' );

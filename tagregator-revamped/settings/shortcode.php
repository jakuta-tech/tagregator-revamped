<?php
//////////////////////////////////////////////////////
// Shortcode [tagregator-revamped show="#hashtag"]
//////////////////////////////////////////////////////

function tagregator_revamped_shortcode( $the_hashtags ) {

	// create array from hashtags
	$hashtags = explode( ',', $the_hashtags['show'] );

	// create terms if they don't exist
	foreach ( $hashtags as $hashtag ) {
		$cleantag = str_replace( '#', '', $hashtag );
		$term = term_exists( $cleantag, 'tagrev-hashtags' );
		if ( 0 == $term && null == $term ) {
			echo $cleantag . ' category doesn\'t exist!<br/>';
		}
	}// end foreach ( $hashtags as $hashtag )

}// end tagregator_revamped_shortcode

add_shortcode( 'tagregator-revamped', 'tagregator_revamped_shortcode' );

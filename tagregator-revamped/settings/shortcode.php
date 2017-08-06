<?php
//////////////////////////////////////////////////////
// Shortcode [tagregator-revamped show="#hashtag"]
//////////////////////////////////////////////////////

function tagregator_revamped_shortcode( $hashtag ) {


	return $hashtag[ 'show' ];

}

add_shortcode( 'tagregator-revamped', 'tagregator_revamped_shortcode' );
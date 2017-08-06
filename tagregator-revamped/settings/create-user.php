<?php
//////////////////////////////////////////////////////
// Create User
//////////////////////////////////////////////////////

function tagregator_revamped_create_user() {
	if ( ! username_exists( 'TagregatorRevamped' ) ) {
		wp_insert_user(
			array(
				'user_pass' => wp_generate_password( 100, true, true ),
				'user_login' => 'TagregatorRevamped',
				'user_email' => 'Tagregator@Revamped.tagrev',
				'user_role' => 'Subscriber',
			)
		);
	}
}// end tagregator_revamped_create_user

add_action( 'init', 'tagregator_revamped_create_user' );

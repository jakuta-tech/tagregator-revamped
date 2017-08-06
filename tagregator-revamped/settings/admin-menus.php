<?php
//////////////////////////////////////////////////////
// Admin Menu
//////////////////////////////////////////////////////

function tagregator_revamped_admin_menu() {
	add_menu_page(
		'Tagregator Revamped',
		'Tagregator Revamped',
		'manage_options',
		'tagregator-revamped',
		'tagregator_revamped_settings_page',
		'dashicons-share',
		'80'
	);
	add_submenu_page(
		'tagregator-revamped',
		'Hashtags',
		'Hashtags',
		'manage_options',
		'edit-tags.php?taxonomy=tagrev-hashtags'
	);
	add_submenu_page(
		'tagregator-revamped',
		'Settings',
		'Settings',
		'manage_options',
		'tagregator-revamped-settings',
		'tagregator_revamped_settings_page'
	);
	remove_submenu_page( 'tagregator-revamped', 'tagregator-revamped' );
} // end tagregator_revamped_admin_menu

add_action( 'admin_menu', 'tagregator_revamped_admin_menu' );

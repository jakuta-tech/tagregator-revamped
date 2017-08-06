<?php
//////////////////////////////////////////////////////
// Register Custom Taxonomy
//////////////////////////////////////////////////////

function tagregator_revamped_create_taxonomy() {

	$labels = array(
		'name' => _x( 'Hashtags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Hashtag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name' => __( 'Hashtags', 'text_domain' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);
	register_taxonomy( 'tagrev-hashtags', array( 'tagrev-tweets' ), $args );

}// end tagregator_revamped_create_taxonomy

add_action( 'init', 'tagregator_revamped_create_taxonomy', 0 );


//////////////////////////////////////////////////////
// Register Custom Post Types
//////////////////////////////////////////////////////

function tagregator_revamped_twitter_post_type() {

	$labels = array(
		'name' => 'Twitter Feed',
		'singular_name' => 'Twitter Feed',
		'menu_name' => 'Twitter Feed',
		'name_admin_bar' => 'Twitter Feed',
	);
	$args = array(
		'label' => 'Twitter',
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'custom-fields', ),
		'taxonomies' => array( 'tagrev-hashtags' ),
		'hierarchical' => false,
		'public' => true,
		'show_in_menu' => 'tagregator-revamped',
		'capability_type' => 'post',
	);
	register_post_type( 'tagrev-twitter', $args );
}// end tagregator_revamped_twitter_post_type

add_action( 'init', 'tagregator_revamped_twitter_post_type', 0 );

function tagregator_revamped_instagram_post_type() {

	$labels = array(
		'name' => 'Instagram Feed',
		'singular_name' => 'Instagram Feed',
		'menu_name' => 'Instagram Feed',
		'name_admin_bar' => 'Instagram Feed',
	);
	$args = array(
		'label' => 'Instagram',
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'custom-fields', ),
		'taxonomies' => array( 'tagrev-hashtags' ),
		'hierarchical' => false,
		'public' => true,
		'show_in_menu' => 'tagregator-revamped',
		'capability_type' => 'post',
	);
	register_post_type( 'tagrev-instagram', $args );
}// end tagregator_revamped_instagram_post_type

add_action( 'init', 'tagregator_revamped_instagram_post_type', 0 );

function tagregator_revamped_googleplus_post_type() {

	$labels = array(
		'name' => 'Google+ Feed',
		'singular_name' => 'Google+ Feed',
		'menu_name' => 'Google+ Feed',
		'name_admin_bar' => 'Google+ Feed',
	);
	$args = array(
		'label' => 'GooglePlus',
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'custom-fields', ),
		'taxonomies' => array( 'tagrev-hashtags' ),
		'hierarchical' => false,
		'public' => true,
		'show_in_menu' => 'tagregator-revamped',
		'capability_type' => 'post',
	);
	register_post_type( 'tagrev-googleplus', $args );
}// end tagregator_revamped_googleplus_post_type

add_action( 'init', 'tagregator_revamped_googleplus_post_type', 0 );

function tagregator_revamped_flickr_post_type() {

	$labels = array(
		'name' => 'Flickr Feed',
		'singular_name' => 'Flickr Feed',
		'menu_name' => 'Flickr Feed',
		'name_admin_bar' => 'Flickr Feed',
	);
	$args = array(
		'label' => 'Flickr',
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'custom-fields', ),
		'taxonomies' => array( 'tagrev-hashtags' ),
		'hierarchical' => false,
		'public' => true,
		'show_in_menu' => 'tagregator-revamped',
		'capability_type' => 'post',
	);
	register_post_type( 'tagrev-flickr', $args );
}// end tagregator_revamped_flickr_post_type

add_action( 'init', 'tagregator_revamped_flickr_post_type', 0 );
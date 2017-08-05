<?php
//////////////////////////////////////////////////////
// Register Options
//////////////////////////////////////////////////////

function tagregator_revamped_options()
{
	register_setting(
		'tagregator_revamped_options',
		'tagregator_revamped_options',
		'tagregator_revamped_options_validate'
	);

	// twitter settings
	add_settings_section(
		'tagregator_revamped_twitter',
		'Twitter Settings',
		'',
		'tagregator_revamped_twitter'
	);
	add_settings_field(
		'tagregator_revamped_twitter_key',
		'Consumer Key',
		'tagregator_revamped_twitter_key',
		'tagregator_revamped_twitter',
		'tagregator_revamped_twitter'
	);
	add_settings_field(
		'tagregator_revamped_consumer_secret',
		'Consumer Secret',
		'tagregator_revamped_twitter_secret',
		'tagregator_revamped_twitter',
		'tagregator_revamped_twitter'
	);

	// instagram settings
	add_settings_section(
		'tagregator_revamped_instagram',
		'Instagram Settings',
		'',
		'tagregator_revamped_instagram'
	);
	add_settings_field(
		'tagregator_revamped_instagram_client_id',
		'Client Id',
		'tagregator_revamped_instagram_client_id',
		'tagregator_revamped_instagram',
		'tagregator_revamped_instagram'
	);
	add_settings_field(
		'tagregator_revamped_instagram_client_secret',
		'Client Secret',
		'tagregator_revamped_instagram_client_secret',
		'tagregator_revamped_instagram',
		'tagregator_revamped_instagram'
	);
	add_settings_field(
		'tagregator_revamped_instagram_redirect_url',
		'Redirect URL',
		'tagregator_revamped_instagram_redirect_url',
		'tagregator_revamped_instagram',
		'tagregator_revamped_instagram'
	);
	add_settings_field(
		'tagregator_revamped_instagram_access_token',
		'Access Token',
		'tagregator_revamped_instagram_access_token',
		'tagregator_revamped_instagram',
		'tagregator_revamped_instagram'
	);

	// google+ settings
	add_settings_section(
		'tagregator_revamped_googleplus',
		'Google+ Settings',
		'',
		'tagregator_revamped_googleplus'
	);
	add_settings_field(
		'tagregator_revamped_googleplus_key',
		'Google+ Key',
		'tagregator_revamped_googleplus_key',
		'tagregator_revamped_googleplus',
		'tagregator_revamped_googleplus'
	);

	// flickr settings
	add_settings_section(
		'tagregator_revamped_flickr',
		'Flickr Settings',
		'',
		'tagregator_revamped_flickr'
	);
	add_settings_field(
		'tagregator_revamped_flickr_key',
		'Flickr Key',
		'tagregator_revamped_flickr_key',
		'tagregator_revamped_flickr',
		'tagregator_revamped_flickr'
	);
} // end tagregator_revamped_options

add_action( 'admin_init', 'tagregator_revamped_options' );

//////////////////////////////////////////////////////
// Options Output
//////////////////////////////////////////////////////

function tagregator_revamped_section_text()
{
	echo 'Tagregator Revamped Settings';
} // end tagregator_revamped_section_text

function tagregator_revamped_twitter_key()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_twitter_key' name='tagregator_revamped_options[tagregator_revamped_twitter_key]' size='40' type='text' value='{$tr_options['tagregator_revamped_twitter_key']}' />";
} // end tagregator_revamped_twitter_key

function tagregator_revamped_twitter_secret()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_twitter_secret' name='tagregator_revamped_options[tagregator_revamped_twitter_secret]' size='40' type='text' value='{$tr_options['tagregator_revamped_twitter_secret']}' />";
} // end tagregator_revamped_twitter_secret

function tagregator_revamped_instagram_client_id()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_instagram_client_id' name='tagregator_revamped_options[tagregator_revamped_instagram_client_id]' size='40' type='text' value='{$tr_options['tagregator_revamped_instagram_client_id']}' />";
} // end tagregator_revamped_instagram_client_id

function tagregator_revamped_instagram_client_secret()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_instagram_client_secret' name='tagregator_revamped_options[tagregator_revamped_instagram_client_secret]' size='40' type='text' value='{$tr_options['tagregator_revamped_instagram_client_secret']}' />";
} // end tagregator_revamped_instagram_client_secret

function tagregator_revamped_instagram_access_token()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_instagram_access_token' name='tagregator_revamped_options[tagregator_revamped_instagram_access_token]' size='40' type='text' value='{$tr_options['tagregator_revamped_instagram_access_token']}' />";
} // end tagregator_revamped_instagram_access_token

function tagregator_revamped_instagram_redirect_url()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_instagram_redirect_url' name='tagregator_revamped_options[tagregator_revamped_instagram_redirect_url]' size='40' type='text' value='{$tr_options['tagregator_revamped_instagram_redirect_url']}' />";
} // end tagregator_revamped_instagram_redirect_url

function tagregator_revamped_flickr_key()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_flickr_key' name='tagregator_revamped_options[tagregator_revamped_flickr_key]' size='40' type='text' value='{$tr_options['tagregator_revamped_flickr_key']}' />";
} // end tagregator_revamped_flickr_key

function tagregator_revamped_googleplus_key()
{
	$tr_options = get_option( 'tagregator_revamped_options' );
	echo "<input id='tagregator_revamped_googleplus_key' name='tagregator_revamped_options[tagregator_revamped_googleplus_key]' size='40' type='text' value='{$tr_options['tagregator_revamped_googleplus_key']}' />";
} // end tagregator_revamped_googleplus_key

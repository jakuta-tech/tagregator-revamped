<?php
/*
 * @package Tagregator Revamped
 * @version 1.0.0
 *
 * Plugin Name:       Tagregator Revamped
 * Plugin URI:        https://xkon.gr/tagregator-revamped/
 * Description:       Gathers posts with certain #hashtags from multiple social media sites.
 * Version:           1.0.0
 * Author:            Xenos (xkon) Konstantinos
 * Author URI:        https://xkon.gr/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tagregator-revamped
 * Domain Path:       /languages
 *
*/

//////////////////////////////////////////////////////
// If this file is called directly, abort
//////////////////////////////////////////////////////
if ( ! defined( 'WPINC' ) ) {
	die;
}

//////////////////////////////////////////////////////
// Settings
//////////////////////////////////////////////////////

define( 'TAGREGATOR_REVAMPED_TWITTER_DEV_PORTAL', 'https://apps.twitter.com/' );
define( 'TAGREGATOR_REVAMPED_TWITTER_API', 'https://api.twitter.com/' );

define( 'TAGREGATOR_REVAMPED_INSTAGRAM_DEV_PORTAL', 'https://www.instagram.com/developer/' );
define( 'TAGREGATOR_REVAMPED_INSTAGRAM_API', 'https://api.instagram.com/' );
define( 'TAGREGATOR_REVAMPED_INSTAGRAM_API_TOKEN', 'https://api.instagram.com/oauth/access_token/' );

define( 'TAGREGATOR_REVAMPED_FLICKR_DEV_PORTAL', 'https://www.flickr.com/services/' );
define( 'TAGREGATOR_REVAMPED_FLICKR_API', 'https://secure.flickr.com/services/rest/' );

define( 'TAGREGATOR_REVAMPED_GOOGLEPLUS_DEV_PORTAL', 'https://console.developers.google.com/' );
define( 'TAGREGATOR_REVAMPED_GOOGLEPLUS_API', 'https://www.googleapis.com/plus/' );

//////////////////////////////////////////////////////
// Create cron job
//////////////////////////////////////////////////////

// Custom Cron Recurrences
function tagregator_revamped_do_api_calls( $schedules ) {
	$schedules['tagrev30'] = array(
		'display' => 'every 30 minutes',
		'interval' => 1800,
	);
	return $schedules;
}

add_filter( 'cron_schedules', 'tagregator_revamped_do_api_calls' );

/////////////////////////////// register cron every 5 minutes
function tagregator_revamped_activation() {
	if ( ! wp_next_scheduled( 'tagregator_revamped_do_api_calls' ) ) {
		wp_schedule_event( time(), 'tagrev30', 'tagregator_revamped_do_api_calls' );
	}
}// end tagregator_revamped_activation

register_activation_hook( __FILE__, 'tagregator_revamped_activation' );


function tagregator_revamped_deactivation() {
	wp_clear_scheduled_hook( 'tagregator_revamped_do_api_calls' );
}// end tagregator_revamped_deactivation

register_deactivation_hook( __FILE__, 'tagregator_revamped_deactivation' );

//////////////////////////////////////////////////////
// Load core files
//////////////////////////////////////////////////////

require_once( plugin_dir_path( __FILE__ ) . 'settings/create-user.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/custom-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/meta-boxes.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/options.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/admin-menus.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/settings-page.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/shortcode.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/cron.php' );
require_once( plugin_dir_path( __FILE__ ) . 'functions/instagram-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'functions/googleplus-posts.php' );


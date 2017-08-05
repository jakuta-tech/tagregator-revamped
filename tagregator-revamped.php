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
define( 'TAGREGATOR_REVAMPED_TWITTER_API', 'https://api.twitter.com' );

define( 'TAGREGATOR_REVAMPED_FLICKR_DEV_PORTAL', 'https://www.flickr.com/services/' );
define( 'TAGREGATOR_REVAMPED_FLICKR_API', 'https://secure.flickr.com/services/rest' );

define( 'TAGREGATOR_REVAMPED_GOOGLEPLUS_DEV_PORTAL', 'https://console.developers.google.com/' );
define( 'TAGREGATOR_REVAMPED_GOOGLEPLUS_API', 'https://www.googleapis.com/plus' );

define( 'TAGREGATOR_REVAMPED_INSTAGRAM_DEV_PORTAL', 'https://www.instagram.com/developer/' );
define( 'TAGREGATOR_REVAMPED_INSTAGRAM_API', 'https://api.instagram.com' );

//////////////////////////////////////////////////////
// Load core files
//////////////////////////////////////////////////////

require_once( plugin_dir_path( __FILE__ ) . 'settings/create-user.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/custom-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/options.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/admin-menus.php' );
require_once( plugin_dir_path( __FILE__ ) . 'settings/settings-page.php' );

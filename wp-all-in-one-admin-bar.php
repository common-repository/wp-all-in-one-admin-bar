<?php
/**
 * Plugin Name:       WordPress All In One Admin Bar
 * Plugin URI:        http://codebunny.com
 * Description:       This plugin allows you to add wp menues or/and custom menues to admin bar, change admin bar styles and menu styles, add background images for admin bar and menu hide, auto hide and toggle admin bar and much more
 * Version:           1.1
 * Author:            Code Bunny
 * Author URI:        http://codebunny.com
 * Text Domain:       wp-all-in-one-admin-bar
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

const PLUGIN_SLUG =  'wp-all-in-one-admin-bar';

$wpaioab_options = get_option('wpaioab_settings');
$adminbar_links = array('wp-logo' => __('WP Logo', PLUGIN_SLUG), 
						'about' => __('About WordPress', PLUGIN_SLUG), 
						'wporg' => __('WP Org Link', PLUGIN_SLUG), 
						'documentation' => __('Documentation', PLUGIN_SLUG), 
						'support-forums' => __('Support Forums', PLUGIN_SLUG), 
						'feedback' => __('Feedback', PLUGIN_SLUG), 
						'site-name' => __('Site Name', PLUGIN_SLUG), 
						'view-site' => __('View Site', PLUGIN_SLUG), 
						'dashboard' => __('Dashboard ( Front End Only )', PLUGIN_SLUG), 
						'themes' => __('Themes ( Front End Only )', PLUGIN_SLUG),
						'widgets' => __('Widgets ( Front End Only )', PLUGIN_SLUG),
						'menus' => __('Menus ( Front End Only )', PLUGIN_SLUG),
						'updates' => __('Updates', PLUGIN_SLUG), 
						'comments' => __('Comments', PLUGIN_SLUG), 
						'view-site' => __('View Site', PLUGIN_SLUG),
						'new-content' => __('New Content', PLUGIN_SLUG),
						'new-post' => __('New Post', PLUGIN_SLUG),
						'new-media' => __('New Media', PLUGIN_SLUG),
						'new-link' => __('New Link', PLUGIN_SLUG),
						'new-page' => __('New Page', PLUGIN_SLUG));
						
		if(is_plugin_active('bbpress/bbpress.php')){
			$adminbar_links['new-forum'] = __('New Forum (bbPress)', PLUGIN_SLUG);
			$adminbar_links['new-topic'] = __('New Topic (bbPress)', PLUGIN_SLUG);
			$adminbar_links['new-reply'] = __('New Reply (bbPress)', PLUGIN_SLUG);
		}
		if(is_plugin_active('events-manager/events-manager.php')){
			$adminbar_links['new-event'] = __('New Event ( Events Manager)', PLUGIN_SLUG);
			$adminbar_links['new-location'] = __('New Location ( Events Manager)', PLUGIN_SLUG);
			$adminbar_links['new-event-recurring'] = __('New Event Recurring( Events Manager)', PLUGIN_SLUG);
		}			
			$adminbar_links['new-user'] = __('New User', PLUGIN_SLUG);	
			$adminbar_links['my-account'] = __('My Account', PLUGIN_SLUG);	
			$adminbar_links['user-actions'] = __('User Actions', PLUGIN_SLUG);	
			$adminbar_links['user-info'] = __('User Info', PLUGIN_SLUG);	
			$adminbar_links['edit-profile'] = __('Edit Profile', PLUGIN_SLUG);	
			$adminbar_links['logout'] = __('Logout', PLUGIN_SLUG);		

		if (is_multisite()) {
			$adminbar_links['my-sites'] = __('My Site ( Multisite )', PLUGIN_SLUG);
		}
				

		if(is_plugin_active('buddypress/bp-loader.php')){
			
			$adminbar_links['bp-login'] = __('Login From Admin Bar( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['bp-register'] = __('Register From Admin Bar( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-activity'] = __('Activity From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-xprofile'] = __('Profile From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-notifications'] = __('Notifications From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-messages'] = __('Messages From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-friends'] = __('Friends From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-groups'] = __('Groups From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
			$adminbar_links['my-account-settings'] = __('Settings From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
				if (is_multisite()) {			
					$adminbar_links['my-account-blogs'] = __('Sites From My Account Menu ( BuddyPress )', PLUGIN_SLUG);
				}
		}
		
		if(is_plugin_active('buddypress-links/bp-links-loader.php')){
			$adminbar_links['my-account-links'] = __('Links From My Account Menu ( BuddyPress Links)', PLUGIN_SLUG);
		}
		
		if(is_plugin_active('buddypress-followers/loader.php')){
			$adminbar_links['my-account-follow'] = __('Follow From My Account Menu ( BuddyPress Followers)', PLUGIN_SLUG);
		}
		
		if(is_plugin_active('events-manager/events-manager.php')){
			$adminbar_links['my-em-events'] = __('Events From My Account Menu ( Events Manager)', PLUGIN_SLUG);
		}		

		if(is_plugin_active('bbpress/bbpress.php')){
			$adminbar_links['my-account-forums'] = __('Forums From My Account Menu (bbPress)', PLUGIN_SLUG);	
		}

		if(is_plugin_active('buddypress-media/index.php')){
			$adminbar_links['my-account-media'] = __('Media From My Account Menu (rtMedia)', PLUGIN_SLUG);	
		}

		if(is_plugin_active('w3-total-cache/w3-total-cache.php')){
			$adminbar_links['w3tc'] = __('W3 Total Cache', PLUGIN_SLUG);	
		}

		if(is_plugin_active('wordpress-seo/wp-seo.php')){
			$adminbar_links['wpseo-menu'] = __('SEO By Yoast', PLUGIN_SLUG);	
		}
		
	$menu_item_shadow_strengths = array('0 8px 6px -6px color' => 'Type 1', '0 -8px 6px -6px color' => 'Type 2', '0 5px 5px -5px color' => 'Type 3', '0 -5px 5px -5px color' => 'Type 4', '0 -1px 1px 1px color' => 'Type 5', '0 2px 3px 1px color' => 'Type 6', '1px 1px 1px 0 color' => 'Type 7', '-1px -1px 1px 0 color' => 'Type 8', '1px -1px 1px 0 color' => 'Type 9', '-1px 1px 1px 0 color' => 'Type 10', 'inset 0 7px 7px -7px color' => 'Type 11', 'inset 0 -7px 7px -7px color' => 'Type 12','inset 0 0 7px color' => 'Type 13', 'inset 0 8px 8px -8px color, inset 0 -8px 8px -8px color' => 'Type 14', '0 1px 0 0 color' => 'Type 15', '0 -1px 0 0 color' => 'Type 16', '0 0 1px 0 color' => 'Type 17', '0 0 0 1px color' => 'Type 18', 'inset 5px 1px 15px 0px color, inset -5px 1px 15px 0px color' => 'Type 19', '8px 0 8px -4px color, -8px 0 8px -4px color' => 'Type 20');
	$menu_shadow_strengths = array('2px 4px 4px 2px' => 'Type 1', '1px 2px 2px 2px' => 'Type 2', '1px 1px 1px 1px' => 'Type 3', '2px -4px 4px 2px' => 'Type 4', '1px -2px 2px 2px' => 'Type 5', '1px -1px 1px 1px' => 'Type 6', '4px 4px 0px 0px' => 'Type 7', '3px 3px 0px 0px' => 'Type 8', '1px 1px 0px 0px' => 'Type 9', '4px -4px 0px 0px' => 'Type 10', '3px -3px 0px 0px' => 'Type 11', '1px -1px 0px 0px' => 'Type 12');
	$menu_icon_image_sizes = array('width:28px;height:28px' => '28x28 px', 'width:32px;height:32px' => '32x32 px');	
	$show_menus_for = array('1' => 'Logged In & Out Both Users', '2' => 'Logged In Users Only', '3' => 'Logged Out Users Only');	
	

require_once( plugin_dir_path( __FILE__ ) . 'public/class-wordpress-all-in-one-adminbar.php' );
require_once( plugin_dir_path( __FILE__ ) . '/public/includes/class-wordpress-all-in-one-adminbar-css-formater.php' );
require_once( plugin_dir_path( __FILE__ ) . '/public/includes/class-wordpress-all-in-one-adminbar-customizer.php' );
require_once( plugin_dir_path( __FILE__ ) . '/public/includes/class-wordpress-all-in-one-adminbar-menu-params.php' );
require_once( plugin_dir_path( __FILE__ ) . '/public/includes/class-wordpress-all-in-one-adminbar-auto-hide.php' );


register_activation_hook( __FILE__, array( 'Wordpress_All_In_One_Adminbar', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Wordpress_All_In_One_Adminbar', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Wordpress_All_In_One_Adminbar', 'get_instance' ) );

if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wordpress-all-in-one-adminbar-admin.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/class-wordpress-all-in-one-adminbar-custom-menu.php' );
	
	add_action( 'plugins_loaded', array( 'Wordpress_All_In_One_Adminbar_Admin', 'get_instance' ) );

}

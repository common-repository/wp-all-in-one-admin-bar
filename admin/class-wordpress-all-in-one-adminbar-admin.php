<?php

class Wordpress_All_In_One_Adminbar_Admin {

	protected static $instance = null;

	protected $plugin_screen_hook_suffix = null;

	private function __construct() {

		$plugin = Wordpress_All_In_One_Adminbar::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->init_options();
		
		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action( 'admin_init', array( $this, 'wpaioab_register_settings' ) );
		
		$custom_menu = Wordpress_All_In_One_Adminbar_Custom_Menu::get_instance();
		$css_formatter = Wordpress_All_In_One_CSS_Formater::get_instance();

		if ( is_admin() ) {
			add_action( 'wp_ajax_nopriv_custom-menu', array( &$custom_menu, 'get_custom_menus' ) );
			add_action( 'wp_ajax_custom-menu', array( &$custom_menu, 'get_custom_menus' ) );
			
			add_action( 'wp_ajax_nopriv_new-menu-root', array( &$custom_menu, 'add_new_menu_root' ) );
			add_action( 'wp_ajax_new-menu-root', array( &$custom_menu, 'add_new_menu_root' ) );
			
			add_action( 'wp_ajax_nopriv_new-menu-item', array( &$custom_menu, 'add_new_menu_item' ) );
			add_action( 'wp_ajax_new-menu-item', array( &$custom_menu, 'add_new_menu_item' ) );
			
			add_action( 'wp_ajax_nopriv_new-child-item', array( &$custom_menu, 'add_new_child_item' ) );
			add_action( 'wp_ajax_new-child-item', array( &$custom_menu, 'add_new_child_item' ) );
			
			add_action( 'wp_ajax_nopriv_load-current-menu', array( &$custom_menu, 'load_current_menu_structure' ) );
			add_action( 'wp_ajax_load-current-menu', array( &$custom_menu, 'load_current_menu_structure' ) );
			
			add_action( 'wp_ajax_nopriv_delete-custom-menu', array( &$custom_menu, 'delete_custom_menu' ) );
			add_action( 'wp_ajax_delete-custom-menu', array( &$custom_menu, 'delete_custom_menu' ) );
			
			add_action( 'wp_ajax_nopriv_delete-custom-item', array( &$custom_menu, 'delete_custom_item' ) );
			add_action( 'wp_ajax_delete-custom-item', array( &$custom_menu, 'delete_custom_item' ) );
	
			add_action( 'wp_ajax_nopriv_delete-custom-item-child', array( &$custom_menu, 'delete_custom_item_child' ) );
			add_action( 'wp_ajax_delete-custom-item-child', array( &$custom_menu, 'delete_custom_item_child' ) );

			add_action( 'wp_ajax_nopriv_get-adminbar-sample-styles', array( &$css_formatter, 'get_adminbar_sample_styles' ) );
			add_action( 'wp_ajax_get-adminbar-sample-styles', array( &$css_formatter, 'get_adminbar_sample_styles' ) );
			
		}
		
		add_filter( 'media_upload_tabs', array( $this, 'remove_media_library_tab' ) );


	}

	public function init_options() {
	
		global $wpaioab_options;
		
		$wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable'] = (isset($wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable'])) ? $wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable'] :'';
		$wpaioab_options['wpaioab_menu_item_shadow_status'] = (isset($wpaioab_options['wpaioab_menu_item_shadow_status'])) ? $wpaioab_options['wpaioab_menu_item_shadow_status'] :'';
		$wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable'] = (isset($wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable'])) ? $wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable'] :'';
		$wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable'] = (isset($wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable'])) ? $wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable'] :'';
		$wpaioab_options['wpaioab_hide_notification_enable'] = (isset($wpaioab_options['wpaioab_hide_notification_enable'])) ? $wpaioab_options['wpaioab_hide_notification_enable'] :'';
		$wpaioab_options['wpaioab_menu_text_shadow_color_enable'] = (isset($wpaioab_options['wpaioab_menu_text_shadow_color_enable'])) ? $wpaioab_options['wpaioab_menu_text_shadow_color_enable'] :'';
		$wpaioab_options['wpaioab_menu_shadow_status'] = (isset($wpaioab_options['wpaioab_menu_shadow_status'])) ? $wpaioab_options['wpaioab_menu_shadow_status'] :'';
		$wpaioab_options['wpaioab_search_text_shadow_color_enable'] = (isset($wpaioab_options['wpaioab_search_text_shadow_color_enable'])) ? $wpaioab_options['wpaioab_search_text_shadow_color_enable'] :'';
		$wpaioab_options['wpaioab_merge_menu_styles'] = (isset($wpaioab_options['wpaioab_merge_menu_styles'])) ? $wpaioab_options['wpaioab_merge_menu_styles'] :'';
		$wpaioab_options['wpaioab_merge_rtmedia_styles'] = (isset($wpaioab_options['wpaioab_merge_rtmedia_styles'])) ? $wpaioab_options['wpaioab_merge_rtmedia_styles'] :'';		
		$wpaioab_options['wpaioab_move_to_bottom'] = (isset($wpaioab_options['wpaioab_move_to_bottom'])) ? $wpaioab_options['wpaioab_move_to_bottom'] :'';
		$wpaioab_options['wpaioab_toggle_hide_status'] = (isset($wpaioab_options['wpaioab_toggle_hide_status'])) ? $wpaioab_options['wpaioab_toggle_hide_status'] :'';
		$wpaioab_options['wpaioab_enable_auto_hide_mobile'] = (isset($wpaioab_options['wpaioab_enable_auto_hide_mobile'])) ? $wpaioab_options['wpaioab_enable_auto_hide_mobile'] :'';

		
		$wpaioab_options['custom_root_labels'] = (isset($wpaioab_options['custom_root_labels'])) ? $wpaioab_options['custom_root_labels'] :array();
		$wpaioab_options['custom_root_urls'] = (isset($wpaioab_options['custom_root_urls'])) ? $wpaioab_options['custom_root_urls'] :array();
		$wpaioab_options['custom_root_images'] = (isset($wpaioab_options['custom_root_images'])) ? $wpaioab_options['custom_root_images'] :array();
		$wpaioab_options['custom_root_image_sizes'] = (isset($wpaioab_options['custom_root_image_sizes'])) ? $wpaioab_options['custom_root_image_sizes'] :array();
		$wpaioab_options['custom_menu_visibility'] = (isset($wpaioab_options['custom_menu_visibility'])) ? $wpaioab_options['custom_menu_visibility'] :array();
		$wpaioab_options['custom_item_labels'] = (isset($wpaioab_options['custom_item_labels'])) ? $wpaioab_options['custom_item_labels'] :array();
		$wpaioab_options['custom_item_urls'] = (isset($wpaioab_options['custom_item_urls'])) ? $wpaioab_options['custom_item_urls'] :array();

		if(is_plugin_active('buddypress/bp-loader.php')){
		
			$wpaioab_options['wpaioab_buddypress_menu_color'] = (isset($wpaioab_options['wpaioab_buddypress_menu_color'])) ? $wpaioab_options['wpaioab_buddypress_menu_color'] :'#4B4B4B';
			$wpaioab_options['wpaioab_sub_menu_color'] = (isset($wpaioab_options['wpaioab_sub_menu_color'])) ? $wpaioab_options['wpaioab_sub_menu_color'] :'#4B4B4B';
			$wpaioab_options['wpaioab_bp_before_notification_text_color'] = (isset($wpaioab_options['wpaioab_bp_before_notification_text_color'])) ? $wpaioab_options['wpaioab_bp_before_notification_text_color'] :'#333333';
			$wpaioab_options['wpaioab_bp_before_notification_bg_color'] = (isset($wpaioab_options['wpaioab_bp_before_notification_bg_color'])) ? $wpaioab_options['wpaioab_bp_before_notification_bg_color'] :'#DDDDDD';
			$wpaioab_options['wpaioab_bp_notification_bg_color'] = (isset($wpaioab_options['wpaioab_bp_notification_bg_color'])) ? $wpaioab_options['wpaioab_bp_notification_bg_color'] :'#1FB3DD';
			$wpaioab_options['wpaioab_bp_notification_text_color'] = (isset($wpaioab_options['wpaioab_bp_notification_text_color'])) ? $wpaioab_options['wpaioab_bp_notification_text_color'] :'#FFFFFF';
			$wpaioab_options['wpaioab_notification_bg_image'] = (isset($wpaioab_options['wpaioab_notification_bg_image'])) ? $wpaioab_options['wpaioab_notification_bg_image'] :'';
			$wpaioab_options['wpaioab_bp_message_count_text_color'] = (isset($wpaioab_options['wpaioab_bp_message_count_text_color'])) ? $wpaioab_options['wpaioab_bp_message_count_text_color'] :'#DDDDDD';
			$wpaioab_options['wpaioab_bp_message_count_bg_color'] = (isset($wpaioab_options['wpaioab_bp_message_count_bg_color'])) ? $wpaioab_options['wpaioab_bp_message_count_bg_color'] :'#0074A2';
		
		}

		update_option('wpaioab_settings', $wpaioab_options);
		
	}
	

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
		
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Wordpress_All_In_One_Adminbar::VERSION );
			wp_enqueue_style( $this->plugin_slug .'-jquery-ui-styles', plugins_url( 'assets/css/jquery-ui-styles.css', __FILE__ ), array(), Wordpress_All_In_One_Adminbar::VERSION );

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style('thickbox');

		}

	}

	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
		
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script ('jquery-ui-tabs');		
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');		
		wp_enqueue_script( $this->plugin_slug . 'media-upload', plugins_url( 'assets/js/media-admin-script.js', __FILE__ ), array('jquery','media-upload','thickbox'), Wordpress_All_In_One_Adminbar::VERSION );
		wp_enqueue_script( 'custom-menu', plugins_url( 'assets/js/custom-menu.js', __FILE__ ), array( 'jquery' ), Wordpress_All_In_One_Adminbar::VERSION  );
		wp_localize_script( 'custom-menu', 'CustomMenu', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce' => wp_create_nonce( 'custom-menu-nonce' )
		) );
		}

	}

	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Wordpress All In One Adminbar', $this->plugin_slug ),
			__( 'WPAIO Adminbar', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	public function wpaioab_register_settings() {

		register_setting('wpaioab_settings_group','wpaioab_settings');
	}

	
	function remove_media_library_tab($tabs) {
	
		unset($tabs['type_url']);
		return $tabs;
		
	}


}

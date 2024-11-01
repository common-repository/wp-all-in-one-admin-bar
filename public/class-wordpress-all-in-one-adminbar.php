<?php

class Wordpress_All_In_One_Adminbar {

	const VERSION = '1.1';

	protected $plugin_slug = 'wp-all-in-one-admin-bar';

	protected static $instance = null;

	private function __construct() {
		global $wpaioab_options;
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );


		add_action( 'init', array( $this, 'change_the_visibility_of_admin_bar' ), 20);
		
		$wpaioab_auto_hide = Wordpress_All_In_One_Adminbar_Auto_Hide::get_instance();
		$css_formater = Wordpress_All_In_One_CSS_Formater::get_instance();
		
		
		if ( is_admin() ) {
		
			add_action( 'wp_ajax_nopriv_wpaioab-auto-hide', array( &$wpaioab_auto_hide, 'wpaioab_auto_hide_call' ) );
			add_action( 'wp_ajax_wpaioab-auto-hide', array( &$wpaioab_auto_hide, 'wpaioab_auto_hide_call' ) );
		
			if(isset($wpaioab_options['wpaioab_apply_changes_status']) && $wpaioab_options['wpaioab_apply_changes_status'] != 1){
				add_action( 'admin_head', array( $css_formater, 'change_adminbar_colors' ));			
				$this->apply_adminbar_changes();	
			}
		}

		if ( !is_admin() ) {
		
			if(isset($wpaioab_options['wpaioab_apply_changes_status']) && $wpaioab_options['wpaioab_apply_changes_status'] != 3){
				add_action( 'wp_head', array( $css_formater, 'change_adminbar_colors' ));
				$this->apply_adminbar_changes();	
			}
			
			if(isset($wpaioab_options['wpaioab_toggle_hide_status']) && $wpaioab_options['wpaioab_toggle_hide_status'] == 1){
				add_action('wp_before_admin_bar_render', array( &$this, 'before_admin_bar_render' ), 99);
				add_action('wp_after_admin_bar_render', array( &$this, 'after_admin_bar_render' ), 99);
			}
						
		}

	}
	
	private function apply_adminbar_changes(){
		global $wpaioab_options;
		
		$adminbar_customizer = Wordpress_All_In_One_Adminbar_Customizer::get_instance();
			if(isset($wpaioab_options['wpaioab_menu_action_hook'])){			
				add_action( $wpaioab_options['wpaioab_menu_action_hook'], array( $adminbar_customizer, 'customize_admin_bar' ));				
			}			
		add_action( 'wp_before_admin_bar_render', array( $adminbar_customizer, 'hide_adminbar_links' ),20);
		
	}

	public function before_admin_bar_render() {
		ob_start();
	}

	public function after_admin_bar_render() {
	
		$html_skeleton = ob_get_clean();
		$default_bar = '" role="navigation">';
		
			$default_bar = str_replace('" role="navigation">', ' toggle_content" role="navigation">', $default_bar);

		$html_skeleton = str_replace('" role="navigation">', $default_bar, $html_skeleton);
		echo $html_skeleton;
		
	}

	function change_the_visibility_of_admin_bar() {
	
		global $wpaioab_options;
		
		$current_user = wp_get_current_user();
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);

			if(isset($wpaioab_options['wpaioab_'. str_replace(' ', '', strtolower($user_role))])){
					add_filter('show_admin_bar', '__return_false');
			}

	}

	function get_current_user_role(){	
		return $user_role;
	}

	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	private static function get_blog_ids() {

		global $wpdb;

		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	private static function single_activate() {

	}

	private static function single_deactivate() {

	}

	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}


	public function enqueue_scripts() {
		global $wpaioab_options;
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-hoverintent', plugins_url( 'assets/js/jquery.hoverIntent.minified.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		wp_enqueue_script('jquery-cookie', plugins_url( 'assets/js/jquery.cookie.js', __FILE__ ), array( 'jquery' ), self::VERSION );


			if(($wpaioab_options['wpaioab_move_to_bottom'] == 1) && $wpaioab_options['wpaioab_toggle_hide_status'] == 1){
			
				wp_enqueue_script( $this->plugin_slug . '-toggle-down-script', plugins_url( 'assets/js/toggle-down.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			
			} else if(!($wpaioab_options['wpaioab_move_to_bottom'] == 1) && $wpaioab_options['wpaioab_toggle_hide_status'] == 1){
				
				wp_enqueue_script( $this->plugin_slug . '-toggle-up-script', plugins_url( 'assets/js/toggle-up.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			
			}

			
			if(($wpaioab_options['wpaioab_move_to_bottom'] == 1) && $wpaioab_options['wpaioab_toggle_hide_status'] == 0){
				
				wp_enqueue_script( $this->plugin_slug . '-bottom-bar-script', plugins_url( 'assets/js/stick-bottom.js', __FILE__ ), array( 'jquery' ), self::VERSION );
				
			}

		
		if(isset($wpaioab_options['wpaioab_toggle_hide_status']) && $wpaioab_options['wpaioab_toggle_hide_status'] == 2){
			if($wpaioab_options['wpaioab_move_to_bottom']){
			
				wp_enqueue_script( $this->plugin_slug . '-wpaioab-auto-hide', plugins_url( 'assets/js/auto-hide-bottom.js', __FILE__ ), array( 'jquery' ) );
				wp_localize_script( $this->plugin_slug . '-wpaioab-auto-hide', 'Wordpress_All_In_One_Adminbar_Auto_Hide', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce' => wp_create_nonce( 'wpaioab-auto-hide-nonce' )
				) );
				
			}else{
			
				wp_enqueue_script( $this->plugin_slug . '-wpaioab-auto-hide', plugins_url( 'assets/js/auto-hide-up.js', __FILE__ ), array( 'jquery' ) );
				wp_localize_script( $this->plugin_slug . '-wpaioab-auto-hide', 'Wordpress_All_In_One_Adminbar_Auto_Hide', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce' => wp_create_nonce( 'wpaioab-auto-hide-nonce' )
				) );
				
			}
		}

	}


}

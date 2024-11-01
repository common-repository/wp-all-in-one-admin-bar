<?php

 class Wordpress_All_In_One_Adminbar_Customizer {

	protected static $instance = null;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	
	public function customize_admin_bar() {
		$this->add_menu_to_adminbar();
	}

	public function hide_adminbar_links() {
	
	 global $wp_admin_bar;
	 global $wpaioab_options;
	 global $adminbar_links;
		 
		 if (is_user_logged_in()) {
			 $my_account = $wp_admin_bar->get_node('my-account');
			 if(isset($wpaioab_options['wpaioab_greeting_message'])){
			 
				$newtitle = str_replace( 'Howdy,', $wpaioab_options['wpaioab_greeting_message'], $my_account->title );
				$wp_admin_bar->add_node( array(
									 'id' => 'my-account',
									 'title' => $newtitle,
									 ) );
			 }
		}
		reset($adminbar_links);
		while (list($key, $val) = each($adminbar_links)) {
			if(isset($wpaioab_options[$key])){		
								 
				switch ($key) {
				
				case 'wp-logo':
					$wp_admin_bar->remove_menu('wp-logo');
					break;
				case 'about':
					$wp_admin_bar->remove_menu('about');
					break;							 
				case 'wporg':
					$wp_admin_bar->remove_menu('wporg');
					break;
				case 'documentation':
					$wp_admin_bar->remove_menu('documentation');
					break;
				case 'support-forums':
					$wp_admin_bar->remove_menu('support-forums');
					break;
				case 'feedback':
					$wp_admin_bar->remove_menu('feedback');
					break;
				case 'site-name':
					$wp_admin_bar->remove_menu('site-name');
					break;
				case 'view-site':
					$wp_admin_bar->remove_menu('view-site');
					break;
				case 'updates':
					$wp_admin_bar->remove_menu('updates');
					break;
				case 'comments':
					$wp_admin_bar->remove_menu('comments');
					break;	
				case 'new-content':
					$wp_admin_bar->remove_menu('new-content');
					break;						
				case 'my-account':
					$wp_admin_bar->remove_menu('my-account');
					break;	
				case 'search':
					$wp_admin_bar->remove_menu('search');
					break;
				case 'dashboard':
					$wp_admin_bar->remove_menu('dashboard');
					break;
				case 'themes':
					$wp_admin_bar->remove_menu('themes');
					break;
				case 'widgets':
					$wp_admin_bar->remove_menu('widgets');
					break;	
				case 'menus':
					$wp_admin_bar->remove_menu('menus');
					break;					
				case 'new-post':
					$wp_admin_bar->remove_menu('new-post');
					break;
				case 'new-media':
					$wp_admin_bar->remove_menu('new-media');
					break;
				case 'new-link':
					$wp_admin_bar->remove_menu('new-link');
					break;					
				case 'new-page':
					$wp_admin_bar->remove_menu('new-page');
					break;
				case 'new-user':
					$wp_admin_bar->remove_menu('new-user');
					break;	
				case 'user-actions':
					$wp_admin_bar->remove_menu('user-actions');
					break;	
				case 'user-info':
					$wp_admin_bar->remove_menu('user-info');
					break;	
				case 'edit-profile':
					$wp_admin_bar->remove_menu('edit-profile');
					break;	
				case 'logout':
					$wp_admin_bar->remove_menu('logout');
					break;	
				case 'my-sites':
					$wp_admin_bar->remove_menu('my-sites');
					break;										
				case 'my-account-activity':
					$wp_admin_bar->remove_menu('my-account-activity');
					break;					
				case 'my-account-xprofile':
					$wp_admin_bar->remove_menu('my-account-xprofile');
					break;	
				case 'my-account-notifications':
					$wp_admin_bar->remove_menu('my-account-notifications');
					break;
				case 'my-account-messages':
					$wp_admin_bar->remove_menu('my-account-messages');
					break;
				case 'my-account-friends':
					$wp_admin_bar->remove_menu('my-account-friends');
					break;
				case 'my-account-groups':
					$wp_admin_bar->remove_menu('my-account-groups');
					break;
				case 'my-account-settings':
					$wp_admin_bar->remove_menu('my-account-settings');
					break;
				case 'my-account-blogs':
					$wp_admin_bar->remove_menu('my-account-blogs');
					break;					
				case 'my-account-links':
					$wp_admin_bar->remove_menu('my-account-links');
					break;
				case 'my-account-follow':
					$wp_admin_bar->remove_menu('my-account-follow');
					break;	
				case 'my-em-events':
					$wp_admin_bar->remove_menu('my-em-events');
					break;	
				case 'my-account-media':
					$wp_admin_bar->remove_menu('my-account-media');
					break;						
				case 'bp-login':
					$wp_admin_bar->remove_menu('bp-login');
					break;	
				case 'bp-register':
					$wp_admin_bar->remove_menu('bp-register');
					break;	
				case 'w3tc':
					$wp_admin_bar->remove_menu('w3tc');	
					break;	
				case 'my-account-forums':
					$wp_admin_bar->remove_menu('my-account-forums');
					break;	
				case 'wpseo-menu':
					$wp_admin_bar->remove_menu('wpseo-menu');
					break;
				case 'new-forum':
					$wp_admin_bar->remove_menu('new-forum');
					break;
				case 'new-topic':
					$wp_admin_bar->remove_menu('new-topic');
					break;
				case 'new-reply':
					$wp_admin_bar->remove_menu('new-reply');
					break;
				case 'new-event':
					$wp_admin_bar->remove_menu('new-event');
					break;	
				case 'new-location':
					$wp_admin_bar->remove_menu('new-location');
					break;	
				case 'new-event-recurring':
					$wp_admin_bar->remove_menu('new-event-recurring');
					break;						
				}							 
										 
			}				 
		}

	}

	private function add_wp_menu_to_adminbar(){
	
	 global $wp_admin_bar;
	 global $wpaioab_options;
	 $menus = get_terms('nav_menu');
	 
		foreach($menus as $menu){
			
			if(isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name)])){
			
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			$menu_parent = $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location'];
			
			$menu_custom_location = $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location_custom'];
			if($menu_parent =='custom' && isset($menu_custom_location) && !empty($menu_custom_location)){
				
				$custom_parent = uniqid(strtolower($menu_custom_location));
				$menu_title_image = $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'image'];
				$menu_title_image_size =$wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'menu_icon_image_size'];
				
					if(isset($menu_title_image) && !empty($menu_title_image)){
						$menu_custom_location = "<span style='float:left;'><img style='$menu_title_image_size; vertical-align:top;' src=$menu_title_image /></span>$menu_custom_location";
					}
				
				$menu_custom_location_url = $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location_custom_url'];
				$menu_custom_location_url = (!empty($menu_custom_location_url)) ? $menu_custom_location_url : '#';
				
				$this->add_custom_root_menu($menu_custom_location, $custom_parent, $menu_custom_location_url, $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'user_status']);

			}else{
			
				$custom_parent = $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location'];
				
			}

				foreach( (array) $menu_items as $key => $menu_item ) {

					if( $menu_item->menu_item_parent ) {

						$wp_admin_bar->add_menu(
							array(
							'id' 		=> $menu_item->ID,
							'parent' 	=> $menu_item->menu_item_parent, 
							'title' 	=> $menu_item->title,
							'href' 		=> $menu_item->url
							)
						);

					} else {
					
						$wp_admin_bar->add_menu(
							array(
							'id' 		=> $menu_item->ID,
							'parent' 	=> $custom_parent,
							'title' 	=> $menu_item->title,
							'href' 		=> $menu_item->url
							)
						);
					}
				} 
			}
		}

	
	}
	
	private function add_custom_menu_to_adminbar(){
	
	global $wp_admin_bar;
	global $wpaioab_options;
	
	$custom_root_labels = $wpaioab_options['custom_root_labels'];
	$custom_root_urls = $wpaioab_options['custom_root_urls'];
	$custom_root_images = $wpaioab_options['custom_root_images'];
	$custom_root_image_sizes = $wpaioab_options['custom_root_image_sizes'];
	$custom_menu_visibility = $wpaioab_options['custom_menu_visibility'];
		
	$custom_item_labels = $wpaioab_options['custom_item_labels'];
	$custom_item_urls = $wpaioab_options['custom_item_urls'];
	
		if(isset($wpaioab_options['custom_child_labels'])){	
			$custom_child_labels = $wpaioab_options['custom_child_labels'];
			$custom_child_urls = $wpaioab_options['custom_child_urls'];
		}
		
		if(isset($custom_root_labels)) reset($custom_root_labels);
		if(isset($custom_root_urls)) reset($custom_root_urls);	
		if(isset($custom_root_images)) reset($custom_root_images);
		if(isset($custom_root_image_sizes)) reset($custom_root_image_sizes);
		
		if(isset($custom_item_labels)) reset($custom_item_labels);
		if(isset($custom_item_urls)) reset($custom_item_urls);
		
		if(isset($custom_child_labels)) reset($custom_child_labels);
		if(isset($custom_child_urls)) reset($custom_child_urls);
		
		while (list($root_key, $root_value) = each($custom_root_labels)) {
		
			$root_id = uniqid(strtolower(str_replace(' ', '', $root_value )));
			if(!empty($custom_root_images[$root_key])){
			
				$root_value = "<span style='float:left;'><img style='$custom_root_image_sizes[$root_key]; vertical-align:top;' src=$custom_root_images[$root_key] /></span>$root_value";
			}
			$menu_custom_url = (!empty($custom_root_urls[$root_key])) ? $custom_root_urls[$root_key] : '#';
			$this->add_custom_root_menu($root_value, $root_id, $menu_custom_url, $custom_menu_visibility[$root_key]);
				
				if(isset($custom_item_labels) && (array_key_exists ($root_key, $custom_item_labels))){
				
					$current_menu_item_labels = $custom_item_labels[$root_key];
					$current_menu_item_urls = $custom_item_urls[$root_key];
					reset($current_menu_item_labels);
					reset($current_menu_item_urls);
					
						while (list($item_label_key, $item_label_value) = each($current_menu_item_labels)) {
						
							$item_id = uniqid(strtolower(str_replace(' ', '', $item_label_value )));
							$this->add_custom_sub_menu($item_label_value, $current_menu_item_urls[$item_label_key], $root_id, $item_id, $meta = FALSE);
						
							if (isset($custom_child_labels) && array_key_exists($root_key, $custom_child_labels) && array_key_exists($item_label_key, $custom_child_labels[$root_key])){
									
								$current_item_child_labels = $custom_child_labels[$root_key][$item_label_key];
								$current_item_child_urls = $custom_child_urls[$root_key][$item_label_key];
								
									while (list($child_item_label_key, $child_item_label_value) = each($current_item_child_labels)) {
									
										$child_id = uniqid(strtolower(str_replace(' ', '', $child_item_label_value )));
										$this->add_custom_sub_menu($child_item_label_value, $current_item_child_urls[$child_item_label_key], $item_id, $child_id, $meta = FALSE);
										
									}
							}		

						}
				}
		}

	}

	  private function add_custom_sub_menu($name, $link, $root_menu, $id, $meta = FALSE){
	  
      global $wp_admin_bar;

		  $wp_admin_bar->add_menu( array(
			  'parent' => $root_menu,
			  'id' => $id,
			  'title' => $name,
			  'href' => $link,
			  'meta' => $meta
		  ) );
	}

		public function add_menu_to_adminbar(){
		
			$this->add_custom_menu_to_adminbar();
			$this->add_wp_menu_to_adminbar();

		}

		function add_custom_root_menu($name, $id, $href, $menu_user_status){
		
			global $wp_admin_bar;

			if ( (!is_super_admin() || !is_admin_bar_showing()) && is_user_logged_in() && $menu_user_status == 3){
				return;
			} else if ( (!is_super_admin() || !is_admin_bar_showing()) && !is_user_logged_in() && $menu_user_status == 2) {
				return;	
			} else {
				$wp_admin_bar->add_menu( array(
					'id'   => $id,
					'title' => $name,
					'href' => $href ) );
		    }
		  }
	
}
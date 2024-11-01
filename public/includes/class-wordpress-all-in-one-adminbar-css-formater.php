<?php

 class Wordpress_All_In_One_CSS_Formater {

	protected static $instance = null;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
 	function change_adminbar_background() {
	
		global $wpaioab_options;
		
		$css_code_snippet = "#wpadminbar {";
		if(isset($wpaioab_options['wpaioab_adminbar_bg_image']) && !empty($wpaioab_options['wpaioab_adminbar_bg_image'])){
			
			$css_code_snippet .=	"background-image:url($wpaioab_options[wpaioab_adminbar_bg_image]);
									background-repeat: $wpaioab_options[wpaioab_adminbar_bg_image_repeat];
									background-size: auto;";
									
		}else if ($wpaioab_options['wpaioab_gradient_current_status']==2) {
			
			$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_adminbar_color'],$wpaioab_options['wpaioab_adminbar_bottom_shadow'],$wpaioab_options['wpaioab_adminbar_style_pattern']);
			
		} else{
			$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_adminbar_color']);
		}
			$css_code_snippet .= ';}';	
			
		return $css_code_snippet;
	}

	function change_menu() {
	
		global $wpaioab_options;
		
		$css_code_snippet = '
		
		#wpadminbar .quicklinks a:hover span#ab-updates,
		#wpadminbar .menupop .ab-sub-wrapper,
		#wpadminbar .shortlink-input {';
			
				if(isset($wpaioab_options['wpaioab_admin_menu_bg_image']) && !empty($wpaioab_options['wpaioab_admin_menu_bg_image'])){
					$css_code_snippet .= $this->change_background_image($wpaioab_options['wpaioab_admin_menu_bg_image'], $wpaioab_options['wpaioab_admin_menu_bg_image_repeat']);
				} else if ($wpaioab_options['wpaioab_gradient_current_status']==2) { 
					$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_toolbar_menu_color'],$wpaioab_options['wpaioab_toolbar_menu_secondry_color'],$wpaioab_options['wpaioab_toolbar_menu_style_pattern']);
				} else{
					$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_toolbar_menu_color']);
				}
				
				
				$css_code_snippet .= ';}';
				
		return $css_code_snippet; 
	}	
	
	function change_menu_shadow(){
	
	global $wpaioab_options;
	
		switch ($wpaioab_options['wpaioab_menu_shadow_type']) {
			
			case 1:
				$css_code_snippet =	"#wp-admin-bar-root-default .menupop .ab-sub-wrapper, #wp-admin-bar-root-default .shortlink-input, ";
				$css_code_snippet .= $this->change_right_menu_shadow($wpaioab_options['wpaioab_menu_shadow_strength'] , $wpaioab_options['wpaioab_menu_shadows_color']);
				break;
				
			case 2:
				$css_code_snippet = "#wp-admin-bar-top-secondary .menupop .ab-sub-wrapper, #wp-admin-bar-top-secondary .shortlink-input, ";
				$css_code_snippet .=  $this->change_left_menu_shadow($wpaioab_options['wpaioab_menu_shadow_strength'] , $wpaioab_options['wpaioab_menu_shadows_color']);
				break;
				
			case 3:
				$css_code_snippet = $this->change_right_menu_shadow($wpaioab_options['wpaioab_menu_shadow_strength'] , $wpaioab_options['wpaioab_menu_shadows_color']);
				$css_code_snippet .=  $this->change_left_menu_shadow($wpaioab_options['wpaioab_menu_shadow_strength'] , $wpaioab_options['wpaioab_menu_shadows_color']);
				break;	
		
		}
	 return $css_code_snippet;
	}
	
	function change_right_menu_shadow($shadows_strength, $shadows_color) {
	return "#wp-admin-bar-top-secondary .menupop .ab-sub-wrapper, #wp-admin-bar-top-secondary .shortlink-input {
				-moz-box-shadow: -$shadows_strength $shadows_color;
				-webkit-box-shadow: -$shadows_strength $shadows_color;
				box-shadow: -$shadows_strength $shadows_color;
			}";
	}
	
	function change_left_menu_shadow($shadows_strength, $shadows_color) {
	return "#wp-admin-bar-root-default .menupop .ab-sub-wrapper, #wp-admin-bar-root-default .shortlink-input {
				-moz-box-shadow: $shadows_strength $shadows_color;
				-webkit-box-shadow: $shadows_strength $shadows_color;
				box-shadow: $shadows_strength $shadows_color;
			}";
	}
	
	
	function change_menu_item() {
	
		global $wpaioab_options;
		
		$css_code_snippet = "#wpadminbar .quicklinks .menupop ul li .ab-item:hover,
							#wpadminbar .quicklinks .menupop ul li a strong, 
							#wpadminbar .quicklinks .menupop.hover ul li .ab-item:hover,
							#wpadminbar.nojs .quicklinks .menupop:hover ul li .ab-item:hover,
							#wpadminbar .shortlink-input {
							color: $wpaioab_options[wpaioab_menu_text_hover_color];";
			$css_code_snippet .= $this->change_font_shadow_effect($wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable'], $wpaioab_options['wpaioab_menu_text_hover_shadow_color']);		
			
			$css_code_snippet .= '} #wpadminbar .quicklinks .menupop ul li .ab-item:hover{';
			
			if($wpaioab_options['wpaioab_menu_item_shadow_status']){ $css_code_snippet .= $this->change_menu_item_shadow($wpaioab_options['wpaioab_menu_item_shadows_color'], $wpaioab_options['wpaioab_menu_item_shadow_strength']);}
			
			$css_code_snippet .= ';} #wpadminbar .menupop li:hover {';
			
			if(isset($wpaioab_options['wpaioab_menu_item_bg_image']) && !empty($wpaioab_options['wpaioab_menu_item_bg_image']) ){
				$css_code_snippet .= $this->change_background_image($wpaioab_options['wpaioab_menu_item_bg_image'], $wpaioab_options['wpaioab_menu_item_bg_image_repeat']);
			} else if ($wpaioab_options['wpaioab_gradient_current_status']==2) {
				$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_menu_hover_color'],$wpaioab_options['wpaioab_menu_hover_secondry_color'],$wpaioab_options['wpaioab_menu_hover_style_pattern']);
			} else {
				$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_menu_hover_color']);
			}
			$css_code_snippet .= ';}';

		return $css_code_snippet;
	}

	
	function change_buddypress_menu_section(){
	
		global $wpaioab_options;
	
		$css_code_snippet = '#wpadminbar .quicklinks .menupop ul.ab-sub-secondary';
		
			if($wpaioab_options['wpaioab_merge_rtmedia_styles'] == 1){
					$css_code_snippet .= ', #wpadminbar .quicklinks .menupop ul#wp-admin-bar-my-account-default';
			}

		$css_code_snippet .= '{';
	
		if($wpaioab_options['wpaioab_merge_menu_styles']){		
			$css_code_snippet .= "background : transparent;";
		} else {
		
			 if( isset($wpaioab_options['wpaioab_bp_menu_bg_image']) && !empty($wpaioab_options['wpaioab_bp_menu_bg_image']) ) {
				$css_code_snippet .= $this->change_background_image($wpaioab_options['wpaioab_bp_menu_bg_image'], $wpaioab_options['wpaioab_bp_menu_bg_image_repeat']); 
			 } else if ($wpaioab_options['wpaioab_gradient_current_status']==2) { 
				$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_buddypress_menu_color'],$wpaioab_options['wpaioab_buddypress_menu_secondry_color'], $wpaioab_options['wpaioab_buddypress_menu_color_style_pattern']);
			 } else {
				$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_buddypress_menu_color']);
			 }
			 
		} 
		return $css_code_snippet .= '}';	
	
	}
	
	function change_buddypress_submenu_section(){
	
		global $wpaioab_options;
	
		$css_code_snippet = '#wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu{';
		if( isset($wpaioab_options['wpaioab_bp_submenu_bg_image']) && !empty($wpaioab_options['wpaioab_bp_submenu_bg_image']) ) {
			$css_code_snippet .= $this->change_background_image($wpaioab_options['wpaioab_bp_submenu_bg_image'], $wpaioab_options['wpaioab_bp_submenu_bg_image_repeat']); 
		} else if ($wpaioab_options['wpaioab_gradient_current_status']==2) {
			$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_sub_menu_color'],$wpaioab_options['wpaioab_sub_menu_secondry_color'],$wpaioab_options['wpaioab_sub_menu_color_style_pattern']);
		} else {
			$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_sub_menu_color']);
		}
		
	return $css_code_snippet .= '}';	
	
	}
	
	function change_menu_text(){
	
		global $wpaioab_options;
	
		$css_code_snippet = "#wpadminbar .quicklinks .menupop ul li a, 
							#wpadminbar .quicklinks .menupop ul li a strong, 
							#wpadminbar .quicklinks .menupop.hover ul li a, 
							#wpadminbar #wp-admin-bar-user-info .username,
							#wpadminbar.nojs .quicklinks .menupop:hover ul li a {
							color: $wpaioab_options[wpaioab_menu_text_color];";
		$css_code_snippet .= $this->change_font_shadow_effect($wpaioab_options['wpaioab_menu_text_shadow_color_enable'], $wpaioab_options['wpaioab_menu_text_shadow_color']).';}';		
		
		return $css_code_snippet;	
	
	}
	
		
	function change_adminbar_links_text(){
	
		global $wpaioab_options;
		
		$css_code_snippet = "#wpadminbar a.ab-item, 
		#wpadminbar > #wp-toolbar span.ab-label, 
		#wpadminbar > #wp-toolbar span.noticon, 
		#wpadminbar > #wp-toolbar div.ab-item
		{
		color: $wpaioab_options[wpaioab_toolbarlinks_text_color];";
		$css_code_snippet .= $this->change_font_shadow_effect($wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable'], $wpaioab_options['wpaioab_toolbarlinks_text_shadow_color']);		
	return $css_code_snippet .= ';}';	
	
	}
	
	function change_adminbar_links_hover(){
	
		global $wpaioab_options;
	
		$css_code_snippet = "#wpadminbar .ab-top-menu > li:hover > .ab-item, 
							#wpadminbar .ab-top-menu > li.hover > .ab-item,
							#wpadminbar .ab-top-menu > li > .ab-item:focus,
							#wpadminbar > #wp-toolbar li:hover span.ab-label, 
							wpadminbar > #wp-toolbar li.hover span.ab-label, 
							#wpadminbar > #wp-toolbar a.focus span.ab-label, 
							#wpadminbar > #wp-toolbar div.ab-item:hover {
							color: $wpaioab_options[wpaioab_toolbarlinks_text_hover_color];";
		if( isset($wpaioab_options['wpaioab_menu_parent_bg_image']) && !empty($wpaioab_options['wpaioab_menu_parent_bg_image']) ){
				$css_code_snippet .= $this->change_background_image($wpaioab_options['wpaioab_menu_parent_bg_image'], $wpaioab_options['wpaioab_menu_parent_bg_image_repeat']);
			} else if ($wpaioab_options['wpaioab_gradient_current_status']==2) {  
				$css_code_snippet .= $this->change_background_color($wpaioab_options['wpaioab_menu_parent_color'],$wpaioab_options['wpaioab_menu_parent_secondry_color'],$wpaioab_options['wpaioab_menu_parent_style_pattern']);
			} else {
				$css_code_snippet .= $this->change_background_color_only($wpaioab_options['wpaioab_menu_parent_color']);
			}
		$css_code_snippet .= $this->change_font_shadow_effect($wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable'], $wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color']);		
	
	return $css_code_snippet .= ';}';	
	
	}
	
	function change_icon_color(){
	
		global $wpaioab_options;
		
		return  "#wpadminbar .ab-icon:before, #wpadminbar .ab-item:before, #wpadminbar #adminbarsearch:before {
		color: $wpaioab_options[wpaioab_icon_color]; text-shadow:none;} ";		
	}

	
	function change_icon_hover_color(){
	
		global $wpaioab_options;
		return " 
		#wpadminbar li:hover .ab-icon:before, #wpadminbar li:hover 
		.ab-item:before, #wpadminbar li a:focus .ab-icon:before, 
		#wpadminbar li .ab-item:focus:before, #wpadminbar li.hover 
		.ab-icon:before, #wpadminbar li.hover .ab-item:before, 
		#wpadminbar li:hover #adminbarsearch:before
		{
			color: $wpaioab_options[wpaioab_icon_hover_color]; 
			
		}";
	}
	
	function change_searchbox_text_color(){
	
		global $wpaioab_options;
	
					
			$css_code_snippet = "#adminbarsearch .adminbar-input {
				color: $wpaioab_options[wpaioab_search_text_color] !important;"; 
				$css_code_snippet .= $this->change_font_shadow_effect($wpaioab_options['wpaioab_search_text_shadow_color_enable'], $wpaioab_options['wpaioab_search_text_shadow_color']);		
	    return  $css_code_snippet .= ';}'; 

	}
		
	function change_buddypress_before_notifications(){
	
		global $wpaioab_options;
		
			return  "#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications:hover #ab-pending-notifications, 			
			#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications {
						color: $wpaioab_options[wpaioab_bp_before_notification_text_color];
						background: none repeat scroll 0 0 $wpaioab_options[wpaioab_bp_before_notification_bg_color];}"; 
	}
	
	function change_buddypress_after_notifications(){
	
		global $wpaioab_options;
	
			return  "#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications.alert {
					   background: none repeat scroll 0 0 $wpaioab_options[wpaioab_bp_notification_bg_color];
					   color: $wpaioab_options[wpaioab_bp_notification_text_color]; }";
	}

	function hide_buddypress_notification(){
			return  '#wpadminbar .quicklinks li#wp-admin-bar-my-account a span.count, #wpadminbar .quicklinks li#wp-admin-bar-my-account-with-avatar a span.count, #wpadminbar .quicklinks li#wp-admin-bar-bp-notifications #ab-pending-notifications {
						background: transparent;
						color: transparent;
					}'; 
	}
	
	function hide_buddypress_notification_area_background(){
	
		global $wpaioab_options;
	
			return  "#wpadminbar .quicklinks li#wp-admin-bar-bp-notifications{
					background-image:url($wpaioab_options[wpaioab_notification_bg_image]);
					align:center;
					text-align:center;
					background-size: $wpaioab_options[wpaioab_notification_image_size];
					background-repeat:no-repeat;
					}"; 
	}
	
	function change_links_separator_color(){
	
		global $wpaioab_options;
	
			return  "#wpadminbar .quicklinks > ul > li {
						border-right: 1px solid $wpaioab_options[wpaioab_border_right_color];
					}

					#wpadminbar .quicklinks > ul > li > a,
					#wpadminbar .quicklinks > ul > li > .ab-empty-item {
						border-right: 1px solid $wpaioab_options[wpaioab_border_left_color];
					}

					#wpadminbar .quicklinks > ul > li.opposite,
					#wpadminbar .quicklinks .top-secondary > li,
					#wpadminbar .quicklinks .ab-top-secondary > li {
						border-left: 1px solid $wpaioab_options[wpaioab_border_left_color];
						border-right: 0;
					}

					#wpadminbar .quicklinks > ul > li.opposite > a,
					#wpadminbar .quicklinks .top-secondary > li > a,
					#wpadminbar .quicklinks .ab-top-secondary > li > a,
					#wpadminbar .quicklinks .ab-top-secondary > li > .ab-empty-item {
						border-left: 1px solid $wpaioab_options[wpaioab_border_right_color];
						border-right: 0;
					}   
					
					#wpadminbar ul li:last-child,
					#wpadminbar ul li:last-child .ab-item {
						border-right: 0;
					}"; 

	}
	
	function change_the_rest(){
	
	global $wpaioab_options;
	
		return "#wp-admin-bar-top-secondary .menupop .ab-sub-wrapper #wp-admin-bar-user-info span, #wpadminbar #wp-admin-bar-user-info a:hover, #wpadminbar #wp-admin-bar-user-info .username{
				-moz-box-shadow: none;
				-webkit-box-shadow:  none;
				box-shadow:  none;
				}
				
				#wpadminbar .quicklinks .menupop ul li div .ab-item a:hover{
						background-image: none;
						background-repeat: none;
						box-shadow: none;
				}";
	}
	
	function change_message_count (){
	
		global $wpaioab_options;
	
				return "#wpadminbar .quicklinks li#wp-admin-bar-my-account a span.count, 
						#wpadminbar .quicklinks li#wp-admin-bar-my-account-with-avatar a span.count {
							color: $wpaioab_options[wpaioab_bp_message_count_text_color];
							background: none repeat scroll 0 0 $wpaioab_options[wpaioab_bp_message_count_bg_color];
						}";
				
	}
	
	private function change_font_shadow_effect($shadow_enabled,$shadow_color) {
		if($shadow_enabled){
			return "text-shadow: $shadow_color 0 -1px 0;";
		}else{
			return 'text-shadow: none;';
		}
	}
	
	private function change_background_image($background_image,$repeat_type) {
		return "background-image: url($background_image);
				background-repeat: $repeat_type;";		
	}

	
	private function change_background_color($background_color,$secondry_background_color, $gradient_pattern) {
		$css_snippet = $this->select_adminbar_style_pattern($gradient_pattern, $background_color, $secondry_background_color);
		return $css_snippet;	
	}

	private function change_background_color_only($background_color) {
		return "background: none repeat scroll 0 0 $background_color;";
	}	
	
	private function change_shadow($shadows_color, $strength){
	
				return "-moz-box-shadow: $strength $shadows_color;
						-webkit-box-shadow: $strength $shadows_color;
						box-shadow: $strength $shadows_color;";
				}
	
	
	private function change_menu_item_shadow($shadows_color, $strength){
				$shadow = str_replace('color', $shadows_color, $strength );
				return "-webkit-box-shadow: $shadow;
						-moz-box-shadow: $shadow;
						box-shadow: $shadow;";
	}
	
	private function arrange_show_hide_messages($wpaioab_options, $show_message, $hide_message){
	
			$css_snippet = '.arrow-up {}
							.arrow-down {}
							.arrow-up::before {
								content: "'.$hide_message.'";
								font-size:'.$wpaioab_options['wpaioab_toggle_label_text'].'px;
								padding: 7px;
								font-weight: '.$wpaioab_options['wpaioab_toggle_label_text_weight'].';
								color : '.$wpaioab_options['wpaioab_toggle_label_color'].';
							}
							.arrow-down::before {
								content: "'.$show_message.'";
								font-size:'.$wpaioab_options['wpaioab_toggle_label_text'].'px;
								padding: 7px;
								font-weight: '.$wpaioab_options['wpaioab_toggle_label_text_weight'].';
								color : '.$wpaioab_options['wpaioab_toggle_label_color'].';
							}';
							
			return $css_snippet;										
	}
	
	
	
	private function change_toggle_color(){
	
	global $wpaioab_options;
	
		if($wpaioab_options['wpaioab_move_to_bottom']==1){
		
			if($wpaioab_options['wpaioab_toggle_label_hide_status'] == 'Hide'){
			
				$css_snippet =	$this->arrange_show_hide_messages($wpaioab_options, $wpaioab_options['wpaioab_toggle_label_show_status'], $wpaioab_options['wpaioab_toggle_label_hide_status']);	
			
			} else {
			
				$css_snippet =	$this->arrange_show_hide_messages($wpaioab_options, $wpaioab_options['wpaioab_toggle_label_hide_status'], $wpaioab_options['wpaioab_toggle_label_show_status']);
			
			}
			
		} else {
		
				$css_snippet =	$this->arrange_show_hide_messages($wpaioab_options, $wpaioab_options['wpaioab_toggle_label_show_status'], $wpaioab_options['wpaioab_toggle_label_hide_status']);	
		
		}
			
			if($wpaioab_options['wpaioab_move_to_bottom']==1){	
			
						$css_snippet .=	'#wpadminbar #wpaioab_toggle_section {
											position:absolute;
											left:'.$wpaioab_options['wpaioab_toggle_label_alignment_staus'].'%;
											bottom:0;
											height:auto;
											line-height:auto;
											width:auto;
											margin-bottom:32px;
											margin-left:-25px;
											text-align:center;
											opacity:0;
											filter: alpha(opacity = 0);
											display:block;
											background-color:'.$wpaioab_options['wpaioab_toggle_background_color'].';
											cursor:pointer;
											border-radius: 3px 3px 0 0;
											-moz-border-radius: 3px 3px 0 0;
											-webkit-border-radius: 3px 3px 0 0;
											border-right-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';
											border-top-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';
											border-left-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';											
											border-right-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';
											border-top-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';
											border-left-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';

										}';
							
			} else {
						$css_snippet .=	'#wpadminbar #wpaioab_toggle_section {
											position:absolute;
											left:'.$wpaioab_options['wpaioab_toggle_label_alignment_staus'].'%;
											top:0;
											height:auto;
											line-height:auto;
											width:auto;
											margin-top:32px;
											margin-left:-25px;
											text-align:center;
											opacity:0;
											filter: alpha(opacity = 0);
											display:block;
											background-color:'.$wpaioab_options['wpaioab_toggle_background_color'].';
											cursor:pointer;
											border-radius: 0 0 3px 3px;
											-moz-border-radius: 0 0 3px 3px;
											-webkit-border-radius: 0 0 3px 3px;
											border-right-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';
											border-bottom-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';
											border-left-style:'.$wpaioab_options['wpaioab_toggle_outline_border'].';
											border-right-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';
											border-bottom-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';
											border-left-color:'.$wpaioab_options['wpaioab_toggle_label_color'].';

										}';
				}
							
			$css_snippet .=	'#wpadminbar #wpaioab_toggle_section:hover, #wpadminbar:hover #wpaioab_toggle_section {
								opacity:1.0;
								filter: alpha(opacity = 100);
							}';
			
		return $css_snippet;
	}
	
	
	private function select_adminbar_style_pattern($selected_pattern,$wpaioab_adminbar_color, $wpaioab_adminbar_bottom_shadow){
	$css_snippet ="";
	switch ($selected_pattern) {
	
    case 1:
		$css_snippet = "background-color:$wpaioab_adminbar_bottom_shadow;
						background-image:-ms-linear-gradient(bottom,$wpaioab_adminbar_bottom_shadow,$wpaioab_adminbar_color 8px);
						background-image:-moz-linear-gradient(bottom,$wpaioab_adminbar_bottom_shadow,$wpaioab_adminbar_color 8px);
						background-image:-o-linear-gradient(bottom,$wpaioab_adminbar_bottom_shadow,$wpaioab_adminbar_color 8px);
						background-image:-webkit-gradient(linear,left bottom,left top,from($wpaioab_adminbar_bottom_shadow),to($wpaioab_adminbar_color));
						background-image:-webkit-linear-gradient(bottom,$wpaioab_adminbar_bottom_shadow,$wpaioab_adminbar_color 8px);
						background-image:linear-gradient(bottom,$wpaioab_adminbar_bottom_shadow,$wpaioab_adminbar_color 8px);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						";
		
        break;
    case 2:
        $css_snippet = "background: $wpaioab_adminbar_bottom_shadow; 
						background: -moz-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%, $wpaioab_adminbar_color 100%); 
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,$wpaioab_adminbar_bottom_shadow), color-stop(100%,$wpaioab_adminbar_color)); 
						background: -webkit-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 100%); 
						background: -o-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 100%); 
						background: -ms-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 100%); 
						background: linear-gradient(to bottom,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_bottom_shadow', endColorstr='$wpaioab_adminbar_color',GradientType=0 ); 
						";

        break;
    case 3:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(top,  $wpaioab_adminbar_color 1%, $wpaioab_adminbar_bottom_shadow 100%, $wpaioab_adminbar_bottom_shadow 100%); 
						background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,$wpaioab_adminbar_color), color-stop(100%,$wpaioab_adminbar_bottom_shadow), color-stop(100%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(top,  $wpaioab_adminbar_color 1%,$wpaioab_adminbar_bottom_shadow 100%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -o-linear-gradient(top,  $wpaioab_adminbar_color 1%,$wpaioab_adminbar_bottom_shadow 100%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -ms-linear-gradient(top,  $wpaioab_adminbar_color 1%,$wpaioab_adminbar_bottom_shadow 100%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: linear-gradient(to bottom,  $wpaioab_adminbar_color 1%,$wpaioab_adminbar_bottom_shadow 100%,$wpaioab_adminbar_bottom_shadow 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=0 ); 
						";
        break;
	
    case 4:
        $css_snippet = "background: $wpaioab_adminbar_bottom_shadow; 
						background: -moz-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%, $wpaioab_adminbar_color 50%, $wpaioab_adminbar_color 51%, $wpaioab_adminbar_bottom_shadow 100%); 
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_color), color-stop(51%,$wpaioab_adminbar_color), color-stop(100%,#bf6e4e)); 
						background: -webkit-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_color 51%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -o-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_color 51%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -ms-linear-gradient(top,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_color 51%,$wpaioab_adminbar_color 100%); 
						background: linear-gradient(to bottom,  $wpaioab_adminbar_bottom_shadow 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_color 51%,$wpaioab_adminbar_bottom_shadow 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						" ;
        break;
		
	case 5:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(top,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_color 0%, $wpaioab_adminbar_bottom_shadow 33%, $wpaioab_adminbar_bottom_shadow 72%, $wpaioab_adminbar_color 100%); 
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,$wpaioab_adminbar_color), color-stop(0%,$wpaioab_adminbar_color), color-stop(33%,$wpaioab_adminbar_bottom_shadow), color-stop(72%,$wpaioab_adminbar_bottom_shadow), color-stop(100%,#752201)); 
						background: -webkit-linear-gradient(top, $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 72%,$wpaioab_adminbar_color 100%); 
						background: -o-linear-gradient(top,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 72%,$wpaioab_adminbar_color 100%); 
						background: -ms-linear-gradient(top,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 72%,$wpaioab_adminbar_color 100%); 
						background: linear-gradient(to bottom,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 72%,$wpaioab_adminbar_color 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						" ;
		break;	
		
		
	case 6:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(top,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_color 1%, $wpaioab_adminbar_color 7%, $wpaioab_adminbar_color 7%, $wpaioab_adminbar_bottom_shadow 22%, $wpaioab_adminbar_bottom_shadow 33%, $wpaioab_adminbar_bottom_shadow 50%, $wpaioab_adminbar_bottom_shadow 67%); 
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,$wpaioab_adminbar_color), color-stop(1%,$wpaioab_adminbar_color), color-stop(7%,$wpaioab_adminbar_color), color-stop(7%,$wpaioab_adminbar_color), color-stop(22%,$wpaioab_adminbar_bottom_shadow), color-stop(33%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_bottom_shadow), color-stop(67%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(top,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 1%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_bottom_shadow 22%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 67%); 
						background: -o-linear-gradient(top,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 1%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_bottom_shadow 22%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 67%); 
						background: -ms-linear-gradient(top,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 1%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_bottom_shadow 22%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 67%); 
						background: linear-gradient(to bottom,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 1%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_color 7%,$wpaioab_adminbar_bottom_shadow 22%,$wpaioab_adminbar_bottom_shadow 33%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 67%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=0 ); 
						" ;
		break;	
		
	
	case 7:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_color 50%, $wpaioab_adminbar_bottom_shadow 50%, $wpaioab_adminbar_bottom_shadow 50%, $wpaioab_adminbar_bottom_shadow 50%); 
						background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,$wpaioab_adminbar_color), color-stop(50%,$wpaioab_adminbar_color), color-stop(50%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: -o-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: -ms-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: linear-gradient(135deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						" ;
		break;	

	case 8:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(45deg,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_color 50%, $wpaioab_adminbar_bottom_shadow 50%, $wpaioab_adminbar_bottom_shadow 50%, $wpaioab_adminbar_bottom_shadow 50%); 
						background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,$wpaioab_adminbar_color), color-stop(50%,$wpaioab_adminbar_color), color-stop(50%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_bottom_shadow), color-stop(50%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: -o-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: -ms-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						background: linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_color 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%,$wpaioab_adminbar_bottom_shadow 50%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
" ;
		break;	
	
		
	case 9:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_bottom_shadow 100%); 
						background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,$wpaioab_adminbar_color), color-stop(100%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -o-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -ms-linear-gradient(-45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: linear-gradient(135deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						" ;
		break;	
	
	case 10:
        $css_snippet = "background: $wpaioab_adminbar_color; 
						background: -moz-linear-gradient(45deg,  $wpaioab_adminbar_color 0%, $wpaioab_adminbar_bottom_shadow 100%); 
						background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,$wpaioab_adminbar_color), color-stop(100%,$wpaioab_adminbar_bottom_shadow)); 
						background: -webkit-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -o-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: -ms-linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						background: linear-gradient(45deg,  $wpaioab_adminbar_color 0%,$wpaioab_adminbar_bottom_shadow 100%); 
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$wpaioab_adminbar_color', endColorstr='$wpaioab_adminbar_bottom_shadow',GradientType=1 ); 
						" ;
		break;		
	
	}
	
	return $css_snippet;
	}
	
	public function move_to_mottom(){
	
	$css_snippet = "* html body {
			margin-top: 0 !important; 
		}
		
		body.admin-bar {
			margin-top: -32px;
		}
			
		body.admin-bar.masthead-fixed .site-header{
			top:0px;
		}

		#wpadminbar {
			top: auto !important;
			bottom: 0;
			position:fixed;
		}

		#wpadminbar .quicklinks .ab-sub-wrapper {
			bottom: 32px;
		}

		#wpadminbar .quicklinks .ab-sub-wrapper ul .ab-sub-wrapper {
			bottom: -7px;
		}";
		
		return $css_snippet;
	}
	
	private function get_menu_shadow_sample_styles() {
	global $menu_shadow_strengths;
	
	reset($menu_shadow_strengths);	
		$menu_shadow_sample_styles_table = "<div align='center' style='width:100%;'>";
		$shadows_color = "#0B1466";
		
			while (list($shadow_key, $shadow_label) = each($menu_shadow_strengths)) {
			
			$shadows_style = "-moz-box-shadow:  $shadow_key $shadows_color;
							-webkit-box-shadow:  $shadow_key $shadows_color;
							box-shadow:  $shadow_key $shadows_color;";
			
			$menu_shadow_sample_styles_table .= "<div class='wpaioab-sample-menu-shadow-box'>
													<div class='wpaioab-sample-menu-shadow-one-fifth' align='center'>
														<div class='wpaioab-sample-menu-shadow-content' style='$shadows_style'></div>
													</div>
													<div align='center' class='wpaioab-sample-menu-shadow-text-one-fifth'>$shadow_label</div>
												</div>";	
			
			}
			
		return $menu_shadow_sample_styles_table .= "</div>";
	}
	
		
	private function get_menu_item_shadow_sample_styles() {
	global $menu_item_shadow_strengths;
	
	reset($menu_item_shadow_strengths);	
		$menu_item_shadow_sample_styles_table = "<div align='center' style='width:100%;'>";
		$shadows_color = "#0B1466";
		
			while (list($item_shadow_key, $item_shadow_label) = each($menu_item_shadow_strengths)) {
			
			$item_shadow_style = $this->change_menu_item_shadow($shadows_color, $item_shadow_key);
			
			$menu_item_shadow_sample_styles_table .= "<div class='wpaioab-sample-colors-one-fifth-box' align='center'>
														<div class='wpaioab-sample-menu-item-shadow-one-fifth' align='center'>
															<div class='wpaioab-sample-menu-item-shadow-content' style='$item_shadow_style'></div>
														</div>
														<div align='center' class='wpaioab-sample-menu-shadow-text-one-fifth'>$item_shadow_label</div>
													 </div>";	
			
			}
			
		return $menu_item_shadow_sample_styles_table .= "</div>";
	}
	
	
	public function get_adminbar_sample_styles() {
		global $menu_item_shadow_strengths;
		if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
			die ( 'Invalid Nonce' );
			
		$sample_styles = array(
		
			array('#0B1466', '#25FFD4', 1, 'Style 1'),
			array('#0B1466', '#25FFD4', 2, 'Style 2'),
			array('#0B1466', '#25FFD4', 3, 'Style 3'),
			array('#0B1466', '#25FFD4', 4, 'Style 4'),
			array('#0B1466', '#25FFD4', 5, 'Style 5'),
			array('#0B1466', '#25FFD4', 6, 'Style 6'),
			array('#0B1466', '#25FFD4', 7, 'Style 7'),
			array('#0B1466', '#25FFD4', 8, 'Style 8'),
			array('#0B1466', '#25FFD4', 9, 'Style 9'),
			array('#0B1466', '#25FFD4', 10, 'Style 10')
		
		);
	
	
		$adminbar_sample_styles_table = "<div>";
			foreach ($sample_styles as $each_sample_style) {

					$background_color = $this->select_adminbar_style_pattern($each_sample_style[2], $each_sample_style[0], $each_sample_style[1]);
					$adminbar_sample_styles_table .= "<div class='wpaioab-sample-colors-one-fifth-box gradient-color'><div class='wpaioab-sample-colors-one-fifth' style='background : $background_color;'></div><div align='center' class='wpaioab-sample-colors-text-one-fifth'><b>$each_sample_style[3]</b></div></div>";

			}
		$adminbar_sample_styles_table .= "</div>";

		echo json_encode( array(
		
			'adminbar_sample_styles_table' => $adminbar_sample_styles_table,
			'menu_shadow_sample_styles_table' => $this->get_menu_shadow_sample_styles(),
			'menu_item_shadow_sample_styles_table' => $this->get_menu_item_shadow_sample_styles(),
			'success' => 1
			
		) );
		exit;
	
	}
 
	
	private function custom_admin_logo() {

		global $wpaioab_options;	
        echo '<script type="text/javascript"> jQuery(document).ready(function(){ jQuery("#wp-admin-bar-root-default").prepend(" <li id=\"wpaioab_custom_logo\"> <span style=\"float:left;height:28px;line-height:28px;align:center;text-align:center;width:28px\"><img src=\"'.$wpaioab_options['wpaioab_custom_logo_image'].'\" style=\"'.$wpaioab_options['wpaioab_custom_logo_image_size'].';align:center\" /> </span> </li> ");  }); </script> ';

	}

	public function change_adminbar_colors() {

	global $wpaioab_options;
	$wpaioab_current_blog = get_current_blog_id();
	
		if(!empty($wpaioab_options['wpaioab_custom_logo_image'])){
			$this->custom_admin_logo();
		}

		if(!isset($wpaioab_options['enable']) || $wpaioab_options['enable']!=1) {

			$css_code = '<style type="text/css">'.

				$this->change_adminbar_background().
				$this->change_adminbar_links_hover().
				$this->change_icon_color().
				$this->change_icon_hover_color().
				$this->change_adminbar_links_text().
				$this->change_menu().
				$this->change_menu_item();

				if(is_plugin_active('buddypress/bp-loader.php')){
					$css_code .= $this->change_buddypress_menu_section().
					$this->change_buddypress_submenu_section().
					$this->change_buddypress_before_notifications().
					$this->change_buddypress_after_notifications();
					
						if ($wpaioab_options['wpaioab_hide_notification_enable']){
							$css_code .= $this->hide_buddypress_notification();
						}
						if ($wpaioab_options['wpaioab_notification_bg_image'] != null && $wpaioab_options['wpaioab_notification_bg_image'] != ""){
							$css_code .= $this->hide_buddypress_notification_area_background();
						}
					$css_code .= $this->change_message_count();	
					}
					
				$css_code .= $this->change_menu_text();

				
			
				if(!empty($wpaioab_options['wpaioab_move_to_bottom'])){
					$css_code .= $this->move_to_mottom();
				}
				
				if ($wpaioab_options['wpaioab_toggle_hide_status'] == 1){
					$css_code .= $this->change_toggle_color();
				}
				
				
				$css_code .= $this->change_the_rest();
				$css_code .= $this->change_searchbox_text_color();
				
				if($wpaioab_options['wpaioab_menu_shadow_status']){
					$css_code .= $this->change_menu_shadow();
				}
				
				if(isset($wpaioab_options['wpaioab_hide_separators'])){
					$css_code .= $this->change_links_separator_color();
				}

				if ($wpaioab_options['wpaioab_custom_css'] != null && $wpaioab_options['wpaioab_custom_css'] != ""){
					$css_code .= $wpaioab_options['wpaioab_custom_css'];
				}
				
				$css_code .='</style>';
		
			$css_code = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$css_code)))));

			echo $css_code;
		}

	}

}
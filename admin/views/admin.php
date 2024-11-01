<?php

require_once './admin.php'; 

global $wpaioab_options;
global $adminbar_links;
global $menu_item_shadow_strengths;
global $menu_shadow_strengths;
global $menu_icon_image_sizes;
global $show_menus_for;
global $wp_roles;

$repeat_directions = array('repeat-x','repeat-y', 'repeat');
$adminbar_style_patterns = array('1' => 'Style 1', '2' => 'Style 2', '3' => 'Style 3', '4' => 'Style 4', '5' => 'Style 5', '6' => 'Style 6', '7' => 'Style 7', '8' => 'Style 8', '9' => 'Style 9', '10' => 'Style 10');
$gradient_effect_status = array('1' => 'Disable', '2' => 'Enable');						
$menu_locations = array('my-account' => 'My Account', 'site-name' => 'Site Name', 'custom' => 'Admin Bar');
$action_hooks = array('wp_before_admin_bar_render' => 'Before Admin Bar Render', 'admin_bar_menu' => 'Admin Bar Menu');	
$toggle_hide_selections = array('0' => 'Select', '1' => 'Toggle', '2' => 'Auto Hide');
$toggle_label_show_types = array('\2193' => '&#8595;', '\21a7' => '&#8615;', '\21df' => '&#8671;', '\21e9' => '&#8681;', '\a71c' => '&#42780;', '\2c5' => '&#709;', '\21ca' => '&#8650;', '\21d3' => '&#8659;', '\2357' => '&#9047;', '\2195' => '&#8597;', 'Show' => 'Show');
$toggle_label_hide_types = array('\2191' => '&#8593;', '\21a5' => '&#8613;', '\21de' => '&#8670;', '\21e7' => '&#8679;', '\a71b' => '&#42779;', '\2c4' => '&#708;', '\21c8' => '&#8648;', '\21d1' => '&#8657;', '\2350' => '&#9040;', '\2195' => '&#8597;', 'Hide' => 'Hide');
$toggle_font_wights = array('100' => '100', '200' => '200', '300' => '300', '400' => 'normal', '500' => '500', '600' => '600', '700' => 'bold', '800' => '800', '900' => '900');
$toggle_label_alignments = array('3' => 'Left', '50' => 'Center', '97' => 'Right');
$menu_shadow_types = array('1' => 'Display As Left Shadow For All Menus', '2' => 'Display As Right Shadow For All Menus', '3' => 'Left Shadow For Right Menus & Vice Versa');
$apply_changes_for = array('1' => 'Website Only', '2' => 'Admin Area & Website Both', '3' => 'Admin Area Only');
$notification_image_sizes = array('28px 28px; width:28px' => '28x28 px', '28px 32px; width:28px' => '28x32 px', '32px 32px; width:32px' => '32x32 px');	
$custom_logo_image_sizes = array('height:16px;width:16px' => '16x16 px','height:20px;width:20px' => '20x20 px','height:24px;width:24px' => '24x24 px','height:28px;width:28px' => '28x28 px');
$toggle_border_types = array('none' => 'none', 'dotted; border-width:2px' => 'dotted', 'dashed; border-width:2px' => 'dashed', 'solid; border-width:2px' => 'solid', 'double; border-width:5px' => 'double', 'groove; border-width:2px' => 'groove', 'ridge; border-width:2px' => 'ridge', 'inset; border-width:2px' => 'inset', 'outset; border-width:2px' => 'outset', 'initial; border-width:2px' => 'initial');	

?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<form method="post" action="options.php" id="wpaioab_admin_form">
	<?php settings_fields('wpaioab_settings_group'); ?>

	<?php 
	$other_attributes = array( 'id' => 'wpaioab_submit', 'disabled' => true );
	submit_button('Save All Settings', 'primary', '', true, $other_attributes); ?>
	
	 <div id="tabs">
    <ul>
	  <li><a href="#tabs-0"><?php _e('Settings', $this->plugin_slug, $this->plugin_slug);?></a></li>
      <li><a href="#tabs-1"><?php _e('Style Colors', $this->plugin_slug, $this->plugin_slug);?></a></li>
      <li><a href="#tabs-2"><?php _e('Background Images', $this->plugin_slug);?></a></li>
      <li><a href="#tabs-3"><?php _e('Shadows', $this->plugin_slug);?></a></li>
	  <li><a href="#tabs-4"><?php _e('WP Menus', $this->plugin_slug);?></a></li>
	  <li><a href="#tabs-5"><?php _e('Custom Menus', $this->plugin_slug);?></a></li>
	  <li><a href="#tabs-6"><?php _e('Custom CSS', $this->plugin_slug);?></a></li>
    </ul>
	
	<div id="tabs-0">
	
	<div style="padding-bottom:600px;">
	
	 <p>
		<input id="wpaioab_settings[enable]" name="wpaioab_settings[enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['enable']) && 1 == $wpaioab_options['enable'] ) echo 'checked="checked"';  ?> />
		<label class="description" for="wpaioab_settings[enable]"> 
		<?php _e('Disable Changes', $this->plugin_slug);?>
		</label>
	 </p>
	
	<h3><?php echo _e('Apply Changes For', $this->plugin_slug); ?></h3>
	 <div class="singlerowdiv" style="margin-top:10px;">
		
			<div class="gradient-half">
				<div class="gradient-half"><?php echo _e('Apply Changes For : ', $this->plugin_slug);?></div>
				<div class="gradient-half"> 
				<select name="wpaioab_settings[wpaioab_apply_changes_status]" id="wpaioab_apply_changes_status" >
					
					 <?php
						reset($apply_changes_for);
						while (list($key, $val) = each($apply_changes_for)) {
						if(isset($wpaioab_options['wpaioab_apply_changes_status']) && $wpaioab_options['wpaioab_apply_changes_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
				</select>
				</div>
			</div>	
			
			<div class="gradient-half">				
			</div>
			
	 </div>

	 <h3><?php echo _e('Greeting Message', $this->plugin_slug); ?></h3>	
	 <?php _e('Keep empty, if you need to remove greeting message', $this->plugin_slug);?>
	 <div class="singlerowdiv">
		 
		<div class="colorpickerdiv">
		<label class="description" for="wpaioab_settings[wpaioab_greeting_message]"> 
		<?php _e('Change the greeting message : ', $this->plugin_slug);?>
		</label></div>
		 <div class="colorpickerdiv">
		 <input name="wpaioab_settings[wpaioab_greeting_message]" id="wpaioab_greeting_message" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_greeting_message'] ) ){ echo $wpaioab_options['wpaioab_greeting_message'];} else { echo "Howdy";} ?>" />
		 </div>
	 </div>
	 
	 
	 
	 <h3><?php echo _e('WP / Custom Menu Action Hooks', $this->plugin_slug); ?></h3>	

	 <div class="singlerowdiv">
		 
		<div class="colorpickerdiv">
		<label class="description" for="wpaioab_settings[wpaioab_greeting_message]"> 
		<?php _e('WP / Custom Menu Action Hooks : ', $this->plugin_slug);?>
		</label></div>
		 <div class="colorpickerdiv">
		 
		 		<select class="menu-location" name="wpaioab_settings[wpaioab_menu_action_hook]"  id="wpaioab_settings[wpaioab_menu_action_hook]" >
						<?php
								reset($action_hooks);
								while (list($key, $val) = each($action_hooks)) {
								if(isset($wpaioab_options['wpaioab_menu_action_hook']) && $wpaioab_options['wpaioab_menu_action_hook']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								<?php } ?>
				</select>
				
		 </div>
	 </div> 

	 <?php if(is_plugin_active('buddypress/bp-loader.php')){?>
	 <h3><?php echo _e('Merge Menu Styles', $this->plugin_slug); ?></h3>
	 <div class="singlerowdiv">	
		<table>

			<tr>
				<td>
					<input id="wpaioab_settings[wpaioab_merge_menu_styles]" name="wpaioab_settings[wpaioab_merge_menu_styles]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_merge_menu_styles']) && 1 == $wpaioab_options['wpaioab_merge_menu_styles'] ) echo 'checked="checked"'; ?> />
				</td>
				<td>
					<label class="description" for="wpaioab_settings[wpaioab_merge_menu_styles]"> <?php echo _e('Merge My Account Menu and Byddypress Menu Styles Together', $this->plugin_slug);?></label>
				</td>
			</tr>
			
		 <?php if(is_plugin_active('buddypress-media/index.php')){?>

				<tr>
					<td>
						<input id="wpaioab_settings[wpaioab_merge_rtmedia_styles]" name="wpaioab_settings[wpaioab_merge_rtmedia_styles]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_merge_rtmedia_styles']) && 1 == $wpaioab_options['wpaioab_merge_rtmedia_styles'] ) echo 'checked="checked"'; ?> />
					</td>
					<td>
						<label class="description" for="wpaioab_settings[wpaioab_merge_rtmedia_styles]"> <?php echo _e('Merge rtMedia Menu Item and Byddypress Menu Styles Together. Note: This may not work perfectly with complex background gradient or image patterns', $this->plugin_slug);?></label>
					</td>
				</tr>
		 <?php } ?>

		</table>
		</div>	 
	 <?php } ?>

	 
	 <h3><?php echo _e('Custom Logo', $this->plugin_slug); ?></h3>
	 	<table class="widefat">

			<tr>
				<td width="150"><span ><?php echo _e('Custom Logo Image', $this->plugin_slug); ?></span></td>
				<td >
					<select name="wpaioab_settings[wpaioab_custom_logo_image_size]"  id="wpaioab_settings[wpaioab_custom_logo_image_size]" >
						<?php
							reset($custom_logo_image_sizes);
							while (list($key, $val) = each($custom_logo_image_sizes)) {
								if(isset($wpaioab_options['wpaioab_custom_logo_image_size']) && $wpaioab_options['wpaioab_custom_logo_image_size']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
									<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $val;?></option>
						<?php } ?>
					</select>	
				</td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_custom_logo_image]" id="wpaioab_custom_logo_image" value="<?php if ( isset( $wpaioab_options['wpaioab_custom_logo_image'] ) ) echo $wpaioab_options['wpaioab_custom_logo_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
			</tr>
		</table>
	 
	 
	 <h3><?php echo _e('Hide Links', $this->plugin_slug); ?></h3>
	 <div class="singlerowdiv">	
		<table>
		<?php 
		reset($adminbar_links);
		while (list($key, $val) = each($adminbar_links)) {?>
			<tr>
				<td>
					<input id="wpaioab_settings[<?php echo $key ?>]" name="wpaioab_settings[<?php echo $key ?>]" type="checkbox" value="1" <?php if ( isset($wpaioab_options[$key]) && 1 == $wpaioab_options[$key] ) echo 'checked="checked"'; ?> />
				</td>
				<td>
					<label class="description" for="wpaioab_settings[<?php echo $key ?>]"> <?php echo _e('Hide '.$val, $this->plugin_slug);?></label>
				</td>
			</tr>
		<?php } ?>
		</table>
		</div>	
	<h3><?php echo _e('Move Adminbar to bottom', $this->plugin_slug); ?></h3>
	<?php echo _e("Note that : I don't recommend enabling this feature if your site contains a chat application box or any widgets in the bottom of the page.", $this->plugin_slug); ?>	 
	<div class="singlerowdiv" style="margin-top:10px;">
		<div class="gradient-half">
			 
				<input id="wpaioab_settings[wpaioab_move_to_bottom]" name="wpaioab_settings[wpaioab_move_to_bottom]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_move_to_bottom']) && 1 == $wpaioab_options['wpaioab_move_to_bottom'] ) echo 'checked="checked"';   ?> />
				<label class="description" for="wpaioab_settings[wpaioab_move_to_bottom]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		 </div>	
		<div class="gradient-half"></div>	
		 
	 </div>
	 
	 <h3><?php echo _e('Show / Hide Admin Bar according to the user roles', $this->plugin_slug); ?></h3>
 
	<div class="singlerowdiv" style="margin-top:10px;">
		<div class="gradient-half">
		
		<table>
		<?php foreach($wp_roles->get_names() as $each_role){ ?>
			<tr>
				<td>
					<input id="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', strtolower($each_role)) ?>]" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', strtolower($each_role)) ?>]" type="checkbox" value="1" <?php  if ( isset($wpaioab_options['wpaioab_'. str_replace(' ', '', strtolower($each_role))]) && 1 == $wpaioab_options['wpaioab_'. str_replace(' ', '', strtolower($each_role))] ) echo 'checked="checked"';  ?> />
				</td>
				<td>
					<label class="description" for="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', strtolower($each_role)) ?>]"> <?php echo _e('Hide Admin Bar for '.$each_role, $this->plugin_slug);?></label>
				</td>
			</tr>
		<?php }?>
		</table>
		
			
		 </div>	
		<div class="gradient-half"></div>	
		 
	 </div>
	 <h3><?php echo _e('Toggle / Auto Hide Admin Bar', $this->plugin_slug); ?></h3>
	 <div class="singlerowdiv"><?php echo _e('This feature is not available for admin area. If you are testing this feature for mobile devices from the desktop by changing the browser size, refresh the page after changing the browser size. ', $this->plugin_slug);?></div>
	 <div class="singlerowdiv" style="margin-top:10px;">
		
			<div class="gradient-half">
				<div class="gradient-half"><?php echo _e('Toggle / Auto Hide : ', $this->plugin_slug);?></div>
				<div class="gradient-half"> 
				<select name="wpaioab_settings[wpaioab_toggle_hide_status]" class="toggle-hide-selection" id="wpaioab_toggle_hide_status" >
					
					 <?php
						reset($toggle_hide_selections);
						while (list($key, $val) = each($toggle_hide_selections)) {
						if(isset($wpaioab_options['wpaioab_toggle_hide_status']) && $wpaioab_options['wpaioab_toggle_hide_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
				</select>
				</div>
			</div>	
			
			<div class="gradient-half">				
			</div>
			
	 </div>
	 
	 
		<div class="admin-auto-hide">
		 <div class="singlerowdiv" style="margin-top:10px;">
			
				<div class="gradient-half">
					<div class="gradient-half"><?php echo _e('OnMouseOut Delay (ms) : ', $this->plugin_slug);?></div>
					<div class="gradient-half"> 
						<input name="wpaioab_settings[wpaioab_onmouse_out_delay]" id="wpaioab_settings[wpaioab_onmouse_out_delay]"  type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_onmouse_out_delay'] ) ) { echo $wpaioab_options['wpaioab_onmouse_out_delay'];  } else { echo "1000";}  ?>" />
					</div>
				</div>	
				
				<div class="gradient-half">
					<div class="gradient-half"><?php echo _e('Admin Bar Moving Speed (ms) : ', $this->plugin_slug);?></div>
					<div class="gradient-half"> 
						<input name="wpaioab_settings[wpaioab_moving_speed]" id="wpaioab_settings[wpaioab_moving_speed]"  type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_moving_speed'] ) ) { echo $wpaioab_options['wpaioab_moving_speed'];  } else { echo "200";}  ?>" />
					</div>
				</div>
				
		 </div>
	 
	 
		 <div class="singlerowdiv" style="margin-top:10px;">
			
				<div class="gradient-half">
					<div class="gradient-half"><?php echo _e('Display Interval (ms) : ', $this->plugin_slug);?></div>
					<div class="gradient-half"> 
						<input name="wpaioab_settings[wpaioab_display_interval]" id="wpaioab_settings[wpaioab_display_interval]"  type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_display_interval'] ) ) { echo $wpaioab_options['wpaioab_display_interval'];  } else { echo "100";}  ?>" />
					</div>
				</div>	
				
				<div class="gradient-half">
					<div class="gradient-half"><?php echo _e('Enable auto hide for mobile devices (beta): ', $this->plugin_slug);?></div>
					<div class="gradient-half"><input id="wpaioab_settings[wpaioab_enable_auto_hide_mobile]" name="wpaioab_settings[wpaioab_enable_auto_hide_mobile]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_enable_auto_hide_mobile']) && 1 == $wpaioab_options['wpaioab_enable_auto_hide_mobile'] ) echo 'checked="checked"';  ?> /></div>
				</div>
				
		 </div>
		 <?php echo _e('Note that --> To function perfectly OnMouseOut Delay : Admin Bar Moving Speed : Display Interval ratio should be 10:2:1', $this->plugin_slug);?>
		 
	 </div>
	 
	 
	 	 <div class="admin-toggle">
			 <div class="singlerowdiv" style="margin-top:10px;">
				
					<div class="gradient-half">
						<div class="gradient-half"><?php echo _e('Show Admin Bar Label : ', $this->plugin_slug);?></div>
						<div class="gradient-half"> 
						
							<select name="wpaioab_settings[wpaioab_toggle_label_show_status]"  id="wpaioab_toggle_label_show_status" >
								<?php
									reset($toggle_label_show_types);
									while (list($key, $val) = each($toggle_label_show_types)) {
									if(isset($wpaioab_options['wpaioab_toggle_label_show_status']) && $wpaioab_options['wpaioab_toggle_label_show_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
									?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								 <?php } ?>
							</select>
						
						</div>
					</div>	
					
					<div class="gradient-half">
						<div class="gradient-half"><?php echo _e('Hide Admin Bar Label : ', $this->plugin_slug);?></div>
						<div class="gradient-half"> 
						
							<select name="wpaioab_settings[wpaioab_toggle_label_hide_status]"  id="wpaioab_toggle_label_hide_status" >
								<?php
									reset($toggle_label_hide_types);
									while (list($key, $val) = each($toggle_label_hide_types)) {
									if(isset($wpaioab_options['wpaioab_toggle_label_hide_status']) && $wpaioab_options['wpaioab_toggle_label_hide_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
									?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								 <?php } ?>
							</select>
						
						</div>
					</div>
			</div>	

			<div class="singlerowdiv" style="margin-top:10px;">				
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Label Background Color : ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv"> 
						<input name="wpaioab_settings[wpaioab_toggle_background_color]" class="admincolor" id="wpaioab_toggle_background_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toggle_background_color'] ) ) { echo '#000000'; } else { echo $wpaioab_options['wpaioab_toggle_background_color']; } ?>" />
						<div id="wpaioab_toggle_background_color_colorpicker"></div>
					</div>
				</div>
				
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Label Text Color : ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv"> 
						<input name="wpaioab_settings[wpaioab_toggle_label_color]" class="admincolor" id="wpaioab_toggle_label_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toggle_label_color'] ) )  { echo '#ffffff'; } else { echo $wpaioab_options['wpaioab_toggle_label_color']; } ?>" />
						<div id="toggle_label_color_colorpicker"></div>
					</div>
				</div>
			</div>
		 
			<div class="singlerowdiv" style="margin-top:10px;">				
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Text Size (px): ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv"> 
						<input name="wpaioab_settings[wpaioab_toggle_label_text]" id="wpaioab_settings[wpaioab_toggle_label_text]"  type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_toggle_label_text'] ) ) { echo $wpaioab_options['wpaioab_toggle_label_text']; } else { echo "20";} ?>" />
					</div>
				</div>
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Font Weight : ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv"> 
							
							<select name="wpaioab_settings[wpaioab_toggle_label_text_weight]"  id="wpaioab_toggle_label_text_weight" >
								<?php
									reset($toggle_font_wights);
									while (list($key, $val) = each($toggle_font_wights)) {
									if(isset($wpaioab_options['wpaioab_toggle_label_text_weight']) && $wpaioab_options['wpaioab_toggle_label_text_weight']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
									?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								 <?php } ?>
							</select>
					
					</div>
				</div>
				
			</div>
			
			<div class="singlerowdiv" style="margin-top:10px;">		
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Show / Hide Label Alignment : ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv"> 
							
							<select name="wpaioab_settings[wpaioab_toggle_label_alignment_staus]"  id="wpaioab_toggle_label_alignment_staus" >
								<?php
									reset($toggle_label_alignments);
									while (list($key, $val) = each($toggle_label_alignments)) {
									if(isset($wpaioab_options['wpaioab_toggle_label_alignment_staus']) && $wpaioab_options['wpaioab_toggle_label_alignment_staus']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
									?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								 <?php } ?>
							</select>
					
					</div>
				</div>
				
				
				
				<div class="gradient-half">
					<div class="bgdiv-half-colorlabeldiv"><?php echo _e('Outline Border Type (px) : ', $this->plugin_slug);?></div>
					<div class="bgdiv-half-colorpickerdiv">
						
							<select name="wpaioab_settings[wpaioab_toggle_outline_border]"  id="wpaioab_toggle_outline_border" >
								<?php
									reset($toggle_border_types);
									while (list($key, $val) = each($toggle_border_types)) {
									if(isset($wpaioab_options['wpaioab_toggle_outline_border']) && $wpaioab_options['wpaioab_toggle_outline_border']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
									?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								 <?php } ?>
							</select>

					</div>
				</div>			
				
			</div>
			
		 </div>

	 
		 
		 
		 
		 
	 </div>
	 
	
	</div>
	
    <div id="tabs-1">
	
	<div style="padding-bottom:450px;">

	 <h3><?php echo _e('Background Colors', $this->plugin_slug); ?></h3>
	 <div class="singlerowdiv" id="adminbar_sample_styles_table"></div>	
	 <div class="singlerowdiv">
		 
		<div class="colorpickerdiv">
		<label class="description" for="wpaioab_settings[wpaioab_gradient_current_status]"> 
		<?php _e('Enable Gradient Effect : ', $this->plugin_slug);?>
		</label></div>
		 <div class="colorpickerdiv"><select name="wpaioab_settings[wpaioab_gradient_current_status]" class="enable-gradient" id="wpaioab_gradient_current_status" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($gradient_effect_status)) {
						if(isset($wpaioab_options['wpaioab_gradient_current_status']) && $wpaioab_options['wpaioab_gradient_current_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
	 </div>	 

	 
	 
	 <div class="singlerowdiv">
	 
		 <div id="gradient-selector-1" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_adminbar_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_adminbar_style_pattern]" id="wpaioab_adminbar_style_pattern" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
						if(isset($wpaioab_options['wpaioab_adminbar_style_pattern']) && $wpaioab_options['wpaioab_adminbar_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
		 </div>
		 
		 <div class="bgdiv-half">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_adminbar_color"><?php echo _e('Admin Bar Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_adminbar_color]" id="wpaioab_adminbar_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_adminbar_color'] ) ) { echo '#222222'; } else { echo $wpaioab_options['wpaioab_adminbar_color']; } ?>" />
			<div id="wpaioab_adminbar_color_colorpicker"></div></div>
		 </div>
		 <div class="bgdiv-half gradient-color" id="secondry-color-1">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_adminbar_bottom_shadow"><?php echo _e('Admin Bar Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_adminbar_bottom_shadow]" class="admincolor" id="wpaioab_adminbar_bottom_shadow" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_adminbar_bottom_shadow'] ) ) { echo '#222222'; } else {  echo $wpaioab_options['wpaioab_adminbar_bottom_shadow']; } ?>" />
			<div id="wpaioab_adminbar_bottom_shadow_colorpicker"></div></div>
		</div>

		<div id="gradient-selector-2" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_toolbar_menu_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_toolbar_menu_style_pattern]" id="wpaioab_toolbar_menu_style_pattern" >
					
					<?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
							if(isset($wpaioab_options['wpaioab_toolbar_menu_style_pattern']) && $wpaioab_options['wpaioab_toolbar_menu_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
					<?php } ?>
					
		</select></div>
		</div>
		
		<div class="bgdiv-half">
		<div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_toolbar_menu_color"><?php echo _e('Menu Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbar_menu_color]" class="admincolor" id="wpaioab_toolbar_menu_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toolbar_menu_color'] ) ) { echo '#333333'; } else {  echo $wpaioab_options['wpaioab_toolbar_menu_color']; } ?>" />
			<div id="wpaioab_toolbar_menu_color_colorpicker"></div></div>
		 </div>
		 
		<div class="bgdiv-half gradient-color" id="secondry-color-2">
		<div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_toolbar_menu_secondry_color"><?php echo _e('Menu Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbar_menu_secondry_color]" class="admincolor" id="wpaioab_toolbar_menu_secondry_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toolbar_menu_secondry_color'] ) ) { echo '#333333'; } else {  echo $wpaioab_options['wpaioab_toolbar_menu_secondry_color']; } ?>" />
			<div id="wpaioab_toolbar_menu_secondry_color_colorpicker"></div></div>
		 </div>

		 
		<div id="gradient-selector-3" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_menu_hover_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_menu_hover_style_pattern]" id="wpaioab_menu_hover_style_pattern" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
						if(isset($wpaioab_options['wpaioab_menu_hover_style_pattern']) && $wpaioab_options['wpaioab_menu_hover_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
		</div> 

		 
		 <div class="bgdiv-half">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_menu_hover_color"><?php echo _e('Menu Item Hover Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_hover_color]" id="wpaioab_menu_hover_color" class="admincolor" type="text" value="<?php if ( !empty( $wpaioab_options['wpaioab_menu_hover_color'] ) ) echo $wpaioab_options['wpaioab_menu_hover_color']; ?>" />
			<div id="wpaioab_menu_hover_color_colorpicker"></div></div>
		 </div>
		 
		 <div class="bgdiv-half gradient-color"  id="secondry-color-3">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_menu_hover_secondry_color"><?php echo _e('Menu Item Hover Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_hover_secondry_color]" id="wpaioab_menu_hover_secondry_color" class="admincolor" type="text" value="<?php if ( !empty( $wpaioab_options['wpaioab_menu_hover_secondry_color'] ) ) echo $wpaioab_options['wpaioab_menu_hover_secondry_color']; ?>" />
			<div id="wpaioab_menu_hover_secondry_color_colorpicker"></div></div>
		 </div>
		 
		 <div id="gradient-selector-4" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_menu_parent_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_menu_parent_style_pattern]" id="wpaioab_menu_parent_style_pattern" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
						if(isset($wpaioab_options['wpaioab_menu_parent_style_pattern']) && $wpaioab_options['wpaioab_menu_parent_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
		</div>

		 
		 <div class="bgdiv-half">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_menu_parent_color"><?php echo _e('Adminbar Current Link Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_parent_color]" id="wpaioab_menu_parent_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_menu_parent_color'] ) ) { echo '#333333'; } else {  echo $wpaioab_options['wpaioab_menu_parent_color']; } ?>" />
			<div id="wpaioab_menu_parent_color_colorpicker"></div></div>
		
		 </div>
		 <div class="bgdiv-half gradient-color"  id="secondry-color-4">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_menu_parent_secondry_color"><?php echo _e('Adminbar Current Link Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_parent_secondry_color]" id="wpaioab_menu_parent_secondry_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_menu_parent_secondry_color'] ) )  { echo '#333333'; } else {  echo $wpaioab_options['wpaioab_menu_parent_secondry_color']; } ?>" />
			<div id="wpaioab_menu_parent_secondry_color_colorpicker"></div></div>
		
		 </div>
		
		
	 </div>

	<?php if(is_plugin_active('buddypress/bp-loader.php')){?>

	<h3><?php echo _e('Buddypress Menu Background Colors', $this->plugin_slug); ?></h3>
		<div class="singlerowdiv">	
		
		<div id="gradient-selector-5" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_buddypress_menu_color_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_buddypress_menu_color_style_pattern]" id="wpaioab_buddypress_menu_color_style_pattern" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
						if(isset($wpaioab_options['wpaioab_buddypress_menu_color_style_pattern']) && $wpaioab_options['wpaioab_buddypress_menu_color_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
		</div>
		
		
		<div class="bgdiv-half">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_buddypress_menu_color"><?php echo _e('Buddypress Menu Background', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_buddypress_menu_color]" id="wpaioab_buddypress_menu_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_buddypress_menu_color'] ) )  { echo '#4B4B4B'; } else { echo $wpaioab_options['wpaioab_buddypress_menu_color']; } ?>" />
			<div id="wpaioab_buddypress_menu_color_colorpicker"></div></div>
		</div>
		
		<div class="bgdiv-half gradient-color" id="secondry-color-5">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_buddypress_menu_secondry_color"><?php echo _e('Buddypress Menu Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_buddypress_menu_secondry_color]" id="wpaioab_buddypress_menu_secondry_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_buddypress_menu_secondry_color'] ) ) { echo '#4B4B4B'; } else {  echo $wpaioab_options['wpaioab_buddypress_menu_secondry_color']; } ?>" />
			<div id="wpaioab_buddypress_menu_secondry_color_colorpicker"></div></div>
		</div>

		
		<div id="gradient-selector-6" class="gradient-selector gradient-color"> 
		 <div class="gradient-half"><label for="wpaioab_sub_menu_color_style_pattern"><?php echo _e('Select a gradient pattern', $this->plugin_slug); ?>: </label>
		 </div>
		 <div class="gradient-half"><select name="wpaioab_settings[wpaioab_sub_menu_color_style_pattern]" id="wpaioab_sub_menu_color_style_pattern" >
					
					 <?php
						reset($adminbar_style_patterns);
						while (list($key, $val) = each($adminbar_style_patterns)) {
						if(isset($wpaioab_options['wpaioab_sub_menu_color_style_pattern']) && $wpaioab_options['wpaioab_sub_menu_color_style_pattern']==$key){$selected = 'selected="selected"';}else{ $selected ='';}
						?><option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
						<?php } ?>
		</select></div>
		</div>
		
		
		
		<div class="bgdiv-half">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_sub_menu_color"><?php echo _e('Buddypress Sub Menu Background', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_sub_menu_color]" class="admincolor" id="wpaioab_sub_menu_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_sub_menu_color'] ) ) { echo '#4B4B4B'; } else { echo $wpaioab_options['wpaioab_sub_menu_color']; } ?>" />
			<div id="wpaioab_sub_menu_color_colorpicker"></div></div>
		</div>
		
		<div class="bgdiv-half gradient-color" id="secondry-color-6">
		 <div class="bgdiv-half-colorlabeldiv"><label for="wpaioab_sub_menu_secondry_color"><?php echo _e('Buddypress Sub Menu Secondary Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="bgdiv-half-colorpickerdiv"><input name="wpaioab_settings[wpaioab_sub_menu_secondry_color]" class="admincolor" id="wpaioab_sub_menu_secondry_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_sub_menu_secondry_color'] ) ) { echo '#4B4B4B'; } else {  echo $wpaioab_options['wpaioab_sub_menu_secondry_color']; } ?>" />
			<div id="wpaioab_sub_menu_secondry_color_colorpicker"></div></div>
		</div>
		 
	 </div>
	 
	 <?php } ?>
	 


	<h3><?php echo _e('Text Colors', $this->plugin_slug); ?></h3>
		<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_menu_text_color"><?php echo _e('Menu Item Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_text_color]" id="wpaioab_menu_text_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_menu_text_color'] ) ) { echo '#EEEEEE'; } else { echo $wpaioab_options['wpaioab_menu_text_color']; } ?>" />
			<div id="wpaioab_menu_text_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_menu_text_hover_color"><?php echo _e('Menu Item Text Hover Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_text_hover_color]" class="admincolor" id="wpaioab_menu_text_hover_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_menu_text_hover_color'] ) ) { echo '#2EA2CC'; } else { echo $wpaioab_options['wpaioab_menu_text_hover_color']; } ?>" />
			<div id="wpaioab_menu_text_hover_color_colorpicker"></div></div>
			
	 </div>	
	 <div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_toolbarlinks_text_color"><?php echo _e('Adminbar Links Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbarlinks_text_color]" id="wpaioab_toolbarlinks_text_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toolbarlinks_text_color'] ) ) { echo '#EEEEEE'; } else { echo $wpaioab_options['wpaioab_toolbarlinks_text_color']; } ?>" />
			<div id="wpaioab_toolbarlinks_text_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_toolbarlinks_text_hover_color"><?php echo _e('Adminbar Links Text Hover Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbarlinks_text_hover_color]" class="admincolor" id="wpaioab_toolbarlinks_text_hover_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_toolbarlinks_text_hover_color'] ) )  { echo '#2EA2CC'; } else { echo $wpaioab_options['wpaioab_toolbarlinks_text_hover_color']; } ?>" />
			<div id="wpaioab_toolbarlinks_text_hover_color_colorpicker"></div></div>
			
	 </div>	
	 	<div class="singlerowdiv">			

		 
		 <div class="colorlabeldiv"><label for="wpaioab_search_text_color"><?php echo _e('Search Box Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_search_text_color]" id="wpaioab_search_text_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_search_text_color'] ) )  { echo '#000000'; } else { echo $wpaioab_options['wpaioab_search_text_color']; } ?>" />
			<div id="wpaioab_search_text_color_colorpicker"></div></div>
		
	 </div>	

	<h3><?php echo _e('Icon Colors', $this->plugin_slug); ?></h3> 
	<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_icon_color"><?php echo _e('Adminbar Icon Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_icon_color]" id="wpaioab_icon_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_icon_color'] ) ){ echo '#999999'; } else { echo $wpaioab_options['wpaioab_icon_color']; } ?>" />
			<div id="wpaioab_icon_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_icon_hover_color"><?php echo _e('Adminbar Icon Hover Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_icon_hover_color]" class="admincolor" id="wpaioab_icon_hover_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_icon_hover_color'] ) ){ echo '#2EA2CC'; } else { echo $wpaioab_options['wpaioab_icon_hover_color']; } ?>" />
			<div id="wpaioab_icon_hover_color_colorpicker"></div></div>
			
	 </div>	

	<?php if(is_plugin_active('buddypress/bp-loader.php')){?>
	 
	<h3><?php echo _e('Buddypress Notification Circle Color', $this->plugin_slug); ?></h3> 
	
	<h4><?php echo _e('Before Notifications', $this->plugin_slug); ?></h4> 
	<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_bp_before_notification_bg_color"><?php echo _e('Circle Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_before_notification_bg_color]" id="wpaioab_bp_before_notification_bg_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_before_notification_bg_color'] ) ){ echo '#DDDDDD';} else { echo $wpaioab_options['wpaioab_bp_before_notification_bg_color']; } ?>" />
			<div id="wpaioab_bp_before_notification_bg_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_bp_before_notification_text_color"><?php echo _e('Circle Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_before_notification_text_color]" class="admincolor" id="wpaioab_bp_before_notification_text_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_before_notification_text_color'] ) ) { echo '#333333';} else {  echo $wpaioab_options['wpaioab_bp_before_notification_text_color']; }?>" />
			<div id="wpaioab_bp_before_notification_text_color_colorpicker"></div></div>
			
	 </div>	
	
	<h4><?php echo _e('After Notifications', $this->plugin_slug); ?></h4> 
	<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_bp_notification_bg_color"><?php echo _e('Circle Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_notification_bg_color]" id="wpaioab_bp_notification_bg_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_notification_bg_color'] ) ){ echo '#1FB3DD'; } else { echo $wpaioab_options['wpaioab_bp_notification_bg_color']; } ?>" />
			<div id="wpaioab_bp_notification_bg_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_bp_notification_text_color"><?php echo _e('Circle Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_notification_text_color]" class="admincolor" id="wpaioab_bp_notification_text_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_notification_text_color'] ) ){ echo '#FFFFFF'; } else { echo $wpaioab_options['wpaioab_bp_notification_text_color']; } ?>" />
			<div id="wpaioab_bp_notification_text_color_colorpicker"></div></div>
			
	 </div>


	<h3><?php echo _e('Buddypress Messages Count Circle Color', $this->plugin_slug); ?></h3> 

	<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_bp_message_count_bg_color"><?php echo _e('Circle Background Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_message_count_bg_color]" id="wpaioab_bp_message_count_bg_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_message_count_bg_color'] ) ){ echo '#0074A2';} else { echo $wpaioab_options['wpaioab_bp_message_count_bg_color']; } ?>" />
			<div id="wpaioab_bp_message_count_bg_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_bp_message_count_text_color"><?php echo _e('Circle Text Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_bp_message_count_text_color]" class="admincolor" id="wpaioab_bp_message_count_text_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_bp_message_count_text_color'] ) ) { echo '#DDDDDD';} else {  echo $wpaioab_options['wpaioab_bp_message_count_text_color']; }?>" />
			<div id="wpaioab_bp_message_count_text_color_colorpicker"></div></div>
			
	 </div>		 
 
	<?php } ?>
	
	<h3><?php echo _e('Links Separator Color', $this->plugin_slug); ?></h3> 
	<div class="singlerowdiv" style="margin-top:10px;">
		<div class="gradient-half">
			 
				<input id="wpaioab_settings[wpaioab_hide_separators]" name="wpaioab_settings[wpaioab_hide_separators]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_hide_separators']) && 1 == $wpaioab_options['wpaioab_hide_separators'] ) echo 'checked="checked"';   ?> />
				<label class="description" for="wpaioab_settings[wpaioab_hide_separators]"> 
				<?php echo _e('Show Separators', $this->plugin_slug);?>
				</label>
			
		 </div>	
		<div class="gradient-half"></div>	
		 
	 </div>
	<div class="singlerowdiv">			
		 <div class="colorlabeldiv"><label for="wpaioab_border_left_color"><?php echo _e('Border Left Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_border_left_color]" id="wpaioab_border_left_color" class="admincolor" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_border_left_color'] ) ){ echo '#DDDDDD'; } else { echo $wpaioab_options['wpaioab_border_left_color']; } ?>" />
			<div id="wpaioab_border_left_color_colorpicker"></div></div>
		
		 <div class="colorlabeldiv"><label for="wpaioab_border_right_color"><?php echo _e('Border Right Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_border_right_color]" class="admincolor" id="wpaioab_border_right_color" type="text" value="<?php if ( empty( $wpaioab_options['wpaioab_border_right_color'] ) ){ echo '#DDDDDD'; } else { echo $wpaioab_options['wpaioab_border_right_color']; } ?>" />
			<div id="wpaioab_border_right_color_colorpicker"></div></div>
			
	 </div>	
	 
	 
	 
	 
 </div>
	
	</div>
    <div id="tabs-2">
	<div id="icon-options-general" class="icon32"></div>
	<?php if(is_plugin_active('buddypress/bp-loader.php')){?>
		<table class="widefat">
			<thead>
				<tr><th colspan="3"><?php echo _e('Upload Images', $this->plugin_slug); ?></span></th></tr>
			</thead>
			<tr>
				<td width="150"><span ><?php echo _e('Notification Area Background Image', $this->plugin_slug); ?></span></td>
				<td >
					<select class="menu-location" name="wpaioab_settings[wpaioab_notification_image_size]"  id="wpaioab_settings[wpaioab_notification_image_size]" >
						<?php
							reset($notification_image_sizes);
							while (list($key, $val) = each($notification_image_sizes)) {
								if(isset($wpaioab_options['wpaioab_notification_image_size']) && $wpaioab_options['wpaioab_notification_image_size']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
									<option value="<?php echo $key ?>" <?php echo $selected ?> ><?php echo $val;?></option>
						<?php } ?>
					</select>	
				</td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_notification_bg_image]" id="wpaioab_notification_bg_image" value="<?php if ( isset( $wpaioab_options['wpaioab_notification_bg_image'] ) ) echo $wpaioab_options['wpaioab_notification_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
			</tr>
		</table>
		
		<input id="wpaioab_settings[wpaioab_hide_notification_enable]" name="wpaioab_settings[wpaioab_hide_notification_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_hide_notification_enable']) && 1 == $wpaioab_options['wpaioab_hide_notification_enable'] ) echo 'checked="checked"';  ?> />
		<label class="description" for="wpaioab_settings[wpaioab_hide_notification_enable]"> 
		<?php _e('Hide Buddypress notification circle when notification count zero.', $this->plugin_slug);?>
		</label>
	<?php } ?>
	 
	 		<table class="widefat">
			<tr>
				<td width="150"><span ><?php echo _e('Adminbar Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_adminbar_bg_image]" id="wpaioab_adminbar_bg_image" value="<?php if ( isset( $wpaioab_options['wpaioab_adminbar_bg_image'] ) ) echo $wpaioab_options['wpaioab_adminbar_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 
					 <select name="wpaioab_settings[wpaioab_adminbar_bg_image_repeat]" id="wpaioab_settings[wpaioab_adminbar_bg_image_repeat]">
						 <?php foreach($repeat_directions as $repeat_direction){
							 if( isset($wpaioab_options['wpaioab_adminbar_bg_image_repeat']) && $wpaioab_options['wpaioab_adminbar_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
						  <?php }?>
					 </select>
				</td>
			</tr>
			
			<tr>
				<td width="150"><span ><?php echo _e('Menu Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_admin_menu_bg_image]" id="wpaioab_admin_menu_bg_image" value="<?php if ( isset( $wpaioab_options['wpaioab_admin_menu_bg_image'] ) ) echo $wpaioab_options['wpaioab_admin_menu_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 

					 <select name="wpaioab_settings[wpaioab_admin_menu_bg_image_repeat]" id="wpaioab_settings[wpaioab_admin_menu_bg_image_repeat]">
					 <?php foreach($repeat_directions as $repeat_direction){
					 if( isset($wpaioab_options['wpaioab_admin_menu_bg_image_repeat']) && $wpaioab_options['wpaioab_admin_menu_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';}
					 ?>
					 <option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
					  <?php }?>
					 </select>

				</td>
			</tr>
			
			<tr>
				<td width="150"><span ><?php echo _e('Menu Item Hover Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_menu_item_bg_image]" id="wpaioab_settings[wpaioab_menu_item_bg_image]" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_item_bg_image'] ) ) echo $wpaioab_options['wpaioab_menu_item_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 

					 <select name="wpaioab_settings[wpaioab_menu_item_bg_image_repeat]" id="wpaioab_settings[wpaioab_menu_item_bg_image_repeat]">
					 <?php foreach($repeat_directions as $repeat_direction){
					 if( isset($wpaioab_options['wpaioab_menu_item_bg_image_repeat']) && $wpaioab_options['wpaioab_menu_item_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';}
					 ?>
					 <option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
					  <?php }?>
					 </select>

				</td>
			</tr>
			
			<tr>
				<td width="150"><span ><?php echo _e('Current Adminbar Link Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_menu_parent_bg_image]" id="wpaioab_settings[wpaioab_menu_parent_bg_image]" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_parent_bg_image'] ) ) echo $wpaioab_options['wpaioab_menu_parent_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 

					 <select name="wpaioab_settings[wpaioab_menu_parent_bg_image_repeat]" id="wpaioab_settings[wpaioab_menu_parent_bg_image_repeat]">
					 <?php foreach($repeat_directions as $repeat_direction){
					 if( isset($wpaioab_options['wpaioab_menu_parent_bg_image_repeat']) && $wpaioab_options['wpaioab_menu_parent_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';}
					 ?>
					 <option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
					  <?php }?>
					 </select>

				</td>
			</tr>
			

			<?php if(is_plugin_active('buddypress/bp-loader.php')){?>
			<tr>
				<td width="150"><span ><?php echo _e('Buddypress Menu Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_bp_menu_bg_image]" id="wpaioab_bp_menu_bg_image" value="<?php if ( isset( $wpaioab_options['wpaioab_bp_menu_bg_image'] ) ) echo $wpaioab_options['wpaioab_bp_menu_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 

					 <select name="wpaioab_settings[wpaioab_bp_menu_bg_image_repeat]" id="wpaioab_settings[wpaioab_bp_menu_bg_image_repeat]">
					 <?php foreach($repeat_directions as $repeat_direction){
					 if( isset($wpaioab_options['wpaioab_bp_menu_bg_image_repeat']) && $wpaioab_options['wpaioab_bp_menu_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';}
					 ?>
					 <option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
					  <?php }?>
					 </select>

				</td>
			</tr>
			
			<tr>
				<td width="150"><span ><?php echo _e('Buddypress Submenu Background Image', $this->plugin_slug); ?></span></td>
				<td>
				<input type="text"  name="wpaioab_settings[wpaioab_bp_submenu_bg_image]" id="wpaioab_bp_submenu_bg_image" value="<?php if ( isset( $wpaioab_options['wpaioab_bp_submenu_bg_image'] ) ) echo $wpaioab_options['wpaioab_bp_submenu_bg_image']; ?>" size="40" />
				<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
				<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
				</td>
				<td> 

					 <select name="wpaioab_settings[wpaioab_bp_submenu_bg_image_repeat]" id="wpaioab_settings[wpaioab_bp_submenu_bg_image_repeat]">
					 <?php foreach($repeat_directions as $repeat_direction){
					 if( isset($wpaioab_options['wpaioab_bp_submenu_bg_image_repeat']) && $wpaioab_options['wpaioab_bp_submenu_bg_image_repeat']==$repeat_direction){$selected = 'selected="selected"';}else{ $selected ='';}
					 ?>
					 <option value="<?php echo $repeat_direction?>" <?php echo $selected ?>><?php echo $repeat_direction?></option>
					  <?php }?>
					 </select>

				</td>
			</tr>
			<?php } ?>
		</table>
	 
	 
	 
	</div>
    <div id="tabs-3">
		
		
	 <h3><?php echo _e('Text Shadow Colors', $this->plugin_slug); ?></h3>
	 
		<div class="singlerowdiv">
		
		 <div class="colorlabeldiv">
			 
				<input id="wpaioab_settings[wpaioab_menu_text_shadow_color_enable]" name="wpaioab_settings[wpaioab_menu_text_shadow_color_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_menu_text_shadow_color_enable']) && 1 == $wpaioab_options['wpaioab_menu_text_shadow_color_enable'] ) echo 'checked="checked"';  ?> />
				<label class="description" for="wpaioab_settings[wpaioab_menu_text_shadow_color_enable]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		 </div>		
		 <div class="colorpickerdiv"><label for="wpaioab_menu_text_shadow_color"><?php echo _e('Menu Item Text Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_text_shadow_color]" id="wpaioab_menu_text_shadow_color" class="admincolor" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_text_shadow_color'] ) ) echo $wpaioab_options['wpaioab_menu_text_shadow_color']; ?>" />
			<div id="wpaioab_menu_text_shadow_color_colorpicker"></div></div>

	 </div>

		 
		<div class="singlerowdiv">	
		<div class="colorlabeldiv">
			
				<input id="wpaioab_settings[wpaioab_menu_text_hover_shadow_color_enable]" name="wpaioab_settings[wpaioab_menu_text_hover_shadow_color_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable']) && 1 == $wpaioab_options['wpaioab_menu_text_hover_shadow_color_enable'] ) echo 'checked="checked"';  ?> />
				<label class="description" for="wpaioab_settings[wpaioab_menu_text_hover_shadow_color_enable]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		</div>		
		 <div class="colorpickerdiv"><label for="wpaioab_menu_text_hover_shadow_color"><?php echo _e('Menu Item Text Hover Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_text_hover_shadow_color]" class="admincolor" id="wpaioab_menu_text_hover_shadow_color" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_text_hover_shadow_color'] ) ) echo $wpaioab_options['wpaioab_menu_text_hover_shadow_color']; ?>" />
			<div id="wpaioab_menu_text_hover_shadow_color_colorpicker"></div></div>
		

		
	 </div> 
	 
	<div class="singlerowdiv">
		<div class="colorlabeldiv">
			
				<input id="wpaioab_settings[wpaioab_toolbarlinks_text_shadow_color_enable]" name="wpaioab_settings[wpaioab_toolbarlinks_text_shadow_color_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable']) && 1 == $wpaioab_options['wpaioab_toolbarlinks_text_shadow_color_enable'] ) echo 'checked="checked"';  ?> />
				<label class="description" for="wpaioab_settings[wpaioab_toolbarlinks_text_shadow_color_enable]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		</div>		
		 <div class="colorpickerdiv"><label for="wpaioab_toolbarlinks_text_shadow_color"><?php echo _e('Adminbar Links Text Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbarlinks_text_shadow_color]" id="wpaioab_toolbarlinks_text_shadow_color" class="admincolor" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_toolbarlinks_text_shadow_color'] ) ) echo $wpaioab_options['wpaioab_toolbarlinks_text_shadow_color']; ?>" />
			<div id="wpaioab_toolbarlinks_text_shadow_color_colorpicker"></div></div>

	</div>	
	 
	<div class="singlerowdiv">			
		<div class="colorlabeldiv">
			
				<input id="wpaioab_settings[wpaioab_toolbarlinks_text_hover_shadow_color_enable]" name="wpaioab_settings[wpaioab_toolbarlinks_text_hover_shadow_color_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable']) && 1 == $wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color_enable'] ) echo 'checked="checked"';  ?> />
				<label class="description" for="wpaioab_settings[wpaioab_toolbarlinks_text_hover_shadow_color_enable]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		</div>	
		 <div class="colorpickerdiv"><label for="wpaioab_toolbarlinks_text_hover_shadow_color"><?php echo _e('Adminbar Links Text Hover Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_toolbarlinks_text_hover_shadow_color]" class="admincolor" id="wpaioab_toolbarlinks_text_hover_shadow_color" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color'] ) ) echo $wpaioab_options['wpaioab_toolbarlinks_text_hover_shadow_color']; ?>" />
			<div id="wpaioab_toolbarlinks_text_hover_shadow_color_colorpicker"></div></div>
			
	 </div>	
	 
	 <div class="singlerowdiv" style="border-bottom-style:solid; border-bottom-color:#E9E9E9;margin-bottom:5px;">	
		<div class="colorlabeldiv">
			
				<input id="wpaioab_settings[wpaioab_search_text_shadow_color_enable]" name="wpaioab_settings[wpaioab_search_text_shadow_color_enable]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_search_text_shadow_color_enable']) && 1 == $wpaioab_options['wpaioab_search_text_shadow_color_enable'] ) echo 'checked="checked"';  ?> />
				<label class="description" for="wpaioab_settings[wpaioab_search_text_shadow_color_enable]"> 
				<?php echo _e('Enable', $this->plugin_slug);?>
				</label>
			
		</div>		 
		 <div class="colorpickerdiv"><label for="wpaioab_search_text_shadow_color"><?php echo _e('Search Box Text Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_search_text_shadow_color]" id="wpaioab_search_text_shadow_color" class="admincolor" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_search_text_shadow_color'] ) ) echo $wpaioab_options['wpaioab_search_text_shadow_color']; ?>" />
			<div id="wpaioab_search_text_shadow_color_colorpicker"></div></div>

	 </div>	
	<div style="padding-bottom:650px;"> 	  
	<h3><?php echo _e('Menu Shadows', $this->plugin_slug); ?></h3> 
	
	<div>
		<div class="singlerowdiv">	
			 <div class="colorlabeldiv">
			 <input id="wpaioab_settings[wpaioab_menu_shadow_status]" name="wpaioab_settings[wpaioab_menu_shadow_status]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_menu_shadow_status']) && 1 == $wpaioab_options['wpaioab_menu_shadow_status'] ) echo 'checked="checked"';  ?> />
			 <label class="description" for="wpaioab_settings[wpaioab_menu_shadow_status]"><?php echo _e('Enable', $this->plugin_slug);?></label></div>
			
			 <div class="colorpickerdiv"><label for="wpaioab_menu_shadows_color"><?php echo _e('Menu Shadow Color', $this->plugin_slug); ?>: </label></div>
			 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_shadows_color]" id="wpaioab_menu_shadows_color" class="admincolor" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_shadows_color'] ) ) echo $wpaioab_options['wpaioab_menu_shadows_color']; ?>" />
				<div id="wpaioab_menu_shadows_color_colorpicker"></div></div>

		</div> 

		<div class="singlerowdiv"  style="border-bottom-style:solid; border-bottom-color:#E9E9E9;margin-bottom:5px;padding-bottom:5px;">	
			 <div class="gradient-half">
				 <div class="gradient-half"><label for="wpaioab_menu_shadow_strength"><?php echo _e('Menu Shadow Type', $this->plugin_slug); ?>: </label></div>
				 <div class="gradient-half">
					 <select class="menu-location" name="wpaioab_settings[wpaioab_menu_shadow_strength]"  id="wpaioab_settings[wpaioab_menu_shadow_strength]" >
								<?php
										reset($menu_shadow_strengths);
										while (list($key, $val) = each($menu_shadow_strengths)) {
										if(isset($wpaioab_options['wpaioab_menu_shadow_strength']) && $wpaioab_options['wpaioab_menu_shadow_strength']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
										<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
										<?php } ?>
					</select>
				 </div>
			 </div>
			 <div class="gradient-half">
				<select class="menu-location" name="wpaioab_settings[wpaioab_menu_shadow_type]"  id="wpaioab_settings[wpaioab_menu_shadow_type]" >
								<?php
										reset($menu_shadow_types);
										while (list($key, $val) = each($menu_shadow_types)) {
										if(isset($wpaioab_options['wpaioab_menu_shadow_type']) && $wpaioab_options['wpaioab_menu_shadow_type']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
										<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
										<?php } ?>
				</select>
			 </div>
			<div class="singlerowdiv" style="margin-top:15px;" id="menu_shadow_sample_styles_table">	</div>
		</div> 
		
	</div>
	
	
	
	<h3><?php echo _e('Menu Item Shadows', $this->plugin_slug); ?></h3> 
	
	<div class="singlerowdiv">			
		<div class="colorlabeldiv"><input id="wpaioab_settings[wpaioab_menu_item_shadow_status]" name="wpaioab_settings[wpaioab_menu_item_shadow_status]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_menu_item_shadow_status']) && 1 == $wpaioab_options['wpaioab_menu_item_shadow_status'] ) echo 'checked="checked"';  ?> />
		<label class="description" for="wpaioab_settings[wpaioab_menu_item_shadow_status]"> <?php echo _e('Enable', $this->plugin_slug);?></label></div>		
		
		
		 <div class="colorpickerdiv"><label for="wpaioab_menu_item_shadows_color"><?php echo _e('Menu Item Hover Shadow Color', $this->plugin_slug); ?>: </label></div>
		 <div class="colorpickerdiv"><input name="wpaioab_settings[wpaioab_menu_item_shadows_color]" class="admincolor" id="wpaioab_menu_item_shadows_color" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_menu_item_shadows_color'] ) ) echo $wpaioab_options['wpaioab_menu_item_shadows_color']; ?>" />
			<div id="wpaioab_menu_item_shadows_color_colorpicker"></div></div>
		
	</div> 	
	<div class="singlerowdiv">			
		<div class="gradient-half"><label for="wpaioab_menu_item_shadow_strength"><?php echo _e('Menu Item Shadow Type', $this->plugin_slug); ?>: </label></div>
				 <div class="gradient-half">
					 <select class="menu-location" name="wpaioab_settings[wpaioab_menu_item_shadow_strength]"  id="wpaioab_settings[wpaioab_menu_item_shadow_strength]" >
								<?php
										reset($menu_item_shadow_strengths);
										while (list($key, $val) = each($menu_item_shadow_strengths)) {
										if(isset($wpaioab_options['wpaioab_menu_item_shadow_strength']) && $wpaioab_options['wpaioab_menu_item_shadow_strength']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
										<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
										<?php } ?>
					</select>
				 </div>
	</div>
	<div class="singlerowdiv" id="menu_item_shadow_sample_styles_table">	</div>

</div>


   </div>
   
   <div id="tabs-4">
   <div style="padding-bottom:200px;">
	<h3><?php echo _e('Add WordPress Menu To Admin Bar', $this->plugin_slug); ?></h3>	

		
		<?php $menus_list = get_terms('nav_menu'); ?>

		<?php foreach($menus_list as $each_menu){ ?>
		<h3><label class="description" for="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ) ?>]"> <?php echo _e($each_menu->name , $this->plugin_slug);?></label></h3>
		<div class="custom-menu-full">
			<div class="custom-menu-half">
			<?php echo _e('Select This Menu : ', $this->plugin_slug); ?>
			<input id="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name) ?>]" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name) ?>]" type="checkbox" value="1" <?php if ( isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name)]) && 1 == $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name)] ) echo 'checked="checked"';  ?> />
			</div>
			<div class="custom-menu-half">
				<div class="custom-menu-half"><?php echo _e('Menu Root / Location : ', $this->plugin_slug); ?></div>
				<div class="custom-menu-half">
				<select class="menu-location" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location' ?>]"  id="<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location' ?>"  onchange="manage_custom_menu_root(this.id)">
						<?php
								reset($menu_locations);
								while (list($key, $val) = each($menu_locations)) {
								if(isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location']) && $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								<?php } ?>
				</select>
				</div>
			</div>
			<div class="singlerowdiv">
			<table>
				<tr>
					<td width="150"><span ><?php echo _e('Icon Image (optional) : ', $this->plugin_slug); ?></span>
					<select class="menu-location" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'menu_icon_image_size' ?>]"  id="<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'menu_icon_image_size' ?>">
						<?php
								reset($menu_icon_image_sizes);
								while (list($key, $val) = each($menu_icon_image_sizes)) {
								if( isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'menu_icon_image_size']) && $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'menu_icon_image_size']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								<?php } ?>
					</select>
					</td>
					<td>
					<input type="text"  name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'image' ?>]" id="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'image' ?>]" value="<?php if ( isset( $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'image'] ) ) echo $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'image']; ?>" size="40" />
					<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
					<br /><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
					</td>
					<td> 
				</tr>
			</table>
			</div>

			<div class="custom-menu-half" id="<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_div' ?>">
			<div class="custom-menu-half">
				<?php echo _e('Custom Root Label : ', $this->plugin_slug); ?>
			</div>	
			<div class="custom-menu-half">
				<input class="custom-parent" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom' ?>]"  id="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom' ?>]" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom'] ) ) echo $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom']; ?>" />
			</div>
			</div>
			
			
			<div class="custom-menu-half" id="<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_url_div' ?>">
			<div class="custom-menu-half">
				<?php echo _e('Custom Root URL : ', $this->plugin_slug); ?>
			</div>	
			<div class="custom-menu-half">
				<input class="custom-parent" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom_url' ?>]"  id="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom_url' ?>]" type="text" value="<?php if ( isset( $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom_url'] ) ) echo $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'location_custom_url']; ?>" />
			</div>
			</div>
			
			
			
			<div class="custom-menu-half">
				<div class="custom-menu-half"><?php echo _e('Show This Menu For : ', $this->plugin_slug); ?></div>
				<div class="custom-menu-half">
				<select class="menu-location" name="wpaioab_settings[<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'user_status' ?>]"  id="<?php echo 'wpaioab_'. str_replace(' ', '', $each_menu->name ).'user_status' ?>" >
						<?php
								reset($show_menus_for);
								while (list($key, $val) = each($show_menus_for)) {
								if(isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'user_status']) && $wpaioab_options['wpaioab_'. str_replace(' ', '', $each_menu->name ).'user_status']==$key){$selected = 'selected="selected"';}else{ $selected ='';} ?>
								<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $val;?></option>
								<?php } ?>
				</select>
				</div>
			</div>
			
		</div>

		<?php }?>

	</div>	
   </div>
   
   <div id="tabs-5">
   <div style="padding-bottom:200px;height : auto">
   
   <div id="wpaioab_cover"> </div>
			
			<div class="custom-menu-half" id="custom_menu_selection">
				<table>
					<tr>
					<td style="width:50%;"><?php echo _e('Custom Menu Root Label : ', $this->plugin_slug); ?></td>
					<td style="width:50%;"><select  name='custom_menu_roots'  id='custom_menu_roots' ></select></td>
					</tr>
				</table>	
			</div>
			
			<div class="custom-menu-half" id="add_delete_wait">
				
			</div>
			<div class="singlerowdiv" id="new_custom_root_content">
			<hr>
			<label class="description" style="color:#0D0A61;font-weight:bold;"><?php echo _e('Add New Custom Menu Root', $this->plugin_slug); ?></label>
				<table width="100%">
					<tr>
						<td style="width:25%;"><?php echo _e('New Custom Menu Root Label : ', $this->plugin_slug); ?></td>
						<td style="width:20%;"><input type="text"  name="new_custom_root_label" id="new_custom_root_label"/></td>
						<td style="width:25%;"><?php echo _e('New Custom Menu Root URL : ', $this->plugin_slug); ?></td>
						<td style="width:20%;"><input type="text"  name="new_custom_root_url" id="new_custom_root_url"/></td>
						<td style="width:10%;"><a id="btn_add_root" class="wpaioab-add-button" href="#"  onclick="add_new_menu_root()"><?php echo _e('Add', $this->plugin_slug); ?></a></td>
					</tr>
					<tr>
						<td style="width:25%;">
							<?php echo _e('Icon Image (optional) : ', $this->plugin_slug); ?>
								<select class="menu-location" name="wpaioab_custom_menu_root_image_size"  id="wpaioab_custom_menu_root_image_size" >
										<?php
										reset($menu_icon_image_sizes);
										while (list($key, $val) = each($menu_icon_image_sizes)) {?>
											<option value="<?php echo $key ?>"><?php echo $val;?></option>
										<?php } ?>
								</select>
						</td>
						<td colspan="4">
							<input type="text"  name="wpaioab_custom_menu_root_image" id="wpaioab_custom_menu_root_image" size="40" />
							<input type="button" class="wpaioab-upload-button button" value="Upload Image" />
							<br/><span><?php echo _e('Upload an image from your computer or enter the image location.', $this->plugin_slug); ?></span>
						</td>
					</tr>
					<tr>
					<td colspan="1"><?php echo _e('Show This Menu For : ', $this->plugin_slug); ?>
					</td>
					<td colspan="2">
						<select class="menu-location" name="wpaioab_custom_menu_visibility"  id="wpaioab_custom_menu_visibility" >
							<?php
								reset($show_menus_for);
								while (list($key, $val) = each($show_menus_for)) {?>
									<option value="<?php echo $key ?>" ><?php echo $val;?></option>
							<?php } ?>
						</select>
					</td>
					<td colspan="2"></td>
					</tr>
				</table>
				<hr>
			</div>
			
			
			<div class="singlerowdiv" id="new_custom_item_content">
				<hr>
				<label class="description" style="color:#056902;font-weight:bold;"><?php echo _e('Add New Custom Menu Item', $this->plugin_slug); ?></label>
				<table width="100%">
					<tr>
					<td style="width:25%;"><?php echo _e('New Custom Menu Item Label : ', $this->plugin_slug); ?></td>
					<td style="width:20%;"><input type="text"  name="new_custom_item_label" id="new_custom_item_label"/></td>
					<td style="width:25%;"><?php echo _e('New Custom Menu Item URL : ', $this->plugin_slug); ?></td>
					<td style="width:20%;"><input type="text"  name="new_custom_item_url" id="new_custom_item_url"/></td>
					<td style="width:10%;"><a id="btn_add_item" class="wpaioab-add-button" href="#"  onclick="add_new_menu_item()"><?php echo _e('Add', $this->plugin_slug); ?></a></td>
					</tr>
				</table>
				<hr>
			</div>
						
						
			<div class="singlerowdiv" id="new_custom_child_item_content">
				<hr>
				<label class="description" style="color:#C8AD01;font-weight:bold;"><?php echo _e('Add New Sub Menu Item', $this->plugin_slug); ?></label>
				<table width="100%">
					<tr>
					<td style="width:25%;"><input type="hidden"  name="current_menu_item_key" id="current_menu_item_key"/><?php echo _e('New Sub Menu Item Label : ', $this->plugin_slug); ?></td>
					<td style="width:20%;"><input type="text"  name="new_custom_child_item_label" id="new_custom_child_item_label"/></td>
					<td style="width:25%;"><?php echo _e('New Sub Menu Item URL : ', $this->plugin_slug); ?></td>
					<td style="width:20%;"><input type="text"  name="new_custom_child_item_url" id="new_custom_child_item_url"/></td>
					<td style="width:10%;"><a id="btn_add_child" class="wpaioab-add-button" href="#"  onclick="add_new_child_item()"><?php echo _e('Add', $this->plugin_slug); ?></a></td>
					</tr>
				</table>
				<hr>
			</div>
			
			
			<div class="singlerowdiv" id="custom_menu_content" align="center"></div>
		
		
		</div>
   </div>
   
   
   <div id="tabs-6">
	   <textarea rows="15" cols="100" id="wpaioab_custom_css" name="wpaioab_settings[wpaioab_custom_css]" style="resize: none;" ><?php if ( isset( $wpaioab_options['wpaioab_custom_css'] ) ) echo $wpaioab_options['wpaioab_custom_css']; ?></textarea>
   </div>
   
   </div> 

	
	
	</form>

</div>



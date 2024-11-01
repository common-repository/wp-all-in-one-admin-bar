<?php

class Wordpress_All_In_One_Adminbar_Custom_Menu
{

	protected static $instance = null;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function get_custom_menus() {
	
		global $wpaioab_options;
		if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
			die ( 'Invalid Nonce' );
			
		echo json_encode( array(
			'current_menu_structure' => $this->make_current_menu_structure('select'),
			'menu_roots_select_box' => $this->make_menu_roots_select_box('select'),
			'custom_root_array' => $this->get_wp_menu_status(),
			'ret_non' => wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ),
			'success' => 1
		) );
		exit;
		
	}
	
	private function get_wp_menu_status(){
	
		global $wpaioab_options;
		$custom_root_array = array();
		$menus = get_terms('nav_menu');
		
			foreach($menus as $menu){
			
					$custom_parent = (isset($wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location'])) ? $wpaioab_options['wpaioab_'. str_replace(' ', '', $menu->name ).'location'] : "";
					
					if( empty($custom_parent) || $custom_parent != 'custom'){
						$custom_root_array[] = 'wpaioab_'. str_replace(' ', '', $menu->name ).'location';
					}
					
			}

		return $custom_root_array;
		
	}

	private function make_output_table(){
	
	global $wpaioab_options;
	
	$custom_root_labels = $wpaioab_options['custom_root_labels'];
	$custom_root_urls = $wpaioab_options['custom_root_urls'];
	reset($custom_root_labels);
		
		while (list($root_label_key, $root_label_value) = each($custom_root_labels)) {
		$table .= "<table>
			<tr>
				<td>Root Label</td>
				<td><input name='wpaioab_settings[custom_root_labels][$root_label_key]' type='text' value='$root_label_value' /></td>
				<td>Root URL</td>
				<td><input name='wpaioab_settings[custom_root_urls][$root_label_key]' type='text' value='".$custom_root_urls[$root_label_key]."' /></td>
				<td><a id='$root_label_key' href='#' onclick='delete_menu_item(this.id)'>Delete</a></td>
			</tr>
		</table>";						
		}

	return $table;
	}

	public function load_current_menu_structure(){
	
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );
			
	$root_key = $_REQUEST['root_key'];

		echo json_encode( array(
			
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'success' => 1
		) );
		exit;

	}
	
	private function make_menu_roots_select_box($root_key){
		global $wpaioab_options;
		$custom_root_labels = $wpaioab_options['custom_root_labels'];
		
			reset($custom_root_labels);
		
			$menu_roots_select_box = "<option value='select' >Select</option>";
			
									while (list($custom_root_key, $custom_root_value) = each($custom_root_labels)) {
										if($custom_root_key == $root_key){$selected = 'selected="selected"';}else{ $selected ='';} 
										$menu_roots_select_box .= "<option value='$custom_root_key' $selected >$custom_root_value</option>";
									} 
									
			$menu_roots_select_box .= "<option value='add_new' >Add New</option>";
			
		return $menu_roots_select_box;
	}

	private function make_current_menu_structure($root_key){
	
	global $wpaioab_options;
	global $menu_icon_image_sizes;
	global $show_menus_for;

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
	if(isset($custom_menu_visibility)) reset($custom_menu_visibility);
	
	$current_menu_structure = "";
	while (list($root_label_key, $root_label_value) = each($custom_root_labels)) {
	
	if($root_label_key == $root_key){
	
	$current_menu_structure .= "<div><table class='wpaioab-table' width='100%'>";
	$selected_image_size = "<select  name='wpaioab_settings[custom_root_image_sizes][$root_label_key]'  id='wpaioab_settings[custom_root_image_sizes][$root_label_key]' value='wpaioab_settings[custom_root_image_sizes][$root_label_key]' >";
										reset($menu_icon_image_sizes);
											while (list($key, $val) = each($menu_icon_image_sizes)) {
												if( isset($custom_root_image_sizes[$root_label_key]) && $custom_root_image_sizes[$root_label_key]==$key){$selected = 'selected="selected"';}else{ $selected ='';} 
													$selected_image_size .= "<option value='$key' $selected >$val</option>";
											} 
	$selected_image_size .= "</select>";
	
	$selected_visibility = "<select  name='wpaioab_settings[custom_menu_visibility][$root_label_key]'  id='wpaioab_settings[custom_menu_visibility][$root_label_key]' value='wpaioab_settings[custom_menu_visibility][$root_label_key]' >";
										reset($show_menus_for);
											while (list($show_menus_key, $show_menus_val) = each($show_menus_for)) {
												if( isset($custom_menu_visibility[$root_label_key]) && $custom_menu_visibility[$root_label_key]==$show_menus_key){$selected = 'selected="selected"';}else{ $selected ='';} 
													$selected_visibility .= "<option value='$show_menus_key' $selected >$show_menus_val</option>";
											} 
	$selected_visibility .= "</select>";

	$current_menu_structure .= "<caption>".__('Menu Icon Image Size: ')."$selected_image_size  ".__('Menu Icon Image URL : ')."<input type='text'  name='wpaioab_settings[custom_root_images][$root_label_key]' id='wpaioab_settings[custom_root_images][$root_label_key]' size='40' value='$custom_root_images[$root_label_key]'/></caption>";
	
	$current_menu_structure .= "<tr>
					<th style='width:18%;'>$custom_root_labels[$root_key]</th>
					<th style='width:35%;' colspan='2'>".__('Show This Menu For : ')."</th>
					
					<th style='width:37%;' colspan='2'>$selected_visibility</th>
					
					<th style='width:10%;'><a class='wpaioab-delete-button' style='color: #FFFFFF;' id='$root_key' href='#' onclick='delete_custom_menu()'>Delete</a></th>
				</tr>
				
				<tr class='wpaioab-custom-menu-root' >
					<td><label class='description' for='wpaioab_settings[custom_root_labels][$root_key]'>".__('Menu Root Label : ')."</label></td>
					<td><input class='wpaioab-text-box' name='wpaioab_settings[custom_root_labels][$root_key]' type='text' value='$custom_root_labels[$root_key]' /></td>
					<td><label class='description' for='wpaioab_settings[custom_root_urls][$root_key]'>".__('Menu Root URL : ')."</label></td>
					<td colspan='2'><input name='wpaioab_settings[custom_root_urls][$root_key]' type='text' value='$custom_root_urls[$root_key]' /></td>
					
					<td></td>
				</tr>";
		} else {
		
		$current_menu_structure .= "<input name='wpaioab_settings[custom_root_labels][$root_label_key]' type='hidden' value='$custom_root_labels[$root_label_key]' />
					<input name='wpaioab_settings[custom_root_urls][$root_label_key]' type='hidden' value='$custom_root_urls[$root_label_key]' />
					<input type='hidden'  name='wpaioab_settings[custom_root_images][$root_label_key]' id='wpaioab_settings[custom_root_images][$root_label_key]'  value='$custom_root_images[$root_label_key]'/>
					<input type='hidden'  name='wpaioab_settings[custom_root_image_sizes][$root_label_key]'  id='wpaioab_settings[custom_root_image_sizes][$root_label_key]' value='$custom_root_image_sizes[$root_label_key]'/>
					<input type='hidden'  name='wpaioab_settings[custom_menu_visibility][$root_label_key]'  id='wpaioab_settings[custom_menu_visibility][$root_label_key]' value='$custom_menu_visibility[$root_label_key]'/>";		

		}	

		if((array_key_exists($root_label_key, $custom_item_labels)) ){
		
			$current_menu_item_labels = (isset($custom_item_labels[$root_label_key])) ? $custom_item_labels[$root_label_key] :array();
			$current_menu_item_urls = (isset($custom_item_urls[$root_label_key])) ? $custom_item_urls[$root_label_key] :array();
			
			if(isset($current_menu_item_labels)) reset($current_menu_item_labels);
			if(isset($current_menu_item_urls)) reset($current_menu_item_urls);	
			
			while (list($item_label_key, $item_label_value) = each($current_menu_item_labels)) {
			
			if($root_label_key == $root_key){
			
			$current_menu_structure .= "<tr class='wpaioab-custom-menu-item'>
											<td><label class='description' for='wpaioab_settings[custom_item_labels][$root_key][$item_label_key]'>".__('Menu Item Label : ')."</label></td>
											<td><input class='wpaioab-text-box' name='wpaioab_settings[custom_item_labels][$root_key][$item_label_key]' type='text' value='$item_label_value' /></td>
											<td><label class='description' for='wpaioab_settings[custom_item_urls][$root_key][$item_label_key]'>".__('Menu Item URL : ')."</label></td>
											<td><input name='wpaioab_settings[custom_item_urls][$root_key][$item_label_key]' type='text' value='$current_menu_item_urls[$item_label_key]' /></td>
											<td align='center' ><a class='wpaioab-add-button' style='color: #FFFFFF;' id='$item_label_key' href='#' onclick='display_new_child_item_content(this.id)'>New Submenu Item</a></td>
											<td align='center' ><a class='wpaioab-delete-button' style='color: #FFFFFF;' id='$item_label_key' href='#' onclick='delete_custom_item(this.id)'>Delete</a></td>
										</tr>";	
			} else {
			
			$current_menu_structure .= "<input name='wpaioab_settings[custom_item_labels][$root_label_key][$item_label_key]' type='hidden' value='$item_label_value' />
										<input name='wpaioab_settings[custom_item_urls][$root_label_key][$item_label_key]' type='hidden' value='$current_menu_item_urls[$item_label_key]' />";	
										
			}
			
										if (isset($custom_child_labels) && array_key_exists($root_label_key, $custom_child_labels) && array_key_exists($item_label_key, $custom_child_labels[$root_label_key])){
										
											$current_item_child_labels = $custom_child_labels[$root_label_key][$item_label_key];
											$current_item_child_urls = $custom_child_urls[$root_label_key][$item_label_key];
												
												if(count($custom_root_labels) > 0){
												
													if(isset($current_item_child_labels)) reset($current_item_child_labels);
													if(isset($current_item_child_urls)) reset($current_item_child_urls);	
													
														while (list($child_item_label_key, $child_item_label_value) = each($current_item_child_labels)) {
																if($root_label_key == $root_key){
																$current_menu_structure .= "<tr class='wpaioab-custom-child-item'>
																								<td></td>
																								<td><label class='description' for='wpaioab_settings[custom_child_labels][$root_key][$item_label_key][$child_item_label_key]'>".__('Submenu Item Label : ')."</label></td>
																								<td><input class='wpaioab-text-box' name='wpaioab_settings[custom_child_labels][$root_key][$item_label_key][$child_item_label_key]' type='text' value='$child_item_label_value' /></td>
																								<td><label class='description' for='wpaioab_settings[custom_child_urls][$root_key][$item_label_key][$child_item_label_key]'>".__('Submenu Item URL : ')."</label></td>
																								<td><input name='wpaioab_settings[custom_child_urls][$root_key][$item_label_key][$child_item_label_key]' type='text' value='$current_item_child_urls[$child_item_label_key]' /></td>
																								<td align='center' ><a class='wpaioab-delete-button' style='color: #FFFFFF;' id='$item_label_key^$child_item_label_key' href='#' onclick='delete_custom_item_child(this.id)'>Delete</a></td>
																							</tr>";		
																} else {
																
																$current_menu_structure .= "<input name='wpaioab_settings[custom_child_labels][$root_label_key][$item_label_key][$child_item_label_key]' type='hidden' value='$child_item_label_value' />
																							<input name='wpaioab_settings[custom_child_urls][$root_label_key][$item_label_key][$child_item_label_key]' type='hidden' value='$current_item_child_urls[$child_item_label_key]' />";

																}
														}

												}
										}
			}
		}
		if($root_label_key == $root_key){
		$current_menu_structure .=	"</table></div>";
		}	
	}
	
			
	return $current_menu_structure;
	
	}

	public function add_new_menu_root(){
	
	global $wpaioab_options;
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );
			
	$custom_root_labels;
	$custom_root_label = $_REQUEST['root_label'];
	
	$custom_root_urls;
	$custom_root_url = $_REQUEST['root_url'];
	
	$custom_root_images;
	$custom_root_image = $_REQUEST['root_image'];
	
	$custom_root_image_sizes;
	$custom_root_image_size = $_REQUEST['root_image_size'];
	
	$custom_menu_visibility;
	$current_menu_visibility = $_REQUEST['menu_visibility'];
	
	$root_key;

		$custom_root_labels = isset($wpaioab_options['custom_root_labels']) ? $wpaioab_options['custom_root_labels'] : array();
		$custom_root_urls = isset($wpaioab_options['custom_root_urls']) ? $wpaioab_options['custom_root_urls'] : array();
		$custom_root_images = isset($wpaioab_options['custom_root_images']) ? $wpaioab_options['custom_root_images'] : array();
		$custom_root_image_sizes = isset($wpaioab_options['custom_root_image_sizes']) ? $wpaioab_options['custom_root_image_sizes'] : array();
		$custom_menu_visibility = isset($wpaioab_options['custom_menu_visibility']) ? $wpaioab_options['custom_menu_visibility'] : array();

	
		$custom_root_labels_size = count($custom_root_labels);
		
		reset($custom_root_labels);
		reset($custom_root_urls);
		reset($custom_root_images);
		reset($custom_root_image_sizes);
		reset($custom_menu_visibility);
		
		if($custom_root_labels_size == 0){
		
			$custom_root_labels['root1'] = $custom_root_label;
			$custom_root_urls['root1'] = $custom_root_url;
			$custom_root_images['root1'] = $custom_root_image;
			$custom_root_image_sizes['root1'] = $custom_root_image_size;
			$custom_menu_visibility['root1'] = $current_menu_visibility;
			
			$root_key = 'root1';
			
		} else {

			$custom_root_labels_keys = array_keys($custom_root_labels);
			$last_custom_root_label = end($custom_root_labels_keys);

			$next_digit = $this->get_next_digit($last_custom_root_label);
			
			$custom_root_labels["root$next_digit"] = $custom_root_label; 
			$custom_root_urls["root$next_digit"] = $custom_root_url; 
			$custom_root_images["root$next_digit"] = $custom_root_image;
			$custom_root_image_sizes["root$next_digit"] = $custom_root_image_size;
			$custom_menu_visibility["root$next_digit"] = $current_menu_visibility;
			
			$root_key = "root$next_digit";
			
		}
		
		$wpaioab_options['custom_root_labels'] = $custom_root_labels;
		$wpaioab_options['custom_root_urls'] = $custom_root_urls;
		$wpaioab_options['custom_root_images'] = $custom_root_images;
		$wpaioab_options['custom_root_image_sizes'] = $custom_root_image_sizes;
		$wpaioab_options['custom_menu_visibility'] = $custom_menu_visibility;
		
		update_option('wpaioab_settings', $wpaioab_options);

		echo json_encode( array(
		
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'menu_roots_select_box' => $this->make_menu_roots_select_box($root_key),
			'success' => 1
			
		) );
		exit;	
		
	}
	
	private function get_next_digit($label){
	
		$label_digit = preg_replace("/[^0-9]/", "", $label);
		return intval($label_digit)+1;
		
	}
	
	public function add_new_menu_item(){
	
	global $wpaioab_options;

	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );
			
	$root_key = $_REQUEST['root_key'];
	$custom_item_labels;
	$custom_item_label = $_REQUEST['item_label'];
	$custom_item_urls;
	$custom_item_url = $_REQUEST['item_url'];
	
		$custom_item_labels = isset($wpaioab_options['custom_item_labels']) ? $wpaioab_options['custom_item_labels'] : array();
		$custom_item_urls = isset($wpaioab_options['custom_item_urls']) ? $wpaioab_options['custom_item_urls'] : array();

		reset($custom_item_labels);
		reset($custom_item_urls);

		if(!array_key_exists($root_key, $custom_item_labels) ){
		
			$custom_item_labels[$root_key] = array('item1' => $custom_item_label);
			$custom_item_urls[$root_key] = array('item1' => $custom_item_url);

		} else {

			$current_root_menu_item_labels = $custom_item_labels[$root_key];
			$current_root_menu_item_urls = $custom_item_urls[$root_key];
			
			$current_root_menu_item_keys = array_keys($current_root_menu_item_labels);
			$current_root_last_menu_item_key = end($current_root_menu_item_keys);

			$next_digit = $this->get_next_digit($current_root_last_menu_item_key);
			
			$current_root_menu_item_labels["item$next_digit"] = $custom_item_label; 
			$current_root_menu_item_urls["item$next_digit"] = $custom_item_url; 
			
			$custom_item_labels[$root_key] = $current_root_menu_item_labels;
			$custom_item_urls[$root_key] = $current_root_menu_item_urls;
			
		}
		
		$wpaioab_options['custom_item_labels'] = $custom_item_labels;
		$wpaioab_options['custom_item_urls'] = $custom_item_urls;
		
		update_option('wpaioab_settings', $wpaioab_options);

		echo json_encode( array(
		
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'success' => 1
		) );
		exit;
	
	}

	public function add_new_child_item(){
	
		global $wpaioab_options;
		if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
			die ( 'Invalid Nonce' );
			
		$root_key = $_REQUEST['root_key'];
		$item_key = $_REQUEST['item_key'];
		$custom_child_labels;
		$custom_child_label = $_REQUEST['item_label'];
		$custom_child_urls;
		$custom_child_url = $_REQUEST['item_url'];	
		
				$custom_child_labels = isset($wpaioab_options['custom_child_labels']) ? $wpaioab_options['custom_child_labels'] : array(array(array()));
				$custom_child_urls = isset($wpaioab_options['custom_child_urls']) ? $wpaioab_options['custom_child_urls'] : array(array(array()));

				reset($custom_child_labels);
				reset($custom_child_urls);
				
			if(empty($custom_child_labels[$root_key][$item_key]['child1'])){
			
				$custom_child_labels[$root_key][$item_key]['child1'] = $custom_child_label;
				$custom_child_urls[$root_key][$item_key]['child1'] =  $custom_child_url;
				
			} else {

				
				$current_root_menu_item_labels = $custom_child_labels[$root_key];
				$current_root_menu_item_urls = $custom_child_urls[$root_key];
				
				$current_menu_item_child_labels = $current_root_menu_item_labels[$item_key];
				$current_menu_item_child_urls = $current_root_menu_item_urls[$item_key];
				
				$last_custom_child_keys = array_keys($current_menu_item_child_labels);
				$last_custom_child_item_key = end($last_custom_child_keys);
				$next_digit = $this->get_next_digit($last_custom_child_item_key);
				
				$current_menu_item_child_labels["child$next_digit"] = $custom_child_label; 
				$current_menu_item_child_urls["child$next_digit"] = $custom_child_url;

				$current_root_menu_item_labels[$item_key] = $current_menu_item_child_labels;
				$current_root_menu_item_urls[$item_key] = $current_menu_item_child_urls;
				
				$custom_child_labels[$root_key] = $current_root_menu_item_labels;
				$custom_child_urls[$root_key] = $current_root_menu_item_urls;

			}
			
		$wpaioab_options['custom_child_labels'] = $custom_child_labels;
		$wpaioab_options['custom_child_urls'] = $custom_child_urls;
			
		update_option('wpaioab_settings', $wpaioab_options);	

		echo json_encode( array(
			
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'success' => 1
		) );
		exit;	

	}

	public function delete_custom_menu(){
	
	global $wpaioab_options;
	
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );
				
	$root_key = $_REQUEST['root_key'];
	
	$custom_root_labels = $wpaioab_options['custom_root_labels'];
	$custom_root_urls = $wpaioab_options['custom_root_urls'];	
	$custom_root_images = $wpaioab_options['custom_root_images'];
	$custom_root_image_sizes = $wpaioab_options['custom_root_image_sizes'];
	
	$custom_item_labels = $wpaioab_options['custom_item_labels'];
	$custom_item_urls = $wpaioab_options['custom_item_urls'];
	
	if(isset($wpaioab_options['custom_child_labels'])){
		$custom_child_labels = $wpaioab_options['custom_child_labels'];
		$custom_child_urls = $wpaioab_options['custom_child_urls'];
	}
	
	unset($custom_root_labels[$root_key]);
	unset($custom_root_urls[$root_key]);
	unset($custom_root_images[$root_key]);
	unset($custom_root_image_sizes[$root_key]);
	unset($custom_item_labels[$root_key]);
	unset($custom_item_urls[$root_key]);
	if(isset($custom_child_labels)) unset($custom_child_labels[$root_key]);
	if(isset($custom_child_urls)) unset($custom_child_urls[$root_key]);
	
	$wpaioab_options['custom_root_labels'] = $custom_root_labels;
	$wpaioab_options['custom_root_urls'] = $custom_root_urls;
	$wpaioab_options['custom_root_images'] = $custom_root_images;
	$wpaioab_options['custom_root_image_sizes'] = $custom_root_image_sizes;
	
	$wpaioab_options['custom_item_labels'] = $custom_item_labels;
	$wpaioab_options['custom_item_urls'] = $custom_item_urls;
	
	if(isset($wpaioab_options['custom_child_labels'])){
		$wpaioab_options['custom_child_labels'] = $custom_child_labels;
		$wpaioab_options['custom_child_urls'] = $custom_child_urls;
	}		
		update_option('wpaioab_settings', $wpaioab_options);	
			

		echo json_encode( array(
			
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'menu_roots_select_box' => $this->make_menu_roots_select_box('select'),
			'success' => 1
			
		) );
		exit;	
	
	}

	public function delete_custom_item(){
	
	global $wpaioab_options;
	
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );
			
		
	$root_key = $_REQUEST['root_key'];
	$item_key = $_REQUEST['item_key'];
	
	$custom_item_labels = $wpaioab_options['custom_item_labels'];
	$custom_item_urls = $wpaioab_options['custom_item_urls'];
	
	if(isset($wpaioab_options['custom_child_labels'])){
		$custom_child_labels = $wpaioab_options['custom_child_labels'];
		$custom_child_urls = $wpaioab_options['custom_child_urls'];
	}

	unset($custom_item_labels[$root_key][$item_key]);
	unset($custom_item_urls[$root_key][$item_key]);
	
	if(isset($custom_child_labels) && array_key_exists($root_key, $custom_child_labels)){
		$item_child_labels = $custom_child_labels[$root_key];
	}
	
	if (isset($item_child_labels) &&  array_key_exists($item_key, $item_child_labels)) {
		unset($custom_child_labels[$root_key][$item_key]);
		unset($custom_child_urls[$root_key][$item_key]);
	}

	$wpaioab_options['custom_item_labels'] = $custom_item_labels;
	$wpaioab_options['custom_item_urls'] = $custom_item_urls;
	
		if(isset($wpaioab_options['custom_child_labels'])){
			$wpaioab_options['custom_child_labels'] = $custom_child_labels;
			$wpaioab_options['custom_child_urls'] = $custom_child_urls;
		}
		
		update_option('wpaioab_settings', $wpaioab_options);	

		echo json_encode( array(
			
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'menu_roots_select_box' => $this->make_menu_roots_select_box($root_key),
			'success' => 1
			
		) );
		exit;	
	
	
	
	}

	public function delete_custom_item_child(){
	
	global $wpaioab_options;
	
	if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'custom-menu-nonce' ) )
		die ( 'Invalid Nonce' );

	$root_key = $_REQUEST['root_key'];
	$item_key = $_REQUEST['item_key'];
	$child_key = $_REQUEST['child_key'];

	$custom_child_labels = $wpaioab_options['custom_child_labels'];
	$custom_child_urls = $wpaioab_options['custom_child_urls'];

			unset($custom_child_labels[$root_key][$item_key][$child_key]);
			unset($custom_child_urls[$root_key][$item_key][$child_key]);

	$wpaioab_options['custom_child_labels'] = $custom_child_labels;
	$wpaioab_options['custom_child_urls'] = $custom_child_urls;
			
		update_option('wpaioab_settings', $wpaioab_options);	

		echo json_encode( array(
			
			'current_menu_structure' => $this->make_current_menu_structure($root_key),
			'menu_roots_select_box' => $this->make_menu_roots_select_box($root_key),
			'success' => 1
			
		) );
		exit;	
	
	
	
	}	

}

?>
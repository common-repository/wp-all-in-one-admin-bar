function delete_custom_menu(){

	var accept=confirm("Are you sure you want to delete this ?");
	if (accept==true){

	jQuery("#wpaioab_cover").css("display", "block");	
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");
	
     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'delete-custom-menu',
			   'nonce': CustomMenu.nonce,
			   'root_key' : jQuery('#custom_menu_roots').val()
               },
          dataType: 'JSON',
          success:function(data){
							if(data.success == 1){
							
								 jQuery("#wpaioab_cover").css("display", "none");
								 jQuery("#wpaioab_submit").attr('disabled', false);
								 jQuery('#add_delete_wait').html("");
								 
								 jQuery('#custom_menu_roots').html(data.menu_roots_select_box);
								 jQuery('#custom_menu_content').html(data.current_menu_structure);
								 
								 jQuery("#custom_menu_content").show();
								 jQuery("#new_custom_item_content").hide();
								 jQuery("#new_custom_root_content").hide();
								 jQuery("#new_custom_child_item_content").hide();
								 
								 jQuery('#new_custom_root_label').val("");
								 jQuery('#new_custom_root_url').val("");
								 
								}
							 },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }

     });	
	
	}
}



function delete_custom_item(item_key){

	var accept=confirm("Are you sure you want to delete this ?");
	if (accept==true){

	jQuery("#wpaioab_cover").css("display", "block");
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");
	
     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'delete-custom-item',
			   'nonce': CustomMenu.nonce,
			   'root_key' : jQuery('#custom_menu_roots').val(),
			   'item_key' : item_key,
			   
               },
          dataType: 'JSON',
          success:function(data){
							if(data.success == 1){
							
								 jQuery("#wpaioab_cover").css("display", "none");
								 jQuery("#wpaioab_submit").attr('disabled', false);
								 jQuery('#add_delete_wait').html("");
								 
								 jQuery('#custom_menu_roots').html(data.menu_roots_select_box);
								 jQuery('#custom_menu_content').html(data.current_menu_structure);
								 
								 jQuery("#custom_menu_content").show();
								 jQuery("#new_custom_item_content").show();
								 jQuery("#new_custom_root_content").hide();
								 jQuery("#new_custom_child_item_content").hide();
								 
								 jQuery('#new_custom_root_label').val("");
								 jQuery('#new_custom_root_url').val("");
								}
							 },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }

     });	
	}
}




function delete_custom_item_child(item_key_child_key){

	var accept=confirm("Are you sure you want to delete this ?");
	if (accept==true){
	
	jQuery("#wpaioab_cover").css("display", "block");
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");
	
	var keys = item_key_child_key.split("^");
	
     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'delete-custom-item-child',
			   'nonce': CustomMenu.nonce,
			   'root_key' : jQuery('#custom_menu_roots').val(),
			   'item_key' : keys[0],
			   'child_key' : keys[1],
			   
               },
          dataType: 'JSON',
          success:function(data){
						if(data.success == 1){
						
								 jQuery("#wpaioab_cover").css("display", "none");
								 jQuery("#wpaioab_submit").attr('disabled', false);
								 jQuery('#add_delete_wait').html("");
								 
								 jQuery('#custom_menu_roots').html(data.menu_roots_select_box);
								 jQuery('#custom_menu_content').html(data.current_menu_structure);
								 
								 jQuery("#custom_menu_content").show();
								 jQuery("#new_custom_item_content").show();
								 jQuery("#new_custom_root_content").hide();
								 jQuery("#new_custom_child_item_content").hide();
								 
								 jQuery('#new_custom_root_label').val("");
								 jQuery('#new_custom_root_url').val("");
								 
								}
							 },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }

     });	
	}
}




function add_new_menu_root(){

	jQuery("#wpaioab_cover").css("display", "block");
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");

     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'new-menu-root',
			   'nonce': CustomMenu.nonce,
			   'root_label' : jQuery('#new_custom_root_label').val(),
			   'root_url' : jQuery('#new_custom_root_url').val(),
			   'root_image' : jQuery('#wpaioab_custom_menu_root_image').val(),
			   'root_image_size' : jQuery('#wpaioab_custom_menu_root_image_size').val(),
			   'menu_visibility' : jQuery('#wpaioab_custom_menu_visibility').val(),
			   
               },
          dataType: 'JSON',
          success:function(data){
		  
							if(data.success == 1){
							
								 jQuery("#wpaioab_cover").css("display", "none");
								 jQuery("#wpaioab_submit").attr('disabled', false);
								 jQuery('#add_delete_wait').html("");
								 jQuery('#custom_menu_roots').html(data.menu_roots_select_box);
								 jQuery('#custom_menu_content').html(data.current_menu_structure);
								 jQuery("#custom_menu_content").show();
								 jQuery("#new_custom_item_content").show();
								 jQuery("#new_custom_root_content").hide();
								 jQuery('#new_custom_root_label').val("");
								 jQuery('#new_custom_root_url').val("");
								 
							 }
                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }
           
 
     });			
	
}

function add_new_menu_item(){

	jQuery("#wpaioab_cover").css("display", "block");
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");
    
     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'new-menu-item',
			   'nonce': CustomMenu.nonce,
			   'item_label' : jQuery('#new_custom_item_label').val(),
			   'item_url' : jQuery('#new_custom_item_url').val(),
			   'root_key' : jQuery('#custom_menu_roots').val(),
			   
               },
          dataType: 'JSON',
          success:function(data){
					 if(data.success == 1){
					 
						 jQuery("#wpaioab_cover").css("display", "none");
					 	 jQuery("#wpaioab_submit").attr('disabled', false);
						 jQuery('#add_delete_wait').html("");
						 jQuery('#custom_menu_content').html(data.current_menu_structure);
						 jQuery("#custom_menu_content").show();
						 jQuery('#new_custom_item_label').val("");
						 jQuery('#new_custom_item_url').val("");
					 }           
				 },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          } 
 
     });			
	
}


function add_new_child_item(){

	jQuery("#wpaioab_cover").css("display", "block");
	jQuery("#wpaioab_submit").attr('disabled', true);
	jQuery('#add_delete_wait').html("Please Wait ..........");
	
     jQuery.ajax({
          url: '../wp-admin/admin-ajax.php',
          data:{
               'action':'new-child-item',
			   'nonce': CustomMenu.nonce,
			   'item_label' : jQuery('#new_custom_child_item_label').val(),
			   'item_url' : jQuery('#new_custom_child_item_url').val(),
			   'root_key' : jQuery('#custom_menu_roots').val(),
			   'item_key' : jQuery('#current_menu_item_key').val(),
			   
               },
          dataType: 'JSON',
		  
          success:function(data){
								 if(data.success == 1){
								 
									 jQuery("#wpaioab_cover").css("display", "none");
									 jQuery("#wpaioab_submit").attr('disabled', false);
									 jQuery('#add_delete_wait').html("");
									 jQuery('#custom_menu_content').html(data.current_menu_structure);	
									 jQuery("#custom_menu_content").show();
									 jQuery('#new_custom_child_item_label').val("");
									 jQuery('#new_custom_child_item_url').val("");
									 jQuery('#current_menu_item_key').val("");
									 jQuery("#new_custom_child_item_content").hide();
									 jQuery("#new_custom_item_content").show();
								 }
                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          } 
 
     });			
	
}

function display_new_child_item_content(button_id){

	jQuery("#new_custom_child_item_content").show();
	jQuery("#new_custom_item_content").hide();
	jQuery("#new_custom_root_content").hide();
	jQuery('#current_menu_item_key').val(button_id);
	
}

function manage_custom_menu_root(current_id){

	var current_val = jQuery('#'+current_id).val();
	
	if(current_val == 'custom'){
	
		jQuery('#'+current_id+'_div').show();
		jQuery('#'+current_id+'_custom').val("");
		jQuery('#'+current_id+'_url_div').show();
		jQuery('#'+current_id+'_custom_url').val("");
		
	} else {
	
		jQuery('#'+current_id+'_div').hide();
		jQuery('#'+current_id+'_custom').val("");
		jQuery('#'+current_id+'_url_div').hide();
		jQuery('#'+current_id+'_custom_url').val("");
		
	}

}

(function ( $ ) {
	"use strict";

    jQuery( document ).ready(function(){
	
		jQuery( "#tabs" ).tabs();	
		jQuery('.admincolor').each(function() {	

				if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
				
					jQuery( '#'+this.id ).wpColorPicker();
						
				} else {
				
					jQuery( '#'+this.id+'_colorpicker' ).farbtastic( '#'+this.id );
						
				}
				
		 });
		 
		 
		 jQuery('.gradient-color').each(function() {
		 
				if(jQuery('.enable-gradient').val() == 1){
				
					jQuery(".gradient-color").hide();
						
				}
				
		 });
		 
		 jQuery('.enable-gradient').change(function(){

				if(jQuery('.enable-gradient').val() == 2){
				
					jQuery(".gradient-color").show();
					
				} else {
				
					jQuery(".gradient-color").hide();
				}
			
		 });
		 
		  toggle_auto_hide_admin_bar();
		 		 
		  jQuery('.toggle-hide-selection').change(function(){
		
				toggle_auto_hide_admin_bar();

		  });
		  
		 
		 function toggle_auto_hide_admin_bar(){
			 
			 var toggle_hide = jQuery('.toggle-hide-selection').val();
			    
				switch(toggle_hide) {
				  
					case '1':
					
					  jQuery(".admin-auto-hide").hide();
					  jQuery(".admin-toggle").show();
					  
					  break;
					  
					case '2':
					
					  jQuery(".admin-toggle").hide();
					  jQuery(".admin-auto-hide").show();
					  
					  break;
					  
					default:
					
					  jQuery(".admin-auto-hide").hide();
					  jQuery(".admin-toggle").hide();
					  
				}
		 }
	
		jQuery("#new_custom_child_item_content").hide();
		jQuery("#new_custom_item_content").hide();
		jQuery("#new_custom_root_content").hide();

		jQuery.getJSON(
					CustomMenu.ajaxurl,{
					
						action: 'custom-menu',
						nonce: CustomMenu.nonce
						
					},
						function( response ) {
							jQuery("#wpaioab_submit").attr('disabled', false);
							$('#custom_menu_roots').html(response.menu_roots_select_box);
							jQuery('#custom_menu_content').html(response.current_menu_structure);
							
							var menu_data = response.custom_root_array;
							
							for(var i in menu_data){
							
								var menu_id = menu_data[i];
								jQuery('#'+menu_id+'_div').hide();
								jQuery('#'+menu_id+'_url_div').hide();
								jQuery('#'+menu_id+'_custom').val("");
								jQuery('#'+menu_id+'_custom_url').val("");
								
							}
							
							
						}
					);

		jQuery.ajax({
			  url: '../wp-admin/admin-ajax.php',
			  data:{
				   'action':'get-adminbar-sample-styles',
				   'nonce': CustomMenu.nonce
				   },
			  dataType: 'JSON',
			  
			  success:function(data){
						if(data.success == 1) {
							
							jQuery('#adminbar_sample_styles_table').html(data.adminbar_sample_styles_table);
							jQuery('#menu_shadow_sample_styles_table').html(data.menu_shadow_sample_styles_table);		
							jQuery('#menu_item_shadow_sample_styles_table').html(data.menu_item_shadow_sample_styles_table);
							
						}
					},
			  error: function(errorThrown){
			  alert('error');
				   console.log(errorThrown);
			  } 
	 
		});					
	

		jQuery('#custom_menu_roots').change(function(){
		
			jQuery("#wpaioab_cover").css("display", "block");
			jQuery("#wpaioab_submit").attr('disabled', true);
			jQuery('#custom_menu_content').html("Please Wait ..........");
			jQuery("#custom_menu_content").show();
			jQuery("#new_custom_child_item_content").hide();
			jQuery("#new_custom_item_content").hide();
			jQuery("#new_custom_root_content").hide();
			
			 jQuery.ajax({
				  url: '../wp-admin/admin-ajax.php',
				  data:{
					   'action':'load-current-menu',
					   'nonce': CustomMenu.nonce,
					   'root_key' : jQuery('#custom_menu_roots').val()
					   },
				  dataType: 'JSON',
				  
				  success:function(data){
				  
								if(data.success == 1){
									jQuery("#wpaioab_cover").css("display", "none");
									jQuery("#wpaioab_submit").attr('disabled', false);
									jQuery('#custom_menu_content').html(data.current_menu_structure);

										if(jQuery('#custom_menu_roots').val() == 'add_new'){
											
											jQuery("#new_custom_root_content").show();
									
											jQuery("#new_custom_child_item_content").hide();
			
										} else if( jQuery('#custom_menu_roots').val() == 'select' ) {
										
											jQuery("#new_custom_item_content").hide();
											jQuery("#new_custom_root_content").hide();
											jQuery("#new_custom_child_item_content").hide();
										
										} else {									
											jQuery("#new_custom_item_content").show();
										
										}

								}

							},
				  error: function(errorThrown){
					   alert('error');
					   console.log(errorThrown);
				  } 
		 
			 });	

		 });

	});

}(jQuery));
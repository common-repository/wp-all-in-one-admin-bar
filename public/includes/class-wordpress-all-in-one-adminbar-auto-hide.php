<?php

class Wordpress_All_In_One_Adminbar_Auto_Hide
{

	protected static $instance = null;

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}



	public function wpaioab_auto_hide_call() {
	
		global $wpaioab_options;
		if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'wpaioab-auto-hide-nonce' ) )
			die ( 'Invalid Nonce' );
		header( "Content-Type: application/json" );
		echo json_encode( array(
			'wpaioab_onmouse_out_delay' => $wpaioab_options['wpaioab_onmouse_out_delay'],
			'wpaioab_moving_speed' => $wpaioab_options['wpaioab_moving_speed'],
			'wpaioab_display_interval' => $wpaioab_options['wpaioab_display_interval'],
			'wpaioab_enable_auto_hide_mobile' => $wpaioab_options['wpaioab_enable_auto_hide_mobile'],
			'wpaioab_move_to_bottom' => $wpaioab_options['wpaioab_move_to_bottom']

		) );
		exit;
		
	}

}

?>
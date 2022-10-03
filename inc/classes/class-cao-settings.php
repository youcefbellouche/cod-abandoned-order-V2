<?php

class Cao_Settings {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'cao_sub_menu' ) );
		add_action( 'admin_init', array( $this, 'cao_settings_save' ) );
	}
	public function cao_sub_menu() {
		add_submenu_page( 'edit.php?post_type=cod_abandoned_order', __( 'Settings', 'cod' ), __( 'Settings', 'cod' ), 'manage_options', 'cao-settings', array( $this, 'settings_page' ) );
	}
	public function settings_page() {
		require_once CAO_PLUGIN_DIR . 'inc/partials/cao-settings-page/index.php';
	}
	public function cao_settings_save() {
		if ( ! isset( $_POST['cao-settings-nonce'] )
		|| ! wp_verify_nonce( $_POST['cao-settings-nonce'], 'cao-settings-save' )
		) {
			return;
		}
		$delay = $_POST['cao-delay'];

		if ( isset( $delay ) ) {
			if ( $delay >= 500 && $delay <= 10000 ) {
				update_option( 'cao_client_delay', $delay );
			}
		}

	}
}
new Cao_Settings();

<?php
/**
 * Cod Abandoned Oreder Enqueue
 */
class Cao_Enqueue {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'cao_enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'cao_enqueue_settings' ) );
	}
	public function cao_enqueue_settings( $page ) {
		if ( $page != 'cod_abandoned_order_page_cao-settings' ) {
			return;
		}
		// Enqueue CSS
		wp_enqueue_style( 'cao-css', CAO_PLUGIN_URL . '/inc/partials/cao-settings-page/style.css', array(), '1.1.0', 'all' );

	}
	public function cao_enqueue() {
		// Enqueue JS
		wp_enqueue_script( 'cao-js', CAO_PLUGIN_URL . '/assets/js/check-order-form.js', array( 'jquery' ), '1.1.0', true );
		$delay = get_option( 'cao_client_delay', 1000 );
		wp_localize_script(
			'cao-js',
			'caoData',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'delay'   => $delay,
			)
		);
	}
}
new Cao_Enqueue();

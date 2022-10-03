<?php


class cao_ajax {
	public function __construct() {
		add_action( 'wp_ajax_nopriv_order_abandon_check', array( $this, 'order_abandon_check' ) );
		add_action( 'wp_ajax_order_abandon_check', array( $this, 'order_abandon_check' ) );
	}
	/**
	 * Function Called With Ajax To Create,Edit Or Delete Post
	 */
	function order_abandon_check() {
		$method  = $_POST['method'];
		$details = array(
			'phone'         => $_POST['phone'],
			'full_name'     => $_POST['full_name'],
			'product_title' => $_POST['product_name'],
		);
		if ( $method == 'add' ) {
			$cod_order_id = $this->create_abandon_order( $details );
			wp_send_json( $cod_order_id );
		} elseif ( $method == 'edit' ) {

			$order_id = $_POST['order_id'];
			$this->edit_abandon_order( $order_id, $details );

		} elseif ( $method == 'delete' ) {

			$order_id = $_POST['order_id'];
			$this->delete_abandon_order( $order_id );

		} else {
			return;
		}
	}
	/**
	 * Creats Cod Abandoned Order
	 */
	function create_abandon_order( $details ) {
		$args     = array(
			'post_type'   => 'cod_abandoned_order',
			'post_status' => 'publish',
		);
		$order_id = wp_insert_post( $args );
		update_post_meta( $order_id, 'details', $details );
		return $order_id;
	}
	/**
	 * Edits Cod Abandoned Order
	 */
	function edit_abandon_order( $order_id, $details ) {
		update_post_meta( $order_id, 'details', $details );
	}
	/**
	 * deletes Cod Abandoned Order
	 */
	function delete_abandon_order( $order_id ) {
		wp_delete_post( $order_id, true );
	}
}
new cao_ajax();



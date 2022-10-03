<?php
/**
 * Cod Abandoned Order Post Type
 */
class Cao_Cpt {
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_action( 'add_meta_boxes', array( $this, 'cao_post_meta_boxes' ) );
		add_action( 'manage_cod_abandoned_order_posts_custom_column', array( $this, 'cao_columns_data' ), null, 2 );
		add_filter( 'manage_cod_abandoned_order_posts_columns', array( $this, 'add_cao_columns' ), null, 1 );

	}

	/**
	 * Register Custom Post Type
	 * */
	public function register_cpt() {
		register_post_type(
			'cod_abandoned_order',
			array(
				'public'              => true,
				'menu_position'       => 30,
				'menu_icon'           => 'dashicons-cart',
				'labels'              => array(
					'name'           => __( 'Cod Abandoned Orders', 'cod' ),
					'singular_name ' => __( 'Cod Abandoned Order', 'cod' ),
					'menu_name'      => __( 'Cod Abandoned Orders', 'cod' ),
				),
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'has_archive'         => false,
				'capability_type'     => 'post',
				'supports'            => array( 'custom-fields' ),
				'capabilities'        => array(
					'create_posts' => 'do_not_allow',
				),
				'map_meta_cap'        => true,
			)
		);
	}

	/**
	 * Creating Meta Box
	 */
	public function cao_post_meta_boxes() {
		$meta_box_fields = array(
			array(
				'id'    => 'cod_abandond_phone',
				'title' => __( 'Phone', 'cod' ),
				'name'  => 'phone',
				'type'  => 'tel',
			),
			array(
				'id'    => 'cod_abandond_full_name',
				'title' => __( 'Full Name', 'cod' ),
				'name'  => 'full_name',
				'type'  => 'text',
			),
			array(
				'id'    => 'cod_abandond_product',
				'title' => __( 'Product Name', 'cod' ),
				'name'  => 'product_name',
				'type'  => 'text',

			),
		);

		foreach ( $meta_box_fields as $meta_box_field ) {

			add_meta_box(
				$meta_box_field['id'],
				$meta_box_field['title'],
				array( $this, 'field_render' ),
				'cod_abandoned_order',
				'normal',
				'high',
				array(
					'name' => $meta_box_field['name'],
					'type' => $meta_box_field['type'],
				)
			);
		}
	}

	/**
	 *  Render Meta Box
	 */
	public function field_render( $post, $meta_box ) {
		$details = get_post_meta( $post->ID, 'details', true );
		echo '<input name=' . $meta_box['args']['name'] . " disabled type='" . $meta_box['args']['type'] . "' value='" . esc_attr( $details != '' ? $details[ $meta_box['args']['name'] ] : '' ) . "' />";
	}

	/**
	 * Show Data In New Columns
	 */
	public function cao_columns_data( $column, $post_id ) {
		$details = get_post_meta( $post_id, 'details', true );

		if ( $column == 'cb' ) {
			echo '<input type="checkbox" />';
		} elseif ( $column == 'full_name' ) {
			$full_name = esc_attr( $details != '' ? $details['full_name'] : '' );
			echo $full_name;
		} elseif ( $column == 'phone' ) {
			$phone = esc_attr( $details != '' ? $details['phone'] : '' );
			echo $phone;
		} elseif ( $column == 'product' ) {
			$product = esc_attr( $details != '' ? $details['product_title'] : '' );
			echo $product;
		} elseif ( $column = 'ID' ) {
			echo $post_id;
		}

	}

	/**
	 * Adding New Columns
	 */
	public function add_cao_columns( $columns ) {
		$columns = array(
			'cb'        => $columns['cb'],
			'Id'        => __( 'ID' ),
			'full_name' => __( 'Full Name' ),
			'phone'     => __( 'Phone' ),
			'product'   => __( 'Product' ),
			'date'      => __( 'Date' ),
		);
		return $columns;
	}

}
new Cao_Cpt();

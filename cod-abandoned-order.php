<?php

/**
 *
 * Plugin Name: Cod Abandoned Order
 * Author: Youcef Bellouche
 * Author URI: https://www.facebook.com/bellou.fecuoy2000/
 * Version: 1.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Define Constants
define( 'CAO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CAO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CAO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );



/**
 * Order Abandoned Classes
 */
require_once CAO_PLUGIN_DIR . 'inc/classes/class-cao-cpt.php';
require_once CAO_PLUGIN_DIR . 'inc/classes/class-cao-ajax.php';
require_once CAO_PLUGIN_DIR . 'inc/classes/class-cao-enqueue.php';
require_once CAO_PLUGIN_DIR . 'inc/classes/class-cao-settings.php';





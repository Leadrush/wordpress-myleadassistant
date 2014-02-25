<?php
/**
 * @package   My_Lead_Assistant
 * @author    Leadrush Ltd. <support@reallysuccessful.com>
 * @license   GPL-2.0+
 * @link      http://leadrushsupport.com/
 * @copyright 2014 Leadrush Ltd.
 *
 * @wordpress-plugin
 * Plugin Name:			My Lead Assistant
 * Plugin URI:        	http://myleadassistant.com
 * Description:       	Load your chat agent easily in Wordpress
 * Version:           	1.0.0
 * Author:       		Leadrush Ltd.
 * Author URI:       	http://leadrushsupport.com/
 * Text Domain:       	my-lead-assistant
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: 	https://github.com/leadrush/wordpress-myleadassistant
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/


require_once( plugin_dir_path( __FILE__ ) . 'public/class-my-lead-assistant.php' );

register_activation_hook( __FILE__, array( 'My_Lead_Assistant', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'My_Lead_Assistant', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'My_Lead_Assistant', 'get_instance' ) );


if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-my-lead-assistant-admin.php' );
	add_action( 'plugins_loaded', array( 'My_Lead_Assistant_Admin', 'get_instance' ) );

}

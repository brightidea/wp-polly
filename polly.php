<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://lougiequisel.com/
 * @since             1.0.0
 * @package           Polly
 *
 * @wordpress-plugin
 * Plugin Name:       Polly
 * Plugin URI:        https://brightideainteractive.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Lougie Quisel
 * Author URI:        http://lougiequisel.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       polly
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// define global paths
define('POLLY_DIR_PATH', WP_PLUGIN_DIR.'/'.basename(dirname(__FILE__)));
define('POLLY_URL_PATH', WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-polly-activator.php
 */
function activate_polly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-polly-activator.php';
	Polly_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-polly-deactivator.php
 */
function deactivate_polly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-polly-deactivator.php';
	Polly_Deactivator::deactivate();
}

//register_activation_hook( __FILE__, 'activate_polly' );
//register_deactivation_hook( __FILE__, 'deactivate_polly' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-polly.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_polly() {

	$plugin = new Polly();
	$plugin->run();

}
run_polly();

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://julianmuslia.com
 * @since             1.0.0
 * @package           Working_Hours_Pg
 *
 * @wordpress-plugin
 * Plugin Name:       Working Hours PG
 * Plugin URI:        https://publishing-group.de
 * Description:       This plugin tracks the beginning and end of working hours for users.
 * Version:           1.0.0
 * Author:            Julian Muslia
 * Author URI:        https://julianmuslia.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       working-hours-pg
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WORKING_HOURS_PG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-working-hours-pg-activator.php
 */
function activate_working_hours_pg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-working-hours-pg-activator.php';
	//Working_Hours_Pg_Activator::activate();
	$activator = new Working_Hours_Pg_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-working-hours-pg-deactivator.php
 */
function deactivate_working_hours_pg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-working-hours-pg-deactivator.php';
	Working_Hours_Pg_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_working_hours_pg' );
register_deactivation_hook( __FILE__, 'deactivate_working_hours_pg' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-working-hours-pg.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_working_hours_pg() {

	$plugin = new Working_Hours_Pg();
	$plugin->run();

}
run_working_hours_pg();

 
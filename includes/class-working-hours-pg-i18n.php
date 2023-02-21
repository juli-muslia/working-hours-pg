<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/includes
 * @author     Julian Muslia <juli.muslia@gmail.com>
 */
class Working_Hours_Pg_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'working-hours-pg',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

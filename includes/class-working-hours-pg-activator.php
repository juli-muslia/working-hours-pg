<?php

/**
 * Fired during plugin activation
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/includes
 * @author     Julian Muslia <juli.muslia@gmail.com>
 */
class Working_Hours_Pg_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		datatable_creation();
	}

}
function datatable_creation (){
global $wpdb;
$table_name = $wpdb->prefix . "working_hours_pg";
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
	id int(11) NOT NULL AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	workday_date date DEFAULT NULL,
	start_time datetime NOT NULL,
	end_time datetime DEFAULT NULL,
	total_time datetime DEFAULT NULL,
	PRIMARY KEY (id)
) $charset_collate;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
}

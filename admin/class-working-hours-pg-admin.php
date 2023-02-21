<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Working_Hours_Pg
 * @subpackage Working_Hours_Pg/admin
 * @author     Julian Muslia <juli.muslia@gmail.com>
 */
class Working_Hours_Pg_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Working_Hours_Pg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Working_Hours_Pg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$valid_pages = array("working-hours");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";
		if (in_array($page, $valid_pages)) {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/working-hours-pg-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'Bootstrap min cdn', plugin_dir_url(__FILE__) .'css/bootstrap.min.css');
		wp_enqueue_style( 'Datatables min cdn', plugin_dir_url(__FILE__) .'css/dataTables.bootstrap4.min.css');	
	}
}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Working_Hours_Pg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Working_Hours_Pg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$valid_pages = array("working-hours");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";
		if (in_array($page, $valid_pages)) {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/working-hours-pg-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('Jquery cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');

		wp_enqueue_script('Popper ', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js');
		wp_enqueue_script('Bootstrap js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js');
		wp_enqueue_script('Datatables js', 'https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js');
		wp_enqueue_script('Datatables bootstrap js', 'https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js');
		wp_enqueue_script('Js Export', 'https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js');

		}
	}

/**
 * Add custom menu
 *
 * @since    1.0.0
 */


 function WorkingHours (){
	add_menu_page('Publishing Working Hours', 'Working Hours', 'edit_others_posts', 'working-hours' , array($this, 'PublishingWorkingHours'), plugin_dir_url(__FILE__) . 'img/working-hours.png', 2 );
}

function PublishingWorkingHours() {
	require_once 'partials/working-hours-pg-admin-display.php';
		echo WorkingHoursUI();

} 
}


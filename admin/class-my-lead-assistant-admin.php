<?php
/**
 * My Lead Assistant Wordpress Plugin
 *
 * @package   My_Lead_Assistant_Admin
 * @author    Leadrush Ltd. <support@reallysuccessful.com>
 * @license   GPL-2.0+
 * @link      http://leadrushsupport.com/
 * @copyright 2014 Leadrush Ltd.
 */


class My_Lead_Assistant_Admin {


	protected static $instance = null;
	protected $plugin_screen_hook_suffix = null;

	private function __construct() {


		$plugin = My_Lead_Assistant::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		add_action( 'admin_init', array( $this, 'myleadassistant_init' ) );
		add_action( 'plugins_loaded', array( $this, 'myleadassistant_git_updater' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );


		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );



	}

	function myleadassistant_git_updater() {
	    if ( is_admin() && !class_exists( 'GPU_Controller' ) ) {
	        require_once dirname( __FILE__ ) . '/git-plugin-updates/git-plugin-updates.php';
	        add_action( 'plugins_loaded', 'GPU_Controller::get_instance', 20 );
	    }
	}

	public function myleadassistant_init() {
		register_setting( 'mla-settings-group', 'myleadassistant_script' );
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), My_Lead_Assistant::VERSION );
		}

	}


	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), My_Lead_Assistant::VERSION );
		}

	}


	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_options_page(
			"My Lead Assistant",
			"My Lead Assistant",
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}


	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}


	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}



}

<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Etcetera_Real_Estate
 * @subpackage Etcetera_Real_Estate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Etcetera_Real_Estate
 * @subpackage Etcetera_Real_Estate/public
 * @author     Your Name <email@example.com>
 */
class Etcetera_Real_Estate_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $etcetera_real_estate    The ID of this plugin.
	 */
	private $etcetera_real_estate;

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
	 * @param      string    $etcetera_real_estate       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $etcetera_real_estate, $version ) {

		$this->etcetera_real_estate = $etcetera_real_estate;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Etcetera_Real_Estate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Etcetera_Real_Estate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->etcetera_real_estate, plugin_dir_url( __FILE__ ) . 'css/etcetera-real-estate-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Etcetera_Real_Estate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Etcetera_Real_Estate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->etcetera_real_estate, plugin_dir_url( __FILE__ ) . 'js/etcetera-real-estate-public.js', array( 'jquery' ), $this->version, false );
	}

}

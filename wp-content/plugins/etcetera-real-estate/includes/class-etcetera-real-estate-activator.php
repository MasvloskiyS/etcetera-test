<?php
/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Etcetera_Real_Estate
 * @subpackage Etcetera_Real_Estate/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Etcetera_Real_Estate
 * @subpackage Etcetera_Real_Estate/includes
 * @author     Your Name <email@example.com>
 */
class Etcetera_Real_Estate_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {    
		if (function_exists('acf_add_local_field_group')) acf_add_local_field_group(ACFields::getFields());
	} 
}

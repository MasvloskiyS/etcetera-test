<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Etcetera_Real_Estate
 *
 * @wordpress-plugin
 * Plugin Name:       Объекты недвижимости
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ETCETERA_REAL_ESTATE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-etcetera-real-estate-activator.php
 */
function activate_etcetera_real_estate()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-etcetera-real-estate-activator.php';
    Etcetera_Real_Estate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-etcetera-real-estate-deactivator.php
 */
function deactivate_etcetera_real_estate()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-etcetera-real-estate-deactivator.php';
    Etcetera_Real_Estate_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_etcetera_real_estate');
register_deactivation_hook(__FILE__, 'deactivate_etcetera_real_estate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-etcetera-real-estate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_etcetera_real_estate()
{
    require plugin_dir_path(__FILE__) . 'includes/acf-fields.php';
    require plugin_dir_path(__FILE__) . 'includes/post-type-init.php';
    require plugin_dir_path(__FILE__) . 'includes/shortcode-init.php';
    require plugin_dir_path(__FILE__) . 'includes/class-etcetera-real-estate-widget.php';
    require plugin_dir_path(__FILE__) . 'includes/filter.php';
    if (function_exists('acf_add_local_field_group')) acf_add_local_field_group(ACFields::getFields());
    $plugin = new Etcetera_Real_Estate();
    $plugin->run();
}
run_etcetera_real_estate();

<?php
/**
 * Plugin Name: WordPress Maglev
 * Plugin URI: https://example.com/my-basic-plugin
 * Description: Build your WordPress projects as fast and easy as Maglev.
 * Version: 1.0.0
 * Author: Mohammad Omar
 * Author URI: https://makiomar.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: anony-wp-maglev
 * Domain Path: /languages
 *
 * @package MyBasicPlugin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Plugin version.
define( 'MAGLEV_VERSION', '1.0.0' );

// Plugin directory path.
define( 'MAGLEV_PATH', plugin_dir_path( __FILE__ ) );

// Plugin URL.
define( 'MAGLEV_URL', plugin_dir_url( __FILE__ ) );

// Plugin basename.
define( 'MAGLEV_BASENAME', plugin_basename( __FILE__ ) );

require_once MAGLEV_PATH . '/vendor/autoload.php';
require_once MAGLEV_PATH . '/ajax-actions.php';
require_once MAGLEV_PATH . '/styles.php';
require_once MAGLEV_PATH . '/scripts.php';

/**
 * Enqueue plugin scripts and styles.
 *
 * @return void
 */
function maglev_enqueue_scripts() {
	wp_enqueue_script( 'htmx', MAGLEV_URL . 'assets/js/htmx.js', array(), '2.0.3', true );
	wp_enqueue_script( 'sweetaler2', MAGLEV_URL . 'assets/js/sweetaler2.js', array(), '11.14.5', true );
}
add_action( 'wp_enqueue_scripts', 'maglev_enqueue_scripts' );

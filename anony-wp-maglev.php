<?php
/**
 * Plugin Name: WordPress Maglev
 * Plugin URI: https://example.com/my-basic-plugin
 * Description: Build your WordPress projects as fast and easy.
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
define( 'MAGlEV_VERSION', '1.0.0' );

// Plugin directory path.
define( 'MAGlEV_PATH', plugin_dir_path( __FILE__ ) );

// Plugin URL.
define( 'MAGlEV_URL', plugin_dir_url( __FILE__ ) );

// Plugin basename.
define( 'MAGlEV_BASENAME', plugin_basename( __FILE__ ) );

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

add_action(
	'wp_footer',
	function () {
		?>
		<script type="text/javascript">
			document.addEventListener(
				"htmx:confirm",
				function(e) {
					if (!e.detail.target.hasAttribute('hx-confirm')) return
					e.preventDefault();
					Swal.fire({
						title: "Proceed?",
						text: `${e.detail.question}`,
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, proceed!',
						cancelButtonText: 'Cancel'
					}).then(function(result) {
						if (result.isConfirmed) e.detail.issueRequest(true) // use true to skip window.confirm
					})
				}
			);
			document.addEventListener("htmx:responseError", function (event) {
				const response = event.detail.xhr;
				
				// Check if the server returned JSON with an error message
				let errorMessage = "An error occurred.";
				try {
					const jsonResponse = JSON.parse(response.responseText);
					if (jsonResponse.error) {
						errorMessage = jsonResponse.error;
					}
				} catch (e) {
					// Fallback for non-JSON responses
					errorMessage = response.responseText || "An unexpected error occurred.";
				}

				// Display the error message (customize this as needed)
				Swal.fire({
					icon: "error",
					title: "Error",
					text: errorMessage,
				});
			});

			document.addEventListener("htmx:afterRequest", function (event) {
				if (event.detail.target.hasAttribute('hx-no-swal')) return;
				const response = event.detail.xhr;
				var reload;
				// Check if the server returned a success response
				if (response.status == 200 ) {
					let successMessage = "Operation completed successfully.";
					try {
						// Attempt to parse JSON if the response contains it
						const jsonResponse = JSON.parse(response.responseText);
						reload = jsonResponse.reload;
						if (jsonResponse.success) {
							successMessage = jsonResponse.success;
						}
					} catch (e) {
						// Fallback for non-JSON responses
						successMessage = "Operation completed.";
						reload = false;
					}

					// Display the success message (customize this as needed)
					Swal.fire({
						icon: "success",
						title: "Success",
						text: successMessage,
					}).then(function(result) {
						if (result.isConfirmed && reload ) location.reload();
					});
				}
			});


		</script>
		<?php
	}
);

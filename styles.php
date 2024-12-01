<?php
/**
 * Styles
 *
 * @package WordPress Maglev
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action(
	'wp_head',
	function () {
		?>
		<style id="maglev-loading-indicator-css">
			#maglev-loading-indicator {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				display: flex;
				justify-content: center;
				align-items: center;
				opacity: 0;
				visibility: hidden;
				z-index: -1; /* Prevent blocking interactions */
				transition: opacity 0.3s ease, visibility 0s 0.3s; /* Delays visibility after fade-out */
			}

			#maglev-loading-indicator.htmx-request {
				opacity: 1;
				visibility: visible;
				z-index: 9999; /* Makes the overlay active during requests */
				transition: opacity 0.3s ease; /* Instant visibility change */
			}

			.spinner {
				width: 50px;
				height: 50px;
				border: 6px solid rgba(255, 255, 255, 0.3);
				border-top-color: #ffffff;
				border-radius: 50%;
				animation: spin 1s linear infinite;
			}

			@keyframes spin {
				from {
					transform: rotate(0deg);
				}
				to {
					transform: rotate(360deg);
				}
			}
		</style>
		<?php
	}
);

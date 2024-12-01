<?php
/**
 * Scripts
 *
 * @package WordPress Maglev
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action(
	'wp_footer',
	function () {
		?>
		<!-- Loading Indicator -->
		<div id="maglev-loading-indicator" hx-indicator>
			<div class="spinner"></div>
		</div>
		<?php
	}
);
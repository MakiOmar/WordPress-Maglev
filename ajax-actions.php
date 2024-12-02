<?php
/**
 * Register custom AJAX actions.
 *
 * This file defines and registers AJAX actions that can be extended
 * using the `maglev_ajax_actions` filter.
 *
 * @package WordPress Maglev
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Filter hook to modify or extend AJAX actions.
 *
 * The filter `maglev_ajax_actions` allows developers to add, remove,
 * or modify AJAX actions in the `$ajax_actions` array.
 * The filter should also be called on plugins_loaded hook on a priority less tham 10
 *
 * @since 1.0.0
 *
 * @param array $ajax_actions The list of AJAX actions with their callbacks.
 *                            Format: 'action_name' => [
 *                              'callback' => 'methodName',
 *                              'logged_in_only' => true // Set to false for both.
 *                            ].
 */

add_action(
	'plugins_loaded',
	function () {
		$ajax_actions = apply_filters( 'maglev_ajax_actions', array() );
		// Register each AJAX action.
		foreach ( $ajax_actions as $event => $settings ) {
			// Ensure the settings contain a valid callback.
			if ( isset( $settings['callback'] ) && is_callable( $settings['callback'] ) ) {
				// Register the action for logged-in users.
				add_action( "wp_ajax_{$event}", $settings['callback'] );

				// Register the action for logged-out users if allowed.
				if ( ! isset( $settings['logged_in_only'] ) || false === $settings['logged_in_only'] ) {
					add_action( "wp_ajax_nopriv_{$event}", $settings['callback'] );
				}
			} else {
				//phpcs:disable
				// Log an error if the callback is not callable.
				error_log( "The callback for action '{$event}' is not callable or missing." );
				//phpcs:enable
			}
		}
	}
);

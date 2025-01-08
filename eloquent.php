<?php
use Illuminate\Database\Capsule\Manager as Capsule;

function anony_wp_maglev_bootstrap() {
	global $wpdb;
	$capsule = new Capsule();

	$capsule->addConnection(
		array(
			'driver'    => 'mysql',
			'host'      => DB_HOST,
			'database'  => DB_NAME,
			'username'  => DB_USER,
			'password'  => DB_PASSWORD,
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => $wpdb->prefix, // Use WordPress table prefix
		)
	);
	// Make the capsule instance available globally
	$capsule->setAsGlobal();

	// Boot Eloquent
	$capsule->bootEloquent();
}

add_action( 'plugins_loaded', 'anony_wp_maglev_bootstrap' );

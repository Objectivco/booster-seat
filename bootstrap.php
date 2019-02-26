<?php
/**
 * PHPUnit bootstrap file
 */
// Composer autoloader must be loaded before WP_PHPUNIT__DIR will be available
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);

try {
	$dotenv->load();
}catch (Exception $e) {
	echo "[NOTICE][DotEnv] {$e->getMessage()}\n";
}

putenv('WP_PHPUNIT__TESTS_CONFIG=' . dirname(__FILE__) . '/wp-tests-config.php');

// Give access to tests_add_filter() function.
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/functions.php';

//
tests_add_filter( 'muplugins_loaded', function() {
	// Load any pre test stuff here...
} );
// Start up the WP testing environment.
require getenv( 'WP_PHPUNIT__DIR' ) . '/includes/bootstrap.php';
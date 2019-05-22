<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Posts_Contributors
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
// $_tests_dir = "C:\\xampp\htdocs\\rtcamp\wp-content\plugins\ultimate-slideshow\\tests\wordpress-tests-lib";

if ( ! $_tests_dir ) {
	// $_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // WPCS: XSS ok.
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/posts-contributor.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';

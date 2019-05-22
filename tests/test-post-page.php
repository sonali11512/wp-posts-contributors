<?php
/**
 * Contains test for PluginPublicTest class
 *
 * @link        https://github.com/sonali11512/wp-posts-contributors
 * @since      1.0.0
 *
 * @package    Posts_Contributors
 * @subpackage Posts_Contributors/test
 */

/**
 * The frontend-specific test functionality of the plugin.
 *
 * @package    Posts_Contributors
 * @subpackage Posts_Contributors/test
 * @author     Sonali Agrawal <sonali.1215@gmail.com>
 */
class PluginPublicTest extends WP_UnitTestCase {


	/**
	 * Test to check enqueue scripts.
	 */
	public function test_enqueue_styles() {

		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_style_is( 'bootstrap', 'registered' ) );
		$this->assertTrue( wp_style_is( 'contributor', 'registered' ) );

		$this->assertTrue( wp_style_is( 'bootstrap', 'enqueued' ) );
		$this->assertTrue( wp_style_is( 'contributor', 'enqueued' ) );

	}
}

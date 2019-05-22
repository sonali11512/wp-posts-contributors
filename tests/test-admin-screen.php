<?php
/**
 * Class SampleTest
 *
 * @package Posts_Contributors
 */

/**
 * Sample test case.
 */
class PluginAminTest extends WP_UnitTestCase {

	public function test_addContributorMetabox() {
	    global $wp_meta_boxes;
	    add_meta_box( 'contributor_box', 'contributors', '__return_false', 'post' );
	    $this->assertArrayHasKey( 'contributor_box', $wp_meta_boxes['post']['advanced']['default'] );
	}
	public function test_remove_meta_box() {
	    global $wp_meta_boxes;
	    // Add a meta boxes to remove.
	    add_meta_box( 'contributor_box', 'contributors', '__return_false', $current_screen = 'post' );
	    // Confirm it's there.
	    $this->assertArrayHasKey( 'contributor_box', $wp_meta_boxes[ $current_screen ]['advanced']['default'] );
	    // Remove the meta box.
	    remove_meta_box( 'contributor_box', $current_screen, 'advanced' );
	    // Check that it was removed properly (The meta box should be set to false once that it has been removed)
	    $this->assertFalse( $wp_meta_boxes[ $current_screen ]['advanced']['default']['contributor_box'] );
	}

}

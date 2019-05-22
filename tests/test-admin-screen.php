<?php
/**
 * Class PluginAminTest
 *
 * @package Posts_Contributors
 */

/**
 * Sample test case.
 */
class PluginAminTest extends WP_UnitTestCase {

	/**
	 * Adds metabox to test
	 */
	public function test_addContributorMetabox() {
		global $wp_meta_boxes;
		add_meta_box( 'contributor_box', 'contributors', '__return_false', 'post' );
		$this->assertArrayHasKey( 'contributor_box', $wp_meta_boxes['post']['advanced']['default'] );
	}

	/**
	 * Test to remove metabox
	 */
	public function test_remove_meta_box() {
		global $wp_meta_boxes;
		// Add a meta boxes to remove.
		add_meta_box( 'contributor_box', 'contributors', '__return_false', $current_screen = 'post' );
		// Confirm it's there.
		$this->assertArrayHasKey( 'contributor_box', $wp_meta_boxes[ $current_screen ]['advanced']['default'] );
		// Remove the meta box.
		remove_meta_box( 'contributor_box', $current_screen, 'advanced' );
		// Check that it was removed properly (The meta box should be set to false once that it has been removed).
		$this->assertFalse( $wp_meta_boxes[ $current_screen ]['advanced']['default']['contributor_box'] );
	}


	/**
	 * Test add_user_meta for new user with a non-editor role
	 */
	public function test_custom_meta_add_for_author() {

		$post = $this->create_post();

			$factory_user_id = $this->factory->user->create( array( 'role' => 'author' ) );
			$get_post_meta   = get_post_meta( $post, 'authorlist', true );

			// an empty string will be returned as user was not an editor.
			$this->assertSame( $get_post_meta, '' );
			update_post_meta( $post, 'authorlist', array( $factory_user_id ) );
			$post_meta = get_post_meta( $post, 'authorlist', true );
			$this->assertNotEmpty( $post_meta );

	}

	/**
	 * Creates post for test.
	 */
	private function create_post() {
		$args = array(
			'post_name'   => 'parent test page',
			'post_title'  => 'parent test page title',
			'post_status' => 'publish',
			'post_type'   => 'post',

		);
		$post_id = $this->factory->post->create( $args );
		return $post_id;
	}

}

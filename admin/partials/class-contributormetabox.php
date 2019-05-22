<?php
/**
 * ContributorMetaBox File Doc Comment
 *
 * @category ContributorMetaBox
 * @package  WordPress
 * @subpackage  ContributorMetaBox
 * @author    sonali agrawal
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv
 * @link     https://github.com/sonali11512/wp-posts-contributors
 */

namespace Wpauthorlist;

/**
 * ContributorMetaBox Class Doc Comment
 *
 * @category Class
 * @package  WordPress
 * @subpackage  ContributorMetaBox
 * @author    sonali agrawal
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv
 * @link     https://github.com/sonali11512/wp-posts-contributors
 */
class ContributorMetaBox {

	/**
	 * Load hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_contributor_metabox' ) );
		add_action( 'save_post', array( $this, 'save_meta_data' ), 10, 1 );
	}

	/**
	 * Adds Metabox
	 */
	public function add_contributor_metabox() {
		add_meta_box( 'contributor_box', __( 'contributors', 'rt-posts-contributor' ), array( $this, 'author_list' ), 'post', 'normal', 'high' );
	}
	/**
	 * Callback for metabox settings.
	 */
	public function author_list() {
		global $post; ?>
		<div class="wrap">
			<?php
			$saved_users = array();
			$users       = get_users( 'role=author' );
			$saved_users = get_post_meta( $post->ID, 'authorlist', true );
			if ( ! empty( $users ) ) {
				foreach ( $users as $key => $value ) {
					$user_id   = $value->ID;
					$user_name = $value->user_login;
					if ( ! empty( $saved_users ) && in_array( $user_id, $saved_users, true ) ) {
						$author_selector_checked = 'checked="checked"';
					} else {
						$author_selector_checked = '';
					}
					?>
					<input name="authorlist[]" type="checkbox" value="<?php echo $user_id; ?>" <?php echo $author_selector_checked; ?>><label><?php echo $user_name; ?></label>
					<?php
				}
			}
			?>
			</div>
		<?php
	}

	/**
	 * Display the contributors.
	 *
	 * @param int $postid post ID.
	 */
	public function save_meta_data( $postid ) {
		if ( isset( $_POST['authorlist'] ) && ! empty( $_POST['authorlist'] ) ) {
			$authorlist = wp_unslash($_POST['authorlist']);
			update_post_meta( $postid, 'authorlist', $authorlist );
		}
	}
}

<?php
/**
 * DisplayContributor File Doc Comment
 *
 * @category DisplayContributor
 * @package  WordPress
 * @subpackage  DisplayContributor
 * @author    sonali agrawal
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv
 * @link     https://github.com/sonali11512/wp-posts-contributors
 */

namespace Wpauthorlist;

/**
 * DisplayContributor Class Doc Comment
 *
 * @category Class
 * @package  WordPress
 * @subpackage  DisplayContributor
 * @author    sonali agrawal
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv
 * @link     https://github.com/sonali11512/wp-posts-contributors
 */
class DisplayContributor {

	/**
	 * Loads hooks.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_filter( 'the_content', array( $this, 'display' ) );
	}

	/**
	 * Loads styles and scripts.
	 */
	public function enqueue_styles() {
		// if ( is_singular( 'post' ) ){?
			wp_register_style( 'bootstrap', plugins_url( 'css/bootstrap.min.css', dirname( __FILE__ ) ), '', '1.0.0' );
			wp_enqueue_style( 'bootstrap' );
			wp_register_style( 'contributor', plugins_url( 'css/contributor.css', dirname( __FILE__ ) ), '', '1.0.0' );
			wp_enqueue_style( 'contributor' );
		// }?
	}

	/**
	 * Display the contributors.
	 *
	 * @param type $content post content.
	 */
	public function display( $content ) {
		if ( is_single() ) {
			$post_id      = get_the_ID();
			$contributors = get_post_meta( $post_id, 'authorlist', true );
			if ( ! empty( $contributors ) ) {
				$content .= '<div class="panel panel-default"><div class="panel-heading">' . __( 'Contributors', 'rt-posts-contributor' ) . '</div><div class="panel-body"><ul id="contributor_list">';
				foreach ( $contributors as $user_id ) {
					$avatar    = get_avatar( $user_id );
					$user_info = get_userdata( $user_id );
					$url       = get_author_posts_url( $user_id );
					$content  .= '<li class="row wp_contributor_list">';
					$content  .= '<div class="col-md-3">' . $avatar . '</div>';
					$content  .= '<div class="col-md-9"><a href="' . $url . '">' . $user_info->user_login;
					$content  .= '</a></div>';
					$content  .= '</li>';
				}
				$content .= '</ul></div></div>';
			}
		}
		return $content;
	}
}

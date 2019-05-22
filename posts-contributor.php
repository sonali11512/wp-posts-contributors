<?php
/**
 * RT Posts Contributors
 *
 * @package     RT_Posts_Contributors
 * @author      sonali agrawal
 * @copyright   2019 sonali agrawal
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: RT Posts Contributors
 * Plugin URI:  https://github.com/sonali11512/wp-posts-contributors
 * Description: This plugin displays the contributors of post.
 * Version:     1.0.0
 * Author:      sonali agrawal
 * Text Domain: rt-posts-contributor
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/*
*Includes admin and public main files
*/
require_once plugin_dir_path( __FILE__ ) . '/admin/class-posts-contributors-admin.php';
require_once plugin_dir_path( __FILE__ ) . '/public/class-posts-contributors-public.php';

add_action( 'plugins_loaded', 'rt_load_text_domain' );

if ( ! function_exists( 'rt_load_text_domain' ) ) {
	/**
	 * Loads text domain
	 */
	function rt_load_text_domain() {
		$plugin_dir = basename( dirname( __FILE__ ) ) . '/languages';
		load_plugin_textdomain( 'rt-posts-contributor', false, $plugin_dir );
	}
}

<?php
/**
 * Plugin Name: WP Posts Contributors
 * Description: This plugin is used to display selected contributors on the posts.
 * Author: Sonali
 * Text Domain: author-list
 * Version: 1.0.0.
 */

require_once plugin_dir_path(__FILE__).'/admin/class-posts-contributors-admin.php';
require_once plugin_dir_path(__FILE__).'/public/class-posts-contributors-public.php';

add_action('plugins_loaded', 'loadTextDomain');

if (!function_exists('wporg_init')) {
    function loadTextDomain()
    {
        $plugin_dir = basename(dirname(__FILE__)).'/languages';
        load_plugin_textdomain('author-list', false, $plugin_dir);
    }
}

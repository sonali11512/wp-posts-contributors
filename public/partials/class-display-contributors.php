<?php
namespace Wpauthorlist;

class DisplayContributor
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this,'enqueueStyles'));
        add_filter('the_content', array($this,'display'));
    }
    public function enqueueStyles()
    {
        wp_register_style('bootstrap', plugin_dir_url(__DIR__).'css/bootstrap.min.css');
        wp_enqueue_style('bootstrap');
        wp_register_style('contributor', plugin_dir_url(__DIR__).'css/contributor.css');
        wp_enqueue_style('contributor');
    }

    public function display($content)
    {
        if (is_single()) {
            $post_id = get_the_ID();
            $contributors = get_post_meta($post_id, 'authorlist', true);
            if (!empty($contributors)) {
                $content .='<div class="panel panel-default"><div class="panel-heading">'.__('Contributors', 'author-list').'</div><div class="panel-body"><ul id="contributor_list">';
                foreach ($contributors as $user_id) {
                    $avatar = get_avatar($user_id);
                    $user_info = get_userdata($user_id);
                    $url= get_author_posts_url($user_id);
                    $content .='<li class="row wp_contributor_list">';
                    $content .='<div class="col-md-3">'.$avatar.'</div>';
                    $content .='<div class="col-md-9"><a href="'.$url.'">'.$user_info->user_login;
                    $content .='</a></div>';
                    $content .='</li>';
                }
                $content .='</ul></div></div>';
            }
        }
        return $content;
    }
}

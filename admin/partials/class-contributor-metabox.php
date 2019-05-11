<?php
namespace Wpauthorlist;

class ContributorBox
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'addContributorMetabox'));
        add_action('save_post', array($this, 'saveMetaData'), 10, 1);
    }
    public function addContributorMetabox()
    {
        add_meta_box('contributor_box', __('contributors', 'author-list'), array($this, 'authorList'), 'post', 'normal', 'high');
    }
    public function authorList()
    {
        global $post;
        ?>
        <div class="wrap">
            <?php
            $saved_users = array();
            $users = get_users('role=author');
            $saved_users = get_post_meta($post->ID, 'authorlist', true);
            if (!empty($users)) {
                foreach ($users as $key => $value) {
                    $user_id = $value->ID;
                    $user_name = $value->user_login;
                    if (!empty($saved_users) && in_array($user_id, $saved_users)) {
                        $author_selector_checked = 'checked="checked"';
                    } else {
                        $author_selector_checked = '';
                    }
                    ?>
                <input name="authorlist[]" type="checkbox" value="<?php echo $user_id ;?>" <?php echo $author_selector_checked; ?>><label><?php echo $user_name; ?></label>
                <?php }
            }
            
            
            ?>
        </div>
    <?php }

    public function saveMetaData($postid)
    {
        if (isset($_POST['authorlist']) && !empty($_POST['authorlist'])) {
            $authorlist = $_POST['authorlist'];
            update_post_meta($postid, 'authorlist', $authorlist);
        }
    }
}

  

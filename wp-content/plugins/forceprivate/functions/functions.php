<?php

/**
 * Force ALL posts to private if not an editor
 */
function force_private_post($post, $postarr)
{
    
    if (get_option('fp_only_new') == 1)
        return $post;
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post;
    
    if (current_user_can('edit_private_posts', $postarr['ID']))
        return $post;
    
    if ( needs_force($post['post_status']))
        $post['post_status'] = 'private';
    
    return $post;
    
}

/**
 * Force NEW post to private if not an editor
 */
function force_private_new_post($post_id)
{
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return;
    
    if (current_user_can('edit_private_posts', $post_id))
        return;
    
    if (!get_option('fp_only_new') == 1) {
        
        // Only do categories
        $cats = wp_get_post_categories($post_id);
        $forceCats = get_option('fp_force_category');
        $forceCats = array_merge($cats, $forceCats);

        if (count($forceCats) != 0)
            wp_set_post_categories($post_id, $forceCats);
        
        return;
        
    }
    
    if (isset($_POST['original_post_status']) && needs_force($_POST['original_post_status']))
        return;
    
    $status = get_post_status($post_id);

    if ( needs_force($status)) {
        
        $private_post = array();
        $private_post['ID'] = $post_id;
        $private_post['post_status'] = 'private';
        
        $cats = wp_get_post_categories($post_id);
        $forceCats = get_option('fp_force_category');
        $forceCats = array_merge($cats, $forceCats);

        if (count($forceCats) != 0)
            wp_set_post_categories($post_id, $forceCats);
        
        remove_action('wp_insert_post', 'force_private_new_post'); // Avoid infinite loop
        wp_update_post($private_post);
        add_action('wp_insert_post', 'force_private_new_post'); // Restore action hook
        
    }
    
}

/* GENERAL FUNCTIONS */

/**
 * Check if a post needs to be forced to private based on current status
 */
function needs_force($post_status) {
    
    switch ($post_status) {
        case 'draft':
        case 'auto-draft':
        case 'trash':
            return false;
            break;
        default:
            return true;
    }
    
}

?>

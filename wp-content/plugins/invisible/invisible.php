<?php
/*
Plugin Name: Invisible
Description: Protect private post attachment file.
Version: 0.1
Author: Keisuke Nemoto
License: GPLv2
Text Domain: invisible
Domain Path: /languages
*/

class Invisible {

  const VERSION = '0.1';
  const TEXT_DOMAIN = 'invisible';
  const QUERY_VAR = 'invisible';
  const PROTECT_DIR = 'protect';

  function __construct() {

    load_plugin_textdomain(self::TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)).'/languages');

    register_activation_hook(__FILE__, array($this, 'activate'));
    // register_deactivation_hook(__FILE__, array($this, 'deactivate'));

    add_action('init', array($this, 'init'));

    add_action('parse_request', array($this, 'request'));

    add_action('admin_init', array($this, 'admin_init'));

  }

  function activate() {

    self::init();
    self::make_protected_directory();

    add_action('activated_plugin', 'flush_rewrite_rules');

  }

  // function deactivate() {}

  function init() {

    # add query var
    global $wp;
    $wp->add_query_var(self::QUERY_VAR);

    # add rewrite rule
    $upload_dir = wp_upload_dir();
    $rule_dir = str_replace(dirname(WP_CONTENT_DIR).'/', '', $upload_dir['basedir']);
    add_rewrite_rule($rule_dir.'(/.+)$', add_query_arg(self::QUERY_VAR, '$matches[1]', 'index.php'), 'top');

  }

  function request($wp) {

    if (!isset($wp->query_vars[self::QUERY_VAR])) return;

    # get attachment post data
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1";
    $attachment = $wpdb->get_row($wpdb->prepare($sql, '%'.$wp->query_vars[self::QUERY_VAR]));

    # not exists attachment to 404 error
    if (!$attachment || !self::is_protected_attachment($attachment)) {
      $wp->query_vars['error'] = '404';
      return;
    }

    # if exists parent post check post_status and post_password and edit cap
    if ($attachment->post_parent) {
      $parent_post = get_post($attachment->post_parent);
      $parent_status = get_post_status($parent_post);
      $parent_type = get_post_type_object($parent_post->post_type);

      $can_view = $can_edit = false;

      if ($parent_status == 'publish' && post_password_required($parent_post) == false) {
        $can_view = true;
      }

      if (current_user_can($parent_type->cap->edit_post, $parent_post->ID)) {
        $can_edit = true;
      }

      if (!$can_view && !$can_edit) {
        $wp->query_vars['error'] = '404';
        return;
      }
    }

    # output file and exit
    $filepath = self::get_file_path($attachment);
    header("Content-Type: {$attachment->post_mime_type};");
    readfile($filepath['protected']);
    exit;

  }

  function admin_init() {

    # media library filters
    add_filter('display_media_states', array($this, 'display_media_states'));
    add_filter('media_row_actions', array($this, 'media_row_actions'));

    # post protect/unprotect actions
    add_action('admin_action_protect', array($this, 'admin_action_protect'));
    add_action('admin_action_unprotect', array($this, 'admin_action_unprotect'));

    # media manager
    add_filter('media_upload_tabs', array($this, 'media_upload_tabs'));
    add_action('media_upload_protect', array($this, 'media_upload_content'));

  }

  function media_upload_tabs( $tabs ) {
      $tabs['protect'] = __('test', self::TEXT_DOMAIN);
      return $tabs;
  }

  function media_upload_content() {
    return 'test';
  }

  function make_protected_directory() {

    $upload_dir = wp_upload_dir();

    # make wp-content/uploads/[protect_dir]
    mkdir($upload_dir['basedir'].'/'.self::PROTECT_DIR, 0777, true);

    # add wp-content/uploads/[protect_dir]/.htaccess
    $htaccess = 'order deny,allow'.PHP_EOL.'deny from all';
    file_put_contents($upload_dir['basedir'].'/'.self::PROTECT_DIR.'/.htaccess', $htaccess);

  }

  function get_file_path($post = null) {
    $post = get_post($post);
    if (get_post_type($post) != 'attachment') return false;
    $upload_dir = wp_upload_dir();
    $original = get_attached_file($post->ID);
    $protected = str_replace($upload_dir['basedir'], $upload_dir['basedir'] . '/' . self::PROTECT_DIR, $original);
    return compact('original', 'protected');
  }

  function is_protected_attachment($post = null) {
    $filepath = self::get_file_path($post);
    return !file_exists($filepath['original']) && file_exists($filepath['protected']);
  }

  function display_media_states($media_states) {
    if (self::is_protected_attachment()) {
      $media_states[] = '<div class="dashicons dashicons-lock"></div> '.__('Protected', self::TEXT_DOMAIN);
    }
    return $media_states;
  }

  function media_row_actions($actions) {
    $action_url = add_query_arg('post', get_the_ID(), admin_url('post.php'));
    if (self::is_protected_attachment()) {
      $actions['unprotect'] = '<a href="'.wp_nonce_url(add_query_arg('action', 'unprotect', $action_url), 'unprotect-post_' . get_the_ID() ).'">'.__('Remove Protection', self::TEXT_DOMAIN).'</a>';
    } else {
      $actions['protect'] = '<a href="'.wp_nonce_url(add_query_arg('action', 'protect', $action_url), 'protect-post_' . get_the_ID() ).'">'.__('Protect', self::TEXT_DOMAIN).'</a>';
    }
    return $actions;
  }

  function admin_action_protect() {
    $post_id = (int) $_REQUEST['post'];
    check_admin_referer('protect-post_' . $post_id);

    $filepath = self::get_file_path($post_id);
    self::move_file($filepath['original'], $filepath['protected']);

    wp_safe_redirect(wp_get_referer());
    exit;
  }

  function admin_action_unprotect() {
    $post_id = (int) $_REQUEST['post'];
    check_admin_referer('unprotect-post_' . $post_id);

    $filepath = self::get_file_path($post_id);
    self::move_file($filepath['protected'], $filepath['original']);

    wp_safe_redirect(wp_get_referer());
    exit;
  }

  function move_file($source, $dest) {
    if (!is_dir(dirname($dest))) {
        mkdir(dirname($dest), 0777, true);
    }
    rename($source, $dest);
  }

}

new Invisible();

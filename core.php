<?php

/*
Plugin Name: related post
Plugin URI: https://owebra.com/plugins/related-post
Description: پلاگین نمایش مطالب مرتبط
Author: Amirhosein Soltani
Version: 1.0.0
Licence: GPLv2 or Later
Author URI: https://owebra.com/resume
*/

defined('ABSPATH') || exit;

define('RP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RP_PLUGIN_URL', plugin_dir_url(__FILE__));

function wp_rp_register_assets()
{
    // css
    wp_register_style('rp-style', plugins_url('related-post/assets/css/style.css'), '', '1.0.0');
    wp_enqueue_style('rp-style');

    wp_register_style('owl-craousel', plugins_url('related-post/assets/css/owl.carousel.min.css'), '', '2.3.4');
    wp_enqueue_style('owl-craousel');

    wp_register_style('owl-craousel-default', plugins_url('related-post/assets/css/owl.theme.default.css'), '', '2.3.4');
    wp_enqueue_style('owl-craousel-default');

    // script
    wp_register_script('rp-main-js', RP_PLUGIN_URL . '/assets/js/main.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('rp-main-js');

    wp_register_script('owl-craousel-js', RP_PLUGIN_URL . '/assets/js/owl.carousel.min.js', ['jquery'], '2.3.4', true);
    wp_enqueue_script('owl-craousel-js');
}

function wp_rp_register_assets_admin()
{
    // css
    wp_register_style('rp-admin-style', plugins_url('related-post/assets/css/admin/admin-style.css'), '', '1.0.0');
    wp_enqueue_style('rp-admin-style');
};

add_action('wp_enqueue_scripts', 'wp_rp_register_assets');
add_action('admin_enqueue_scripts', 'wp_rp_register_assets_admin');

// Inc files
include_once RP_PLUGIN_DIR . 'view/front/related-posts.php';
include_once RP_PLUGIN_DIR . '_inc/setting/menu.php';

function wp_rp_set_setting()
{
    $rp_options_set = [
        '_rp_title' => 'مطالب مرتبط',
        '_rp_number' => '4',
        '_rp_according_to' => 'category',
        '_rp_order_by' => 'rand',
        '_rp_show_type' => 'block',
    ];
    foreach ($rp_options_set as $key => $value) add_option($key, $value);
}

function wp_rp_delete_setting()
{
    $rp_options_set = [
        '_rp_title',
        '_rp_number',
        '_rp_according_to',
        '_rp_order_by',
        '_rp_show_type',
    ];

    foreach ($rp_options_set as $item) delete_option($item);
}

register_activation_hook(__FILE__, 'wp_rp_set_setting');
register_deactivation_hook(__FILE__, 'wp_rp_delete_setting');

<?php

/**
 * @package WP React
 */
/*
Plugin Name: WP React
Plugin URI: https://codergens.com/
Description: This is a react crud plugin. Anyone is welcome to use this plugin in order to develop plugin using React activated. 
Version: 1.0.0
Author: Hasan Tareq
Author URI: https://codergens.com
Text Domain: wpreact
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
define('WPR_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('WPR_URL', trailingslashit(plugin_dir_url(__FILE__)));
define('WPR_VERSION', '1.0.0');

add_action('admin_enqueue_scripts', 'wpr_load_scripts');
if (!function_exists('wpr_load_scripts')) {
    function wpr_load_scripts() {
        wp_enqueue_script('wp-react', WPR_URL . 'dist/bundle.js', ['jquery', 'wp-element'], wp_rand(), true);
        wp_localize_script('wp-react', 'appLocalizer', [
            'apiUrl' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ]);
    }
}


require_once(WPR_PATH . 'classes/create-admin-menu.php');
require_once(WPR_PATH . 'classes/create-settings-routers.php');

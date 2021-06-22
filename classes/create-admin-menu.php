<?php

class WPR_Create_Admin_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'crate_admin_menu']);
    }

    public function crate_admin_menu() {
        $capability = 'manage_options';
        $slug = 'wpr-settings';

        add_menu_page(
            __('WP React', 'wp-react'),
            __('WP React', 'wp-react'),
            $capability,
            $slug,
            [$this, 'menu_page_template'],
            'dashicons-buddicons-replies'
        );
    }

    public function menu_page_template() {
        echo '<div class="wrap"><div id="wpr-admin-app"></div></div>';
    }
}
new WPR_Create_Admin_Page();

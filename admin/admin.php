<?php

require_once PFL_PATH . 'admin/functions.php';
require_once PFL_PATH . 'admin/ajax-functions.php';


class Admin {

    public function __construct() {
        new PFL_enqueue();
        new PFL_create_menus();
        new PFL_ajax_functions();
        add_action('admin_menu', array($this, 'post_from_link_create_menu'));
    }

    public function post_from_link_create_menu() {

        include(PFL_PATH . 'includes/options-page.php');

    }

}
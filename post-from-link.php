<?php
/**
 * Plugin Name: Post From Link
 * Plugin URI: N/A
 * Description: Allows you to create a WordPress post by simply pasting a link.
 * Version: 0.1.0
 * Author: Zac Banas
 * Author URI: N/A
 */

defined('ABSPATH') ? null : exit; // Exits if accessed directly
defined('PFL_PATH') ? null : define('PFL_PATH', plugin_dir_path( __FILE__ ));
defined('PFL_URL') ? null : define('PFL_URL', plugin_dir_url( __FILE__ ));

require_once PFL_PATH . 'admin/admin.php';

new Admin();
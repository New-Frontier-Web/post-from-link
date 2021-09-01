<?php
/**
 * Plugin Name: Post From Link
 * Plugin URI: https://github.com/ZacThePaul/post-from-link
 * Description: Allows you to create a WordPress post by simply pasting a link.
 * Version: CAESAR.ANNE.ADAMS
 * Author: Zac Banas
 * Author URI: https://github.com/ZacThePaul
 *
 * Versioning convention goes like - Roman Emperor - British Monarch - American President - in order.
 * So version 4.6.2 would be CLAUDIUS.WILLIAMIV.ADAMS
 */



defined('ABSPATH') ? null : exit; // Exits if accessed directly
defined('PFL_PATH') ? null : define('PFL_PATH', plugin_dir_path( __FILE__ ));
defined('PFL_URL') ? null : define('PFL_URL', plugin_dir_url( __FILE__ ));
defined('PFL__FILE__') ? null : define('PFL__FILE__', __FILE__);
defined('PFL_PLUGIN_BASE') ? null : define('PFL_PLUGIN_BASE', plugin_basename(PFL__FILE__));

require_once PFL_PATH . 'admin/admin.php';

new Admin();
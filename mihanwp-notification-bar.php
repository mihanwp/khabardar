<?php
/**
 * plugin name: MihanWP Notification Bar
 * description: Create notification bar in your website header.
 * version: 3.3.2
 * author: MihanWP
 * Text Domain: mihanwp-notification-bar
 * Domain Path: /languages
 * author uri: https://mihanwp.com
 * plugin uri: https://mihanwp.com/mihanwp-notification-bar/
 */

defined('ABSPATH') || exit('No Access');

define('MWNB_VERSION', '3.3.2');
define('MWNB_PATH', plugin_dir_path(__FILE__));
define('MWNB_URL', plugin_dir_url(__FILE__));
define('MWNB_BASENAME', basename(dirname(__FILE__)));
define('MWNB_BASE_FILE', __FILE__);
define('MWNB_LANG_PATH', basename(__DIR__) . DIRECTORY_SEPARATOR . 'languages');
define('MWNB_TEXT_DOMAIN', 'mihanwp-notification-bar');
define('MWNB_VIEW_USER_PATH', MWNB_PATH . 'views/user/');
define('MWNB_CSS_URL', MWNB_URL . 'assets/css/');
define('MWNB_JS_URL', MWNB_URL . 'assets/js/');

final class Mihanwp_Notification_Bar_Plugin{
    private static $_instance;
    public static function get_instance(){
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
        $this->load_text_domain();
        add_action('plugins_loaded', [$this, 'include_files']);
    }

    public function include_files(){
        spl_autoload_register([$this, 'autoload']);

        $hooks = \mwn\app\Hooks::Instance();
    }

    public function autoload($class_name){
        if(strpos($class_name, 'mwn\\') !== false){
            $class_name = str_replace('mwn\\', '', $class_name);
            $class_file = str_replace('\\', '/', MWNB_PATH . $class_name) . '.php';
            if(file_exists($class_file) && is_readable($class_file)) {
                include $class_file;
            }
        }
    }

    public function load_text_domain(){
        $locale = apply_filters('plugin_locale', get_locale(), MWNB_TEXT_DOMAIN);
        $wp_core_lang = trailingslashit(WP_LANG_DIR) . MWNB_TEXT_DOMAIN . '/' . MWNB_TEXT_DOMAIN . '-' . $locale . '.mo';
        if (file_exists($wp_core_lang)) {
            load_textdomain(MWNB_TEXT_DOMAIN, $wp_core_lang);
        }
        load_plugin_textdomain(MWNB_TEXT_DOMAIN, false, MWNB_BASENAME . '/languages/');
    }
}

Mihanwp_Notification_Bar_Plugin::get_instance();
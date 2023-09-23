<?php
/**
 * plugin name: MihanWP Notification Bar
 * description: Create notification bar in your website header.
 * version: 3.1.1
 * author: MihanWP
 * Text Domain: mihanwp-notification-bar
 * Domain Path: /languages
 * author uri: https://mihanwp.com
 * plugin uri: https://mihanwp.com/mihanwp-notification-bar/
 */

defined('ABSPATH') || exit('No Access');
define('MWN_PATH', plugin_dir_path(__FILE__));
define('MWN_URL', plugin_dir_url(__FILE__));
define('MWN_BASENAME', basename(dirname(__FILE__)));
define('MWN_BASE_FILE', __FILE__);
define('MWN_LANG_PATH', basename(__DIR__) . DIRECTORY_SEPARATOR . 'languages');
define('MWN_VERSION', '3.1.1');
define('MWN_TEXT_DOMAIN', 'mihanwp-notification-bar');
define('MWN_VIEW_USER_PATH', MWN_PATH . 'views/user/');
define('MWN_CSS_URL', MWN_URL . 'assets/css/');
define('MWN_JS_URL', MWN_URL . 'assets/js/');

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
            $class_file = str_replace('\\', '/', MWN_PATH . $class_name) . '.php';
            if(file_exists($class_file) && is_readable($class_file)) {
                include $class_file;
            }
        }
    }

    public function load_text_domain(){
        $locale = apply_filters('plugin_locale', get_locale(), MWN_TEXT_DOMAIN);
        $wp_core_lang = trailingslashit(WP_LANG_DIR) . MWN_TEXT_DOMAIN . '/' . MWN_TEXT_DOMAIN . '-' . $locale . '.mo';
        if (file_exists($wp_core_lang)) {
            load_textdomain(MWN_TEXT_DOMAIN, $wp_core_lang);
        }
        load_plugin_textdomain(MWN_TEXT_DOMAIN, false, MWN_BASENAME . '/languages/');
    }
}

Mihanwp_Notification_Bar_Plugin::get_instance();
<?php
/**
 * plugin name: MihanWP Notification Bar
 * description: Create notification bar in your website header.
 * version: 3.1
 * author: MihanWP
 * Text Domain: mihanwp-notification-bar
 * Domain Path: /languages
 * author uri: https://mihanwp.com
 * plugin uri: https://mihanwp.com/mihanwp-notification-bar/
*/

defined('ABSPATH') || exit('No Access');
define('mihanwp_notification_bar_DIR_PATH', plugin_dir_path(__FILE__));
define('mihanwp_notification_bar_DIR_URL', plugin_dir_url(__FILE__));
define('mihanwp_notification_bar_MAIN_FILE', __FILE__);
define('mihanwp_notification_bar_LANG_DIR', basename(__DIR__) . DIRECTORY_SEPARATOR . 'languages');
define('MW_mihanwp_notification_bar_SOURCE_VERSION', 3.1);
final class mihanwp_notification_bar{
    private static $_instance;
    static function get_instance()
    {
        if(!self::$_instance)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
        self::hooks();
        self::render_box();
    }
    function autoload($class_name)
    {
        if(strpos($class_name, 'mihanwp_notification_bar'))
        {
            $class_name = strtolower($class_name);
            $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
            $class_file = mihanwp_notification_bar_DIR_PATH . $class_name . '.php';
            if(file_exists($class_file) && is_readable($class_file))
            {
                include $class_file;
            }
        }
    }
    static function hooks()
    {
        add_action('wp_enqueue_scripts', ['\app\mihanwp_notification_bar_assets', 'front_assets']);
        add_action( 'plugins_loaded', ['\app\mihanwp_notification_bar_config', 'plugin_load_process'] );
        add_action('admin_menu', ['\app\mihanwp_notification_bar_admin_menu','init']);
        add_action('admin_init', ['\app\mihanwp_notification_bar_options', 'register_settings']);
        add_action('update_option_mihanwp_notification_bar_title', ['\app\mihanwp_notification_bar_config', 'after_update_banner_title']);
        add_action('update_option_mihanwp_notification_bar_has_close_btn', ['\app\mihanwp_notification_bar_config','after_has_close_btn_update'], 10, 2);
    }
    static function render_box()
    {
        add_action('wp_body_open', ['\app\mihanwp_notification_bar_config', 'render_box']);
        if(!\app\mihanwp_notification_bar_config::get_render_status())
        {
            add_action('wp_footer', function(){
                \app\mihanwp_notification_bar_config::render_box(true);
            });
        }
    }
}
mihanwp_notification_bar::get_instance();
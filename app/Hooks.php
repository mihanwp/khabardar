<?php
namespace mwn\app;

class Hooks {
    private static $instance = null;

    public static function Instance(){
        if(self::$instance === null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('wp_enqueue_scripts', ['\mwn\app\Assets', 'front_assets']);
        add_action('admin_menu', ['\mwn\app\AdminMenu', 'init']);

        if(is_admin()){
            add_action('wp_ajax_mwn_change_notification_status', ['\mwn\app\Ajax', 'handle_change_notification_status']);
            add_action('wp_ajax_mwn_save_notification_data', ['\mwn\app\Ajax', 'handle_save_notification_data']);
            add_action('admin_head', ['\mwn\app\Callbacks', 'handle_append_notification_styles_to_head']);
        } else {
            add_action('wp_head', ['\mwn\app\Callbacks', 'handle_append_notification_styles_to_head']);
            add_action('wp_footer', ['\mwn\app\Callbacks', 'handle_append_notification_to_body']);
        }
    }
}
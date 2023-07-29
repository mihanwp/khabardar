<?php
namespace app;
class mihanwp_notification_bar_config
{
    static $_is_render = false;
    static function plugin_load_process()
    {
        self::load_text_domain();
        self::update_options();
    }
    static function load_text_domain()
    {
        load_plugin_textdomain('mihanwp-notification-bar', false, mihanwp_notification_bar_LANG_DIR);
    }
    static function update_options()
    {
        $old_version = get_option('mw_mihanwp_notification_bar_db_version');
        if(!$old_version)
        {
            update_option('mihanwp_notification_bar_width', 1200);
            update_option('mw_mihanwp_notification_bar_db_version', MW_mihanwp_notification_bar_SOURCE_VERSION);
        }
    }
    static function render_box($is_in_footer = false)
    {
        if(!\app\mihanwp_notification_bar_options::show_banner_permission())
        {
            return false;
        }
        self::set_render_status_on();
        $view = \app\mihanwp_notification_bar_views::get('user.box');
        include $view;
    }
    static function get_render_status()
    {
        return self::$_is_render;
    }
    static function set_render_status_on()
    {
        self::$_is_render = true;
    }
    static function after_update_banner_title()
    {
        \app\mihanwp_notification_bar_options::set_new_banner_id();
    }
    static function after_has_close_btn_update($old_value, $new_vlaue)
    {
        if($new_vlaue && !\app\mihanwp_notification_bar_options::get_banner_id())
        {
            \app\mihanwp_notification_bar_options::set_new_banner_id();
        }
    }
}
<?php
namespace app;
class mihanwp_notification_bar_admin_menu
{
    static function init()
    {
        $menu_title = __('Notification Bar', 'mihanwp-notification-bar');
        $option_panel_page = add_menu_page($menu_title, $menu_title, 'manage_options', 'mihanwp-notification-bar', [__CLASS__, 'option_page']);
        add_action("load-{$option_panel_page}", ['\app\mihanwp_notification_bar_assets', 'load_option_panel_assets']);
    }
    static function option_page()
    {
        $option_panel = mihanwp_notification_bar_views::get('admin.option_panel');
        include $option_panel;
    }
}
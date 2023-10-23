<?php
namespace mwn\app;
class AdminMenu
{
    public static function init(){
        $menu_title = __('Notification Bar', MWNB_TEXT_DOMAIN);
        $option_panel_page = add_menu_page($menu_title, $menu_title, 'manage_options', 'mihanwp-notification-bar', [__CLASS__, 'option_page'], 'dashicons-megaphone');
        add_action("load-{$option_panel_page}", ['\mwn\app\Assets', 'load_option_panel_assets']);
    }

    public static function option_page(){
        $option_panel = ViewsControl::getPath('admin.option_panel');
        include $option_panel;
    }
}
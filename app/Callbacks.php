<?php
namespace mwn\app;

class Callbacks {
    public static function handle_append_notification_styles_to_head(){
        $status = NotificationOptions::is_active_notification();
        $styles = NotificationOptions::get_notification_styles();
        $style_el = "<style id='mwn-custom-notification-style'>{$styles}</style>";
        if(is_admin()){
            if(!empty($styles)){
                echo $style_el;
            }
        } else {
            if($status && !empty($styles)){
                echo $style_el;
            }
        }
    }

    public static function handle_append_notification_to_body(){
        if(!NotificationOptions::is_active_notification()) return false;

        if(NotificationOptions::only_logged_in_user() && !is_user_logged_in()) return false;

        if (!NotificationConditions::display_only_woo_products_customer()) return false;

        if(!NotificationConditions::display_include_pages() || !NotificationConditions::hide_exclude_pages()) return false;

        include_once MWNB_VIEW_USER_PATH . 'notification-content.php';
    }
}
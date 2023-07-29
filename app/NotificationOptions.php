<?php
namespace mwn\app;

class NotificationOptions {
    public static function getOptions()
    {
        return Utility::getBlogOption('mwn_notification_options');
    }

    public static function getOption($key, $default = ''){
        $options = self::getOptions();
        $value = !empty($options) && is_array($options) && isset($options[$key]) ? $options[$key] : $default;

        if ($value === false || (isset($options[$key]) && $options[$key] === null)) {
            return false;
        } else {
            if ($value === 'on' || $value === 'true' || $value === true) {
                $value = true;
            } elseif ($value === 'off' || $value === 'false') {
                $value = false;
            }
        }

        return $value ? $value : $default;
    }

    public static function update_notification_status($status){
        return Utility::updateBlogOption('mwn_notification_status', $status);
    }

    public static function is_active_notification(){
        return self::get_notification_status() === 'active';
    }

    /**
     *
     *
     * Getter Options
     *
     *
     */

    public static function get_notification_status(){
        return Utility::getBlogOption('mwn_notification_status');
    }

    public static function get_notification_styles(){
        return Utility::getBlogOption('mwn_notification_styles');
    }

    public static function get_countdown_content(){
        return self::getOption('notification_countdown_content', sprintf(__('%s Day %s Hour %s Minutes %s Seconds!', MWN_TEXT_DOMAIN), '{{d}}', '{{h}}', '{{m}}', '{{s}}'));
    }

    public static function get_countdown_end_text(){
        return self::getOption('notification_countdown_end_text', __('The training course registration time has ended.', MWN_TEXT_DOMAIN));
    }

    public static function get_countdown_status(){
        return self::getOption('notification_countdown_status', false);
    }

    public static function get_countdown_type(){
        return (int) self::getOption('notification_countdown_style_type', 1);
    }

    public static function get_countdown_datetime(){
        return self::getOption('notification_countdown_datetime', date('Y-m-d\TH:i', (time() + 60 * 60 * 48)));
    }

    public static function get_notification_content(){
        return self::getOption('notification_content', __('Mihan WordPress notification bar message text', MWN_TEXT_DOMAIN));
    }

    public static function get_button_status(){
        return self::getOption('notification_button_status');
    }

    public static function get_button_text(){
        return self::getOption('notification_button_text', __('Buy training course', MWN_TEXT_DOMAIN));
    }

    public static function get_button_link(){
        return self::getOption('notification_button_link', '#');
    }

    public static function get_button_target_blank_status(){
        return self::getOption('notification_button_target_blank');
    }

    public static function get_include_pages_status(){
        return self::getOption('notification_include_pages_status');
    }

    public static function get_include_pages_type(){
        return self::getOption('notification_include_pages_type', 'id');
    }

    public static function get_include_pages_id(){
        return self::getOption('notification_include_pages_id');
    }

    public static function get_include_pages_url(){
        return self::getOption('notification_include_pages_url');
    }

    public static function get_exclude_pages_status(){
        return self::getOption('notification_exclude_pages_status');
    }

    public static function get_exclude_pages_type(){
        return self::getOption('notification_exclude_pages_type', 'id');
    }

    public static function get_exclude_pages_id(){
        return self::getOption('notification_exclude_pages_id');
    }

    public static function get_exclude_pages_url(){
        return self::getOption('notification_exclude_pages_url');
    }

    public static function only_logged_in_user(){
        return self::getOption('notification_only_logged_in_user', false);
    }

    public static function only_woo_products_customer_status(){
        return self::getOption('notification_only_woo_products_customer', false);
    }

    public static function get_woo_products(){
        return self::getOption('woo_products');
    }

    public static function get_modified_at(){
        return self::getOption('modified_at');
    }
}
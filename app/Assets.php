<?php
namespace mwn\app;
class Assets
{
    static function front_assets(){
        self::load_styles();
        self::load_scripts();
    }

    static function get($file_name, $type = 'css'){
        $file_name = str_replace('.', '/', $file_name);
        $file_name = MWNB_URL . 'assets/' . $file_name . '.' . $type;
        return $file_name;
    }

    static function get_css($filename){
        return self::get('css.' . $filename);
    }

    static function get_js($file_name){
        return self::get('js.' . $file_name, 'js');
    }

    static function load_styles(){
        if(!NotificationOptions::is_active_notification()){
            return false;
        }

        $version = MWNB_VERSION;
        wp_enqueue_style('flip-clock', MWNB_CSS_URL . 'flip-clock.min.css', null, $version);
        wp_enqueue_style('mwn-notification-style', self::get_css('notification-style'), null, $version);
    }

    static function load_scripts(){
        if(!NotificationOptions::is_active_notification()){
            return false;
        }

        $version = MWNB_VERSION;
        $main_js = self::get_js('main');
        wp_enqueue_script('mihanwp_notification_bar_main', $main_js, ['jquery'], $version, true);
        wp_enqueue_script('flip-clock', MWNB_JS_URL . 'flip-clock.min.js', null, $version, true);
        wp_enqueue_script('mwn-countdown', MWNB_JS_URL . 'countdown.js', null, $version, true);
        wp_localize_script('mwn-countdown', 'mwn_data', self::get_licalize_data());
    }

    static function load_option_panel_assets(){
        if(isset($_GET['page']) && $_GET['page'] === 'mihanwp-notification-bar'){
            $version = MWNB_VERSION;
            $option_panel_css = self::get_css('option_panel');
            $option_panel_js = self::get_js('option_panel');

            wp_enqueue_style('mihanwp_notification_bar_option_panel', $option_panel_css, null, $version);
            wp_enqueue_style('wp-color-picker');

            wp_enqueue_style('select2', MWNB_CSS_URL . 'select2.min.css', null, $version);
            wp_enqueue_style('flip-clock', MWNB_CSS_URL . 'flip-clock.min.css', null, $version);
            wp_enqueue_style('mwn-notification-style', self::get_css('notification-style'), null, $version);

            wp_enqueue_script('select2', MWNB_JS_URL . 'select2.full.min.js', null, $version, true);
            wp_enqueue_script('flip-clock', MWNB_JS_URL . 'flip-clock.min.js', null, $version, true);
            wp_enqueue_script('sticky-sidebar', MWNB_JS_URL . 'sticky-sidebar.min.js', null, $version, true);
            wp_enqueue_script('mwn-countdown', MWNB_JS_URL . 'countdown.js', null, $version, true);
            wp_localize_script('mwn-countdown', 'mwn_data', self::get_licalize_data());
            wp_enqueue_script('mwn-option-style-controls', self::get_js('option-style-controls'), ['jquery'], $version, true);
            wp_enqueue_script('mwn-ajax', self::get_js('ajax'), ['jquery'], $version, true);
            wp_localize_script('mwn-ajax', 'mwn_data', self::get_licalize_data());
            wp_enqueue_script('mwn-option-panel', $option_panel_js, ['jquery'], $version, true);
        }
    }

    public static function get_licalize_data(){
        return [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mwn_nonce'),
            'text' => [
                'active' => __('Active', MWNB_TEXT_DOMAIN),
                'inactive' => __('Inactive', MWNB_TEXT_DOMAIN),
                'year' => __('Year', MWNB_TEXT_DOMAIN),
                'month' => __('Month', MWNB_TEXT_DOMAIN),
                'week' => __('Week', MWNB_TEXT_DOMAIN),
                'day' => NotificationOptions::get_countdown_days_label(),
                'hour' => NotificationOptions::get_countdown_hours_label(),
                'minute' => NotificationOptions::get_countdown_minutes_label(),
                'seconds' => NotificationOptions::get_countdown_seconds_label(),
                'mseconds' => __('Milli Seconds', MWNB_TEXT_DOMAIN),
            ]
        ];
    }

    static function load_media_uploader(){
        wp_enqueue_media();
    }
}
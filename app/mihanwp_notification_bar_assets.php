<?php
namespace app;
class mihanwp_notification_bar_assets
{
    static function front_assets()
    {
        if(!\app\mihanwp_notification_bar_options::show_banner_permission())
        {
            return false;
        }
        self::load_styles();
        self::add_inline_style();
        self::load_scripts();
    }
    static function get($file_name, $type = 'css')
    {
        $file_name = str_replace('.', '/', $file_name);
        $file_name = mihanwp_notification_bar_DIR_URL . 'assets/' . $file_name . '.' . $type;
        return $file_name;
    }
    static function get_css($filename)
    {
        return self::get('css.' . $filename);
    }
    static function get_js($file_name)
    {
        return self::get('js.' . $file_name, 'js');
    }
    static function load_styles()
    {
        $version = mihanwp_notification_bar_tools::get_version();

        $main_style = self::get_css('main');
        wp_enqueue_style('mihanwp_notification_bar_main', $main_style, null, $version);
    }
    static function add_inline_style()
    {
        $width = \app\mihanwp_notification_bar_options::get_width();
        $media = '@media (min-width: '.$width.'px){.mihanwp_notification_bar_content{width: '.$width.'px;}}';
        $media .= '@media (max-width: '.$width.'px){
            .mihanwp_notification_bar_box_wrapper
            {
                height: auto !important;
                padding: 7px 0;
            }
            .mihanwp_notification_bar_content
            {
                width: 98% !important;
                display: block !important;
                height: auto;
            }
            .mihanwp_notification_bar_content > div,
            .mihanwp_notification_bar_content .mihanwp_notification_bar_message p
            {
                text-align: center;
            }
            .mihanwp_notification_bar_box_wrapper .mihanwp_notification_bar_timer
            {
                padding: 10px 0;
            }
            .mihanwp_notification_bar_box_wrapper .mihanwp_notification_bar_button
            {
                text-align: center !important;
            }
            .mihanwp_notification_bar_box_wrapper .mihanwp_notification_bar_button a
            {
                display: inline-block;
            }}';
        wp_add_inline_style('mihanwp_notification_bar_main', $media);
    }
    static function load_scripts()
    {
        $version = mihanwp_notification_bar_tools::get_version();
        $main_js = self::get_js('main');
        wp_enqueue_script('mihanwp_notification_bar_main', $main_js, ['jquery'], $version, true);
    }
    static function load_option_panel_assets()
    {
        $version = mihanwp_notification_bar_tools::get_version();
        $option_panel_css = self::get_css('option_panel');
        $option_panel_js = self::get_js('option_panel');

        wp_enqueue_style('mihanwp_notification_bar_option_panel', $option_panel_css, null, $version);
        wp_enqueue_style('wp-color-picker');

        $jquery_datetime_picker_js = self::get_js('jquery-datetimepicker');
        $jquery_datetime_picker_css = self::get_css('jquery-datetimepicker-min');
        wp_enqueue_style('jquery-datetimepicker', $jquery_datetime_picker_css, null, $version);
        wp_enqueue_script('jquery-datetimepicker', $jquery_datetime_picker_js, ['jquery'], $version, true);

        $main_js = self::get_js('main');
        wp_enqueue_script('mihanwp_notification_bar_main', $main_js, ['jquery'], $version, true);
        wp_enqueue_script('mihanwp_notification_bar_option_panel', $option_panel_js, ['jquery', 'mihanwp_notification_bar_main', 'wp-color-picker', 'jquery-datetimepicker'], $version, true);
    }
    static function load_media_uploader()
    {
        wp_enqueue_media();
    }
}
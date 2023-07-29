<?php
namespace app;
class mihanwp_notification_bar_options
{
    static function get_tabs()
    {
        return [
            'general' => __('General', 'mihanwp-notification-bar'),
            'style' => __('Style', 'mihanwp-notification-bar'),
        ];
    }
    static function get_bg_modes()
    {
        return [
            'solid' => __('Solid', 'mihanwp-notification-bar'),
            'gradient' => __('Gradient', 'mihanwp-notification-bar'),
            'image' => __('Image', 'mihanwp-notification-bar')
        ];
    }
    static function render_style($style_data)
    {
        $style = '';
        if(is_array($style_data))
        {
            foreach($style_data as $item => $value)
            {
                $style .= sprintf('%s : %s;', $item, $value);
            }
        }
        return $style;
    }
    static function render_date_time()
    {
        $end_date = self::get_count_down_content();
        $end_date = str_replace('{{d}}', '<span class="day">0</span>', $end_date);
        $end_date = str_replace('{{h}}', '<span class="hour">0</span>', $end_date);
        $end_date = str_replace('{{m}}', '<span class="minutes">0</span>',$end_date);
        $end_date = str_replace('{{s}}', '<span class="seconds">0</span>',$end_date);
        echo $end_date;
    }
    static function get_box_style()
    {
        $style = [
            'height' => self::get_height() . 'px'
        ];
        $mode = self::get_bg_mode();
        switch($mode)
        {
            case 'solid':
                $style['background-color'] = self::get_bg_color();
                break;
            case 'gradient':
                $direction = self::get_bg_gradient_direction();
                $first_color = self::get_bg_color();
                $second_color = self::get_bg_second_color();
                $style['background-image'] = 'linear-gradient('.$direction.'deg, '.$first_color.', '.$second_color.')';
                break;
            case 'image':
                $bg_image = self::get_bg_image();
                if($bg_image)
                    $style['background'] = 'url(\''.self::get_bg_image().'\')';
                $style['background-repeat'] = self::get_bg_repeat_mode();
                $style['background-size'] = self::get_bg_size();
                $style['background-position'] = self::get_bg_position();
                $style['background-color'] = self::get_bg_color();
                break;
        }
        return self::render_style($style);
    }
    static function get_content_wrapper_style($is_option_panel = false)
    {
        $content_style = [
            'color' => self::get_text_color()
        ];
        if($is_option_panel)
        {
            $content_style['width'] = self::get_width() * 88 / 1200 .'%';
        }else{
            $style['width'] = self::get_width() . 'px';
        }
        return self::render_style($content_style);
    }
    static function get_title_style()
    {
        $content_style = [
            'color' => self::get_text_color(),
            'font-size' => self::get_title_font_size() . 'px'
        ];
        return self::render_style($content_style);
    }
    static function get_timer_style()
    {
        $content_style = [
            'color' => self::get_text_color(),
            'font-size' => self::get_count_down_font_size() . 'px'
        ];
        return self::render_style($content_style);
    }
    static function get_cta_style()
    {
        $cta_style = [
            'color' => self::get_link_color(),
            'background-color' => self::get_link_btn_color(),
            'font-size' => self::get_cta_font_size() . 'px'
        ];
        return self::render_style($cta_style);
    }
    static function get_close_btn_style()
    {
        $style = [
            'background-color' => self::get_close_btn_bg_color(),
            'color' => self::get_close_btn_color()
        ];
        return self::render_style($style);
    }
    static function get_new_banner_id()
    {
        $id = uniqid('mihanwp_notification_bar_');
        return $id;
    }
    static function get_banner_id()
    {
        return get_option('mihanwp_notification_bar_uniqe_id');
    }
    static function set_new_banner_id()
    {
        $id = self::get_new_banner_id();
        return update_option('mihanwp_notification_bar_uniqe_id', $id);
    }
    static function show_banner_permission()
    {
        if(!self::is_active_banner())
        {
            return false;
        }
        $blacklistUrls = self::get_url_blacklist();
        if($blacklistUrls)
        {
            $blacklistData = explode("\r\n", $blacklistUrls);
            $blacklist = [];
            foreach($blacklistData as $url)
            {
                $urlData = parse_url($url);
                $path = isset($urlData['path']) ? trailingslashit($urlData['path']) : '/';
                $blacklist[] = $path;
            }
            $currentPath = trailingslashit(parse_url(get_permalink())['path']);
            if(in_array($currentPath, $blacklist))
            {
                return false;
            }
        }
        return self::has_user_permission_to_show();
    }
    static function is_active_banner()
    {
        return get_option('mihanwp_notification_bar_is_active');
    }
    static function has_user_permission_to_show()
    {
        $id = isset($_COOKIE['mw_mihanwp_notification_bar_id']) && $_COOKIE['mw_mihanwp_notification_bar_id'] ? $_COOKIE['mw_mihanwp_notification_bar_id'] : '';
        return $id && $id === self::get_banner_id() ? false : true;
    }
    static function get_title()
    {
        return get_option('mihanwp_notification_bar_title');
    }
    static function get_width()
    {
        $option = intval(get_option('mihanwp_notification_bar_width'));
        return $option ? $option : '800';
    }
    static function get_height()
    {
        $option = intval(get_option('mihanwp_notification_bar_height'));
        return $option ? $option : '90';
    }
    static function has_close_btn()
    {
        return get_option('mihanwp_notification_bar_has_close_btn');
    }
    static function is_open_in_new_tab()
    {
        return get_option('mihanwp_notification_bar_is_open_in_new_tab');
    }
    static function get_cta_title()
    {
        return get_option('mihanwp_notification_bar_cta_title');
    }
    static function get_cta_url()
    {
        return get_option('mihanwp_notification_bar_cta_url');
    }
    static function has_count_down()
    {
        return get_option('mihanwp_notification_bar_has_count_down');
    }
    static function get_end_date()
    {
        return get_option('mihanwp_notification_bar_end_date');
    }
    static function get_expired_title_text()
    {
        return get_option('mihanwp_notification_bar_expired_title_text');
    }
    static function get_count_down_content()
    {
        $option = get_option('mihanwp_notification_bar_count_down_content');
        return $option ? $option : '{{d}} Day {{h}} Hour {{m}} Minutes {{s}} Seconds!';
    }
    static function get_url_blacklist()
    {
        return get_option('mihanwp_notification_bar_url_blacklist');
    }
    
    static function get_bg_mode()
    {
        $option = get_option('mihanwp_notification_bar_bg_mode');
        return $option ? $option : 'gradient';
    }
    static function get_bg_color()
    {
        $option = get_option('mihanwp_notification_bar_bg_color');
        return $option ? $option : '#1ea7bc';
    }
    static function get_bg_second_color()
    {
        $option = get_option('mihanwp_notification_bar_bg_second_color');
        return $option ? $option : '#1e73be';
    }
    static function get_bg_gradient_direction()
    {
        $option = get_option('mihanwp_notification_bar_bg_gradient_direction');
        return $option ? $option : '45';
    }
    static function get_bg_image()
    {
        $option = get_option('mihanwp_notification_bar_bg_image');
        return $option ? $option : false;
    }
    static function get_bg_repeat_mode()
    {
        $option = get_option('mihanwp_notification_bar_bg_repeat_mode');
        return $option ? $option : 'no-repeat';
    }
    static function get_bg_size()
    {
        $option = get_option('mihanwp_notification_bar_bg_size');
        return $option ? $option : 'contain';
    }
    static function get_bg_position()
    {
        $option = get_option('mihanwp_notification_bar_bg_position');
        return $option ? $option : 'top left';
    }
    static function get_text_color()
    {
        $option = get_option('mihanwp_notification_bar_text_color');
        return $option ? $option : '#fff';
    }
    static function get_link_color()
    {
        $option = get_option('mihanwp_notification_bar_link_color');
        return $option ? $option : '#fff';
    }
    static function get_link_btn_color()
    {
        $option = get_option('mihanwp_notification_bar_link_btn_color');
        return $option ? $option : '#1e73be';
    }
    static function get_close_btn_color()
    {
        $option = get_option('mihanwp_notification_bar_close_btn_color');
        return $option ? $option : '#fff';
    }
    static function get_close_btn_bg_color()
    {
        $option = get_option('mihanwp_notification_bar_close_btn_bg_color');
        return $option ? $option : '#1e73be';
    }
    static function get_title_font_size()
    {
        $option = get_option('mihanwp_notification_bar_title_font_size');
        return $option ? $option : '15';
    }
    static function get_count_down_font_size()
    {
        $option = get_option('mihanwp_notification_bar_count_down_font_size');
        return $option ? $option : '15';
    }
    static function get_cta_font_size()
    {
        $option = get_option('mihanwp_notification_bar_cta_font_size');
        return $option ? $option : '15';
    }
    static function register_settings()
    {
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_is_active');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_title');

        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_width');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_height');

        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_has_close_btn');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_is_open_in_new_tab');

        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_cta_title');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_cta_url');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_has_count_down');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_end_date');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_expired_title_text');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_count_down_content');
        register_setting('mw_mihanwp_notification_bar_settings', 'mihanwp_notification_bar_url_blacklist');

        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_mode');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_color');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_second_color');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_gradient_direction');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_image');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_repeat_mode');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_size');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_bg_position');

        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_text_color');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_link_color');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_link_btn_color');

        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_close_btn_color');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_close_btn_bg_color');
        
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_title_font_size');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_count_down_font_size');
        register_setting('mw_mihanwp_notification_bar_settings-color', 'mihanwp_notification_bar_cta_font_size');

    }
}
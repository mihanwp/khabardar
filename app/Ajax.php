<?php
namespace mwn\app;

class Ajax {
    public static function handle_change_notification_status(){
        check_ajax_referer('mwn_nonce', 'nonce');
        $current_status = NotificationOptions::get_notification_status();
        $new_status = !$current_status || $current_status === 'inactive' ? 'active' : 'inactive';
        $change = NotificationOptions::update_notification_status($new_status);
        if($change){
            wp_send_json_success(['status' => $new_status, 'status_label' => $new_status === 'active' ? __('Active', MWN_TEXT_DOMAIN) : __('Inactive', MWN_TEXT_DOMAIN)]);
        } else {
            wp_send_json_error();
        }
    }

    public static function handle_save_notification_data(){
        check_ajax_referer('mwn_nonce', 'nonce');
        $data = $_POST;
        $styles = sanitize_text_field($data['styles']);

        if(is_array($data)){
            unset($data['action']);
            unset($data['nonce']);
            unset($data['styles']);
            $data['modified_at'] = time();
        }

        $save = Utility::updateBlogOption('mwn_notification_options', $data);

        if($save){
            $save_styles = Utility::updateBlogOption('mwn_notification_styles', $styles);
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }
}
<?php
namespace mwn\app;

class NotificationConditions {
    public static function display_include_pages(){
        $status = NotificationOptions::get_include_pages_status();
        if (!$status) return true;

        $type = NotificationOptions::get_include_pages_type();
        if($type === 'url'){
            $pages = NotificationOptions::get_include_pages_url();
            if(!empty($pages)){
                $pages = explode("\n", $pages);
                foreach ($pages as $page_url){
                    $url = Utility::removeSchemeFromUrl($page_url);
                    if(!empty($url) && strpos(Utility::getCurrentPageUrl(), $url) !== false){
                        return true;
                        break;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            global $post;
            $pages = NotificationOptions::get_include_pages_id();
            return (!empty($pages) && $post && in_array($post->ID, $pages));
        }

        return true;
    }

    public static function hide_exclude_pages(){
        $status = NotificationOptions::get_exclude_pages_status();
        if (!$status) return true;

        $type = NotificationOptions::get_exclude_pages_type();
        if($type === 'url'){
            $pages = NotificationOptions::get_exclude_pages_url();
            if(!empty($pages)){
                $pages = explode("\n", $pages);
                foreach ($pages as $page_url){
                    $url = Utility::removeSchemeFromUrl($page_url);
                    if(!empty($url) && strpos(Utility::getCurrentPageUrl(), $url) === false){
                        return true;
                        break;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            global $post;
            $pages = NotificationOptions::get_exclude_pages_id();
            return (!empty($pages) && $post && !in_array($post->ID, $pages));
        }

        return true;
    }

    public static function display_only_woo_products_customer(){
        if(!Utility::isActiveWoo() || !NotificationOptions::only_woo_products_customer_status())
            return true;

        if(!is_user_logged_in()) return false;

        $user_id = get_current_user_id();
        $products = NotificationOptions::get_woo_products();

        if(!empty($products)){
            foreach ($products as $product_id){
                if(Utility::hasWooBoughtItems([$product_id], $user_id)){
                    return true;
                }
            }
        }

        return false;
    }
}
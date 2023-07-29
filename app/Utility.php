<?php
namespace mwn\app;

class Utility {
    public static function getBlogOption($key){
        return is_multisite() ? get_blog_option(get_current_blog_id(), $key) : get_option($key);
    }

    public static function updateBlogOption($key, $value){
        return is_multisite() ? update_blog_option(get_current_blog_id(), $key, $value) : update_option($key, $value);
    }

    public static function isActiveWoo(){
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', self::getBlogOption('active_plugins')));
    }

    public static function getPostTypesItems($post_type = null){
        $items = [];
        $post_types = get_post_types();
        if(!empty($post_type)){
            $posts = get_posts(['post_type' => $post_type]);
            if($posts){
                foreach ($posts as $post){
                    $items[$post->ID] = $post->post_title;
                }
            }
        } else {
            if($post_types){
                foreach ($post_types as $post_type){
                    $posts = get_posts(['post_type' => $post_type]);
                    if($posts){
                        $items[$post_type] = $posts;
                    }
                }
            }
        }
        return $items;
    }

    public static function getCurrentPageUrl()
    {
        $current_url = "http";
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $current_url .= "s";
        }
        $current_url .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $current_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $current_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $current_url;
    }

    public static function removeSchemeFromUrl($url) {
        $parsed_url = parse_url($url);

        if (isset($parsed_url['host'])) {
            $host = $parsed_url['host'];
            $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
            $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';

            return rtrim($host . $path . $query, '_');
        }

        return $url;
    }

    public static function hasWooBoughtItems($products_id = array(), $user_id = 0){
        $bought = false;
        $customer_orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_type' => 'shop_order',
            'post_status' => 'wc-completed'
        ));

        foreach ($customer_orders as $customer_order) {
            $order = wc_get_order($customer_order);
            foreach ($order->get_items() as $item) {
                $product_id = $item->get_product_id();
                if (in_array($product_id, $products_id)) {
                    $bought = true;
                }
            }
        }

        return $bought;
    }
}
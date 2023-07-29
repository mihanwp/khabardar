<?php
namespace app;
class mihanwp_notification_bar_views
{
    public static function get($file_name, $extension = 'php')
    {
        $file_name = str_replace('.', DIRECTORY_SEPARATOR, $file_name);
        $file_name = mihanwp_notification_bar_DIR_PATH . 'views' .DIRECTORY_SEPARATOR . $file_name . '.' . $extension;
        return file_exists($file_name) && is_readable($file_name) ? $file_name : false;
    }
}
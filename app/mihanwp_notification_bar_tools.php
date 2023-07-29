<?php
namespace app;
class mihanwp_notification_bar_tools
{
    static function vd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    static function get_version()
    {
        $file_data = get_file_data(mihanwp_notification_bar_MAIN_FILE, ['version' => 'version']);
        return isset($file_data['version']) ? $file_data['version'] : false;
    }
}

<?php
namespace mwn\app;
class ViewsControl
{
    public static function getPath($file_name, $extension = 'php')
    {
        $file_name = str_replace('.', DIRECTORY_SEPARATOR, $file_name);
        $file_name = MWNB_PATH . 'views' .DIRECTORY_SEPARATOR . $file_name . '.' . $extension;
        return file_exists($file_name) && is_readable($file_name) ? $file_name : false;
    }
}
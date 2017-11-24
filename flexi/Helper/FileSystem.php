<?php
namespace Flexi\Helper;

/**
 * Class FileSystem
 * @package Flexi\Helper
 */
class FileSystem
{
    /**
     * @param $dir
     * @return bool
     */
    public static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}

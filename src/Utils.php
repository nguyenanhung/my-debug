<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 18:04
 */

namespace nguyenanhung\MyDebug\Helpers;
if (!interface_exists('nguyenanhung\MyDebug\Interfaces\ProjectInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'ProjectInterface.php';
}
if (!interface_exists('nguyenanhung\MyDebug\Interfaces\UtilsInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'UtilsInterface.php';
}

use nguyenanhung\MyDebug\Interfaces\ProjectInterface;
use nguyenanhung\MyDebug\Interfaces\UtilsInterface;

class Utils implements ProjectInterface, UtilsInterface
{
    /**
     * Utils constructor.
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/21/18 00:21
     *
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/7/18 03:17
     *
     * @param string $str
     *
     * @return mixed|null|string
     */
    public static function slugify($str = '')
    {
        if (!class_exists('\Cocur\Slugify\Slugify')) {
            return NULL;
        }
        try {
            $options = [
                'separator' => '-'
            ];
            $slug    = new \Cocur\Slugify\Slugify($options);

            return $slug->slugify($str);
        }
        catch (\Exception $e) {
            return trim($str);
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 18:04
 */

namespace nguyenanhung\MyDebug;
if (!interface_exists('nguyenanhung\MyDebug\Interfaces\ProjectInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'ProjectInterface.php';
}
if (!interface_exists('nguyenanhung\MyDebug\Interfaces\UtilsInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'UtilsInterface.php';
}

use nguyenanhung\MyDebug\Interfaces\ProjectInterface;
use nguyenanhung\MyDebug\Interfaces\UtilsInterface;

/**
 * Class Utils
 *
 * @package nguyenanhung\MyDebug
 * @author  713uk13m <dev@nguyenanhung.com>
 */
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
     * @return string Current Version of Package
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:31
     *
     * @param string $str String to Slug
     *
     * @return mixed|null|string String as Slug
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

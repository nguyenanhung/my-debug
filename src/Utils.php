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
use nguyenanhung\MyDebug\Repository\DataRepository;

/**
 * Class Utils
 *
 * @category   Class
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
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
            return self::convert_vi_to_en($str);
        }
        try {
            $options = [
                'separator' => '-'
            ];
            $slug    = new \Cocur\Slugify\Slugify($options);

            return $slug->slugify($str);
        }
        catch (\Exception $e) {
            return self::convert_vi_to_en($str);
        }
    }

    /**
     * Function convert_vi_to_en
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 01:17
     *
     * @param string $str
     *
     * @return mixed|string
     */
    private static function convert_vi_to_en($str = '')
    {
        $str = trim($str);
        if (function_exists('mb_strtolower')) {
            $str = mb_strtolower($str);
        } else {
            $str = strtolower($str);
        }
        $data = DataRepository::getData('convert_vi_to_en');
        if (!empty($str)) {
            $str = str_replace($data['vn_array'], $data['en_array'], $str);
            $str = str_replace($data['special_array'], $data['separator'], $str);
            $str = str_replace(' ', $data['separator'], $str);
            while (strpos($str, '--') > 0) {
                $str = str_replace('--', $data['separator'], $str);
            }
            while (strpos($str, '--') === 0) {
                $str = str_replace('--', $data['separator'], $str);
            }
        }

        return $str;
    }
}

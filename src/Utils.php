<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 18:04
 */

namespace nguyenanhung\MyDebug;

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
 * @since      2018-10-17
 * @version    0.1.2.5
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
     * Hàm lấy thông tin phiên bản Packages
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:32
     *
     * @return string Phiên bản hiện tại của Packages, VD: 0.1.1
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function slugify
     *
     * Hàm chuyển đổi ký tự từ tiếng Việt,
     * và các ký tự đặc biệt sang ký tự không dấu
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:31
     *
     * @param string $str Chuỗi ký tự đầu vào
     *
     * @return mixed|null|string Đầu ra rà 1 chuỗi ký tự
     */
    public static function slugify($str = '')
    {
        if (!class_exists('\Cocur\Slugify\Slugify')) {
            return self::convert_vi_to_en($str);
        }
        try {
            $slugify = new \Cocur\Slugify\Slugify();

            return $slugify->slugify($str);
        }
        catch (\Exception $e) {
            return self::convert_vi_to_en($str);
        }
    }

    /**
     * Function convert_vi_to_en
     *
     * Hàm chuyển đổi ký tự từ tiếng Việt,
     * và các ký tự đặc biệt sang ký tự không dấu
     *
     * Sử dụng trong trường hợp class slugify nó không chạy
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 01:17
     *
     * @param string $str Chuỗi ký tự đầu vào
     *
     * @return mixed|string Đầu ra rà 1 chuỗi ký tự
     */
    public static function convert_vi_to_en($str = '')
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

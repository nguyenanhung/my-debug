<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 18:04
 */

namespace nguyenanhung\MyDebug;

use Exception;
use Cocur\Slugify\Slugify;
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
class Utils implements Project
{
    use Version;

    /**
     * Function slugify
     *
     * Hàm chuyển đổi ký tự từ tiếng Việt,
     * và các ký tự đặc biệt sang ký tự không dấu
     *
     * @param string $str Chuỗi ký tự đầu vào
     *
     * @return mixed|null|string Đầu ra rà 1 chuỗi ký tự
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:31
     *
     */
    public static function slugify($str = '')
    {
        if (!class_exists(Slugify::class)) {
            if (function_exists('log_message')) {
                $message = 'Không tồn tại class Slugify';
                log_message('error', $message);
            }

            return self::convert_vi_to_en($str);
        }
        try {
            $slugify = new Slugify();

            return $slugify->slugify($str);
        } catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', 'Error Message: ' . $e->getMessage());
                log_message('error', 'Error TraceAsString: ' . $e->getTraceAsString());
            }

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
     * @param string $str Chuỗi ký tự đầu vào
     *
     * @return mixed|string Đầu ra rà 1 chuỗi ký tự
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 01:17
     *
     */
    public static function convert_vi_to_en($str = '')
    {
        $str  = trim($str);
        $str  = function_exists('mb_strtolower') ? mb_strtolower($str) : strtolower($str);
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

<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/30/18
 * Time: 17:10
 */

namespace nguyenanhung\MyDebug;

/**
 * Interface UtilsInterface
 *
 * @category  Interface
 * @package   nguyenanhung\MyDebug
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface UtilsInterface
{
    /**
     * Function slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/7/18 03:16
     *
     * @param string $str String to Slug
     *
     * @return mixed String as Slug
     */
    public static function slugify($str = '');

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
    public static function convert_vi_to_en($str = '');
}
<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 18:04
 */

namespace nguyenanhung\MyDebug;

use nguyenanhung\Libraries\Slug\SlugUrl;

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
     * @return string Đầu ra rà 1 chuỗi ký tự
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:31
     *
     */
    public static function slugify($str = '')
    {
        return (new SlugUrl())->slugify($str);
    }
}

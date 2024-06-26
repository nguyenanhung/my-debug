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
 * @since      2021-09-24
 * @version    3.0.5
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
     * @param  string  $str  Chuỗi ký tự đầu vào
     *
     * @return string Đầu ra rà 1 chuỗi ký tự
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:31
     *
     */
    public static function slugify(string $str = ''): string
    {
        return (new SlugUrl())->slugify($str);
    }

    /**
     * Function log_message - Call to function log_message if function exists
     *
     * @param  string  $name
     * @param  mixed  $message
     * @return void
     */
    public static function log_message(string $name = '', mixed $message = ''): void
    {
        if (empty($name)) {
            $name = 'error';
        }
        if (function_exists('log_message') && ! empty($message)) {
            if ( ! is_string($message)) {
                $message = json_encode(
                    [
                        $message
                    ]
                );
            }
            log_message($name, $message);
        }
    }
}

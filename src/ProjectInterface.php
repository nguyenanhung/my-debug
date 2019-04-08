<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/7/18
 * Time: 20:27
 */

namespace nguyenanhung\MyDebug;

/**
 * Interface ProjectInterface
 *
 * @package   nguyenanhung\MyDebug
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface ProjectInterface
{
    const VERSION = '1.0';

    /**
     * Hàm lấy thông tin phiên bản Packages
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:32
     *
     * @return string Phiên bản hiện tại của Packages, VD: 0.1.1
     */
    public function getVersion();
}

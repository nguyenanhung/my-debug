<?php
/**
 * Project my-debug
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 15/02/2023
 * Time: 23:13
 */

namespace nguyenanhung\MyDebug;

/**
 * Class BaseDebug
 *
 * @package   nguyenanhung\MyDebug
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class BaseDebug implements Project
{
    public function getVersion()
    {
        return self::VERSION;
    }
}

<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-30
 * Time: 19:40
 */

namespace nguyenanhung\MyDebug;

/**
 * Trait Version
 *
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
 */
trait Version
{
    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-30 19:40
     *
     * @return mixed
     */
    public function getVersion()
    {
        return self::VERSION;
    }
}

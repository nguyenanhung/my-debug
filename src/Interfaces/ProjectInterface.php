<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/7/18
 * Time: 20:27
 */

namespace nguyenanhung\MyDebug\Interfaces;
/**
 * Interface ProjectInterface
 *
 * @category  Interface
 * @package   nguyenanhung\MyDebug\Interfaces
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface ProjectInterface
{
    /**
     * Base version of Project
     */
    const VERSION = '0.1.2.1';

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 00:17
     *
     * @return mixed Current Version of Package
     */
    public function getVersion();
}
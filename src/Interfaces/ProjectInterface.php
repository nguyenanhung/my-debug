<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/7/18
 * Time: 20:27
 */

namespace nguyenanhung\MyDebug\Interfaces;


interface ProjectInterface
{
    const VERSION = '0.1.0';

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/7/18 20:27
     *
     * @return mixed
     */
    public function getVersion();
}
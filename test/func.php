<?php
/**
 * Project my-debug
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 14/01/2023
 * Time: 01:29
 */
if (!function_exists('__show__')) {
    function __show__($s)
    {
        echo "<pre>";
        print_r($s);
        echo "</pre>";
    }
}

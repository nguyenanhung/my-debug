<?php
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Project vn-telco-detect.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 17:30
 */

use nguyenanhung\MyDebug\Utils;

$utils = new Utils();
$str   = 'Nguyễn An Hưng';

d($utils->getVersion());
d($utils::slugify($str));


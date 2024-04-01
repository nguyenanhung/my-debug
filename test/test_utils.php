<?php
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/func.php';

use nguyenanhung\MyDebug\Utils;

$utils = new Utils();
$str = 'Nguyễn An Hưng';

__show__($utils->getVersion());
__show__($utils::slugify($str));

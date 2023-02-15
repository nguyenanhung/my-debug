<?php
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Project vn-telco-detect.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 17:30
 */

use nguyenanhung\MyDebug\Manager\File;

$file = new File();
$file->setExclude(array('*.zip'));
$file->setInclude(array('*.log'));

$path = __DIR__ . '/../tmp';
$path = realpath($path);

d($file->directoryScanner($path));



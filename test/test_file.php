<?php

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/func.php';

use nguyenanhung\MyDebug\Manager\File;

$file = new File();
$file->setExclude(array('*.zip'));
$file->setInclude(array('*.log'));

$path = __DIR__ . '/../tmp';
$path = realpath($path);

__show__($file->directoryScanner($path));

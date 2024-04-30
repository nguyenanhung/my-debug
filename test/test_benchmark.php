<?php

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/func.php';

use nguyenanhung\MyDebug\Benchmark;

$benchmark = new Benchmark();
$benchmark->mark('code_start');
$mathFunctions = ["abs", "acos", "asin", "atan", "floor"];
$count = 10;
for ($i = 0; $i < $count; $i++) {
    foreach ($mathFunctions as $key => $function) {
        $function($i);
        echo ($key + 1) . " -> " . $function . "\n";
    }
}
$benchmark->mark('code_end');

__show__($benchmark->elapsed_time('code_start', 'code_end'));
__show__($benchmark->memory_usage());


<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

/**
 * Project vn-telco-detect.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 17:30
 */

use nguyenanhung\MyDebug\Benchmark;

$benchmark = new Benchmark();
/***************************** SIMPLE BENCHMARKING BY CI *****************************/
$benchmark->mark('code_start');
$mathFunctions = ["abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan",
                  "sqrt"];
$count         = 9999;
for ($i = 0; $i < $count; $i++) {
    foreach ($mathFunctions as $key => $function) {
        call_user_func_array($function, [$i]);
        echo ($key + 1) . " -> " . $function . "\n";
    }
}
$benchmark->mark('code_end');

dump($benchmark->getVersion());
dump($benchmark->elapsed_time('code_start', 'code_end'));
dump($benchmark->memory_usage());
/***************************** SIMPLE BENCHMARKING BY CI *****************************/

[![Latest Stable Version](https://poser.pugx.org/nguyenanhung/my-debug/v)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Latest Unstable Version](https://poser.pugx.org/nguyenanhung/my-debug/v/unstable)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Total Downloads](https://poser.pugx.org/nguyenanhung/my-debug/downloads)](https://packagist.org/packages/nguyenanhung/my-debug)
[![License](https://poser.pugx.org/nguyenanhung/my-debug/license)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Monthly Downloads](https://poser.pugx.org/nguyenanhung/my-debug/d/monthly)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Daily Downloads](https://poser.pugx.org/nguyenanhung/my-debug/d/daily)](https://packagist.org/packages/nguyenanhung/my-debug)
[![composer.lock](https://poser.pugx.org/nguyenanhung/my-debug/composerlock)](https://packagist.org/packages/nguyenanhung/my-debug)

# My Debug

## Debug
```php
<?php
require_once __DIR__ . '/vendor/autoload.php'; // Current Package test, remove if init other package
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Debug;

// Test Content
$logPath     = testLogPath();
$logSubPath  = 'tests-debug-2';
$logFilename = 'Log-' . date('Y-m-d') . '.log';
$name        = 'Test';
$msg         = 'Test Log lan 2';
$context     = [
    'name'  => 'Nguyen An Hung',
    'email' => 'dev@nguyenanhung.com'
];
// Call
$debug = new Debug();
$debug->setDebugStatus(TRUE);
$debug->setGlobalLoggerLevel(NULL);
$debug->setLoggerPath($logPath);
$debug->setLoggerSubPath($logSubPath);
$debug->setLoggerFilename($logFilename);
$debug->__construct();
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
echo "\n getVersion: " . $debug->getVersion() . "\n";
echo "\n setDebugStatus: " . $debug->getDebugStatus() . "\n";
echo "\n setLoggerPath: " . $debug->getLoggerPath() . "\n";
echo "\n setLoggerSubPath: " . $debug->getLoggerSubPath() . "\n";
echo "\n setLoggerFilename: " . $debug->getLoggerFilename() . "\n";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

d($debug->debug($name, $msg . ' - DEBUG', $context));
d($debug->info($name, $msg . ' - INFO', $context));
d($debug->notice($name, $msg . ' - NOTICE', $context));
d($debug->warning($name, $msg . ' - WARNING', $context));
d($debug->error($name, $msg . ' - ERROR', $context));
d($debug->critical($name, $msg . ' - CRITICAL', $context));
d($debug->alert($name, $msg . ' - ALERT', $context));
d($debug->emergency($name, $msg . ' - EMERGENCY', $context));
```

## Benchmark
```php
<?php
require_once __DIR__ . '/vendor/autoload.php'; // Current Package test, remove if init other package
require_once __DIR__ . '/functions.php';

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

d($benchmark->getVersion());
d($benchmark->elapsed_time('code_start', 'code_end'));
d($benchmark->memory_usage());
/***************************** SIMPLE BENCHMARKING BY CI *****************************/
```

## Manage File
```php
<?php
require_once __DIR__ . '/vendor/autoload.php'; // Current Package test, remove if init other package
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Manager\File;

$file = new File();
$file->setExclude(['*.zip']);
$file->setInclude(['*.log']);
d($file->getVersion());

$path = testLogPath();

d($file->scanAndZip($path, 3));
```

## Utils
```php
<?php
require_once __DIR__ . '/vendor/autoload.php'; // Current Package test, remove if init other package
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Utils;

$utils = new Utils();
$str   = 'Nguyễn An Hưng';

d($utils->getVersion());
d($utils::slugify($str));
d($utils::convert_vi_to_en($str));
```

## Support
If any question & request, please contact following information

| Name        | Email                | Skype            | Facebook      |
| ----------- | -------------------- | ---------------- | ------------- |
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |

From Vietnam with Love <3
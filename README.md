[![Latest Stable Version](https://poser.pugx.org/nguyenanhung/my-debug/v)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Latest Unstable Version](https://poser.pugx.org/nguyenanhung/my-debug/v/unstable)](https://packagist.org/packages/nguyenanhung/my-debug)
[![License](https://poser.pugx.org/nguyenanhung/my-debug/license)](https://packagist.org/packages/nguyenanhung/my-debug)
[![PHP Version Require](http://poser.pugx.org/nguyenanhung/my-debug/require/php)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Total Downloads](https://poser.pugx.org/nguyenanhung/my-debug/downloads)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Monthly Downloads](https://poser.pugx.org/nguyenanhung/my-debug/d/monthly)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Daily Downloads](https://poser.pugx.org/nguyenanhung/my-debug/d/daily)](https://packagist.org/packages/nguyenanhung/my-debug)

# My Debug

1 thư viện nhỏ hỗ trợ việc ghi log, benchmark ứng dụng PHP. Được customize lại cho phù hợp mục đích sử dụng

## Version

- [x] V1.x, V2.x support all PHP version `>=5.6`
- [x] V3.x support all PHP version `>=7.0`

## Dependents

Thư viện có sử dụng các gói sau đây

- [x] monolog/monolog `^2.3`
- [x] cocur/slugify `^4.0`
- [x] theseer/directoryscanner `^1.3`
- [x] symfony/filesystem `^5.3 || ^4.4`

## Usage

Tham khảo hướng dẫn triển khai tại đây và trong thư mục `test/`

### Debug & Logger

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Logger;

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
$debug = new Logger();
$debug->setDebugStatus(TRUE);
$debug->setGlobalLoggerLevel('info');
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

dump($debug->debug($name, $msg . ' - DEBUG', $context));
dump($debug->info($name, $msg . ' - INFO', $context));
dump($debug->notice($name, $msg . ' - NOTICE', $context));
dump($debug->warning($name, $msg . ' - WARNING', $context));
dump($debug->error($name, $msg . ' - ERROR', $context));
dump($debug->critical($name, $msg . ' - CRITICAL', $context));
dump($debug->alert($name, $msg . ' - ALERT', $context));
dump($debug->emergency($name, $msg . ' - EMERGENCY', $context));
```

### Benchmark

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
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
        $function($i);
        echo ($key + 1) . " -> " . $function . "\n";
    }
}q
$benchmark->mark('code_end');

dump($benchmark->getVersion());
dump($benchmark->elapsed_time('code_start', 'code_end'));
dump($benchmark->memory_usage());
/***************************** SIMPLE BENCHMARKING BY CI *****************************/
```

### Manage File

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Manager\File;

$file = new File();
$file->setExclude(['*.zip']);
$file->setInclude(['*.log']);
dump($file->getVersion());

$path = testLogPath();

dump($file->cleanLog($path, 7));
```

### Utils

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use nguyenanhung\MyDebug\Utils;

$utils = new Utils();
$str   = 'Nguyễn An Hưng';

dump($utils->getVersion()); // show "2.0.5"
dump($utils::slugify($str)); // show "nguyen-an-hung"
dump($utils::convert_vi_to_en($str)); // show "nguyen-an-hung"
```

## Support

If any question & request, please contact following information

| Name        | Email                | Skype            | Facebook      |
| ----------- | -------------------- | ---------------- | ------------- |
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |

From Vietnam with Love <3
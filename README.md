[![Latest Stable Version](https://img.shields.io/packagist/v/nguyenanhung/my-debug.svg?style=flat-square)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Total Downloads](https://img.shields.io/packagist/dt/nguyenanhung/my-debug.svg?style=flat-square)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Daily Downloads](https://img.shields.io/packagist/dd/nguyenanhung/my-debug.svg?style=flat-square)](https://packagist.org/packages/nguyenanhung/my-debug)
[![Monthly Downloads](https://img.shields.io/packagist/dm/nguyenanhung/my-debug.svg?style=flat-square)](https://packagist.org/packages/nguyenanhung/my-debug)
[![License](https://img.shields.io/packagist/l/nguyenanhung/my-debug.svg?style=flat-square)](https://packagist.org/packages/nguyenanhung/my-debug)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/nguyenanhung/my-debug/php)](https://packagist.org/packages/nguyenanhung/my-debug)

# My Debug

1 thư viện nhỏ hỗ trợ việc ghi log, benchmark ứng dụng PHP. Được customize lại cho phù hợp mục đích sử dụng

## Version

- [x] V1.x support all PHP version `>=5.6`
- [x] V2.x support all PHP version `>=5.6`
- [x] V3.x support all PHP version `>=7.0`
- [x] V4.x support all PHP version `>=8.1`

Ngoài ra, gói cũng hỗ trợ logging lên service ngoài như Sentry, khi đó cần cài thêm gói `sentry/sdk` như dưới đây

- [x] sentry/sdk `^3.0 || ^2.0`

## Usage

Tham khảo hướng dẫn triển khai tại đây và trong thư mục `test/`

### Debug & Logger

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/func.php';

use nguyenanhung\MyDebug\Logger;

// Test Content
$logPath = __DIR__ . '/../tmp';
$logPath = realpath($logPath);
$logSubPath = date('Y-m-d');
$logFilename = 'Log-' . date('Y-m-d') . '.log';
$name = 'Test';
$msg = 'Test Log lan 2';
$context = [
	'name' => 'Nguyen An Hung',
	'email' => 'dev@nguyenanhung.com',
	'website' => 'https://nguyenanhung.com',
];
// Call
$logger = new Logger();
$logger->setDebugStatus(true);
$logger->setGlobalLoggerLevel();
$logger->setLoggerPath($logPath);
$logger->setLoggerSubPath($logSubPath);
$logger->setLoggerFilename($logFilename);
$logger->__construct();
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
echo "\n getVersion: " . $logger->getVersion() . "\n";
echo "\n setDebugStatus: " . $logger->getDebugStatus() . "\n";
echo "\n setLoggerPath: " . $logger->getLoggerPath() . "\n";
echo "\n setLoggerSubPath: " . $logger->getLoggerSubPath() . "\n";
echo "\n setLoggerFilename: " . $logger->getLoggerFilename() . "\n";
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

__show__($logger->debug($name, $msg . ' - DEBUG', $context));
__show__($logger->info($name, $msg . ' - INFO', $context));
__show__($logger->notice($name, $msg . ' - NOTICE', $context));
__show__($logger->warning($name, $msg . ' - WARNING', $context));
__show__($logger->error($name, $msg . ' - ERROR', $context));
__show__($logger->critical($name, $msg . ' - CRITICAL', $context));
__show__($logger->alert($name, $msg . ' - ALERT', $context));
__show__($logger->emergency($name, $msg . ' - EMERGENCY', $context));
```

### Benchmark

```php
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
```

### Manage File

```php
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
```

### Utils

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/func.php';

use nguyenanhung\MyDebug\Utils;

$utils = new Utils();
$str = 'Nguyễn An Hưng';

__show__($utils->getVersion());
__show__($utils::slugify($str));
```

## Support

If any question & request, please contact following information

| Name        | Email                | Skype            | Facebook      |
|-------------|----------------------|------------------|---------------|
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |

From Vietnam with Love <3

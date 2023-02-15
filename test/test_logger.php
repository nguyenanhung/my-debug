<?php
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Project vn-telco-detect.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/18/18
 * Time: 17:30
 */

use nguyenanhung\MyDebug\Logger;

// Test Content
$logPath = __DIR__ . '/../tmp';
$logSubPath = 'tests-debug-2';
$logFilename = 'Log-' . date('Y-m-d') . '.log';
$name = 'Test';
$msg = 'Test Log lan 2';
$context = [
    'name'    => 'Nguyen An Hung',
    'email'   => 'dev@nguyenanhung.com',
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

d($logger->debug($name, $msg . ' - DEBUG', $context));
d($logger->info($name, $msg . ' - INFO', $context));
d($logger->notice($name, $msg . ' - NOTICE', $context));
d($logger->warning($name, $msg . ' - WARNING', $context));
d($logger->error($name, $msg . ' - ERROR', $context));
d($logger->critical($name, $msg . ' - CRITICAL', $context));
d($logger->alert($name, $msg . ' - ALERT', $context));
d($logger->emergency($name, $msg . ' - EMERGENCY', $context));


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

<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/25/18
 * Time: 11:37
 */

namespace MyDebugTests\Functional;

use nguyenanhung\MyDebug\Debug;

class DebugTest extends BaseTestCase
{
    /**
     * Function testDebug
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/25/18 11:52
     *
     */
    public function testDebug()
    {
        include __DIR__ . '/../../functions.php';
        // Test Content
        $logPath     = testLogPath();
        $logFilename = 'Log-' . date('Y-m-d') . '.log';
        $name        = 'Test';
        $msg         = 'Test Log lan 2';
        $context     = [
            'name'  => 'Nguyen An Hung',
            'email' => 'dev@nguyenanhung.com'
        ];
        $debug       = new Debug();
        $debug->setDebugStatus(TRUE);
        $debug->setGlobalLoggerLevel(NULL);
        $debug->setLoggerPath($logPath);
        $debug->setLoggerFilename($logFilename);
        $debug->__construct();
        $result = $debug->debug($name, $msg . ' - DEBUG', $context);
        $this->assertTrue($result);
    }
}

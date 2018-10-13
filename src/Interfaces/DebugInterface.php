<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/30/18
 * Time: 17:11
 */

namespace nguyenanhung\MyDebug\Interfaces;

/**
 * Interface DebugInterface
 *
 * @category  Interface
 * @package   nguyenanhung\MyDebug\Interfaces
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface DebugInterface
{
    /**
     * Function getDebugStatus
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @return mixed Return TRUE if Debug, FALSE if not debug
     */
    public function getDebugStatus();

    /**
     * Function setDebugStatus
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @param bool $debug Set TRUE if Enabled Debug
     *
     * @return mixed
     */
    public function setDebugStatus($debug = FALSE);

    /**
     * Function getGlobalLoggerLevel
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 09:57
     *
     * @return mixed
     */
    public function getGlobalLoggerLevel();

    /**
     * Function setGlobalLoggerLevel
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 09:55
     *
     * @param null $globalLoggerLevel or Key Level to Debug
     *                                debug, info, notice, warning, error, critical, alert, emergency
     */
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL);

    /**
     * Function getLoggerPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @return mixed Logger Path folder
     */
    public function getLoggerPath();

    /**
     * Function setLoggerPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @param string $logger_path /your/to/path
     *
     * @return mixed Set Path to Debug
     */
    public function setLoggerPath($logger_path = '');

    /**
     * Function getLoggerSubPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 19:03
     *
     * @return mixed Get Sub Path for Logger
     */
    public function getLoggerSubPath();

    /**
     * Function setLoggerSubPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 19:03
     *
     * @param string $sub_path /your/to/sub_path
     *
     * @return mixed Set Sub Path for Logger
     */
    public function setLoggerSubPath($sub_path = '');

    /**
     * Function getLoggerFilename
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @return mixed Get Logger filename
     */
    public function getLoggerFilename();

    /**
     * Function setLoggerFilename
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:52
     *
     * @param string $loggerFilename Set Log Filename, example app.log
     *
     * @return mixed
     */
    public function setLoggerFilename($loggerFilename = '');

    /**
     * Function getLoggerDateFormat
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:07
     *
     * @return null|string Get Logger Date Format
     */
    public function getLoggerDateFormat();

    /**
     * Function setLoggerDateFormat
     *
     * Quy định kiểu dữ liệu thời gian cho file Log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:08
     *
     * @param null $loggerDateFormat Set Logger Date Format, example: Y-m-d H:i:s u
     */
    public function setLoggerDateFormat($loggerDateFormat = NULL);

    /**
     * Function getLoggerLineFormat
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:08
     *
     * @return null|string  Get Logger Line Format
     */
    public function getLoggerLineFormat();

    /**
     * Function setLoggerLineFormat
     *
     * Quy định kiểu dữ liệu lưu log, những tham số nào ...
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:09
     *
     * @param null $loggerLineFormat Line Format Input, example: [%datetime%] %channel%.%level_name%: %message%
     *                               %context% %extra%\n
     */
    public function setLoggerLineFormat($loggerLineFormat = NULL);

    /**
     * Function log
     * Add Log into Monolog
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:35
     *
     * @param string $level   Level Debug: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @example log('info', 'test', 'Log Test', [])
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function log($level = '', $name = 'log', $msg = '', $context = []);

    /**
     * Function debug
     *
     * @example DEBUG (100): Detailed debug information.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:33
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function debug($name = 'log', $msg = '', $context = []);

    /**
     * Function info
     *
     * @example INFO (200): Interesting events. Examples: User logs in, SQL logs.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:33
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function info($name = 'log', $msg = '', $context = []);

    /**
     * Function notice
     *
     * @example NOTICE (250): Normal but significant events.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function notice($name = 'log', $msg = '', $context = []);

    /**
     * Function warning
     *
     * @example : WARNING (300): Exceptional occurrences that are not errors. - Use of deprecated APIs, poor use of an
     *          API, undesirable things that are not necessarily wrong.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function warning($name = 'log', $msg = '', $context = []);

    /**
     * Function error
     *
     * @example ERROR (400): Runtime errors that do not require immediate action but should typically be logged and
     *          monitored.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function error($name = 'log', $msg = '', $context = []);

    /**
     * Function critical
     *
     * @example : CRITICAL (500): Critical conditions. - Application component unavailable, unexpected exception.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function critical($name = 'log', $msg = '', $context = []);

    /**
     * Function alert
     *
     * @example : ALERT (550): Action must be taken immediately. - Entire website down, database unavailable, etc. This
     *          should trigger the SMS alerts and wake you up.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function alert($name = 'log', $msg = '', $context = []);

    /**
     * Function emergency
     *
     * @example EMERGENCY (600): Emergency: system is unusable.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function emergency($name = 'log', $msg = '', $context = []);
}

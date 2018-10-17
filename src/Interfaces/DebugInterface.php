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
     * Hàm lấy trạng thái Debug
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:52
     *
     * @return bool|mixed
     */
    public function getDebugStatus();

    /**
     * Hàm cấu hình trạng thái Debug
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:52
     *
     * @param bool $debug TRUE nếu xác định lưu log, FALSE hoặc các giá trị khác sẽ không lưu log
     *
     * @return mixed|void
     */
    public function setDebugStatus($debug = FALSE);

    /**
     * Hàm get Level lưu log cho toàn hệ thống
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:53
     *
     * @return mixed|null|string
     */
    public function getGlobalLoggerLevel();

    /**
     * Hàm cấu hình level Debug
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:53
     *
     * @param null|string $globalLoggerLevel Level Debug được cấu hình theo chuẩn RFC 5424
     *
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
     * @see   https://tools.ietf.org/html/rfc5424
     */
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL);

    /**
     * Hàm lấy thư mục lưu log - main Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:55
     *
     * @return mixed|null|string
     */
    public function getLoggerPath();

    /**
     * Hàm lấy thư mục lưu log - sub Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:56
     *
     * @return mixed|null|string
     */
    public function getLoggerSubPath();

    /**
     * Hàm cấu hình thư mục lưu log - main Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:56
     *
     * @param string $logger_path Đường dẫn tới thư mục lưu log, VD: /your/to/path
     *
     * @return mixed|void
     */
    public function setLoggerPath($logger_path = '');

    /**
     * Hàm cấu hình thư mục lưu log - sub Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     * @param string $sub_path Đường dẫn tới thư mục lưu log, VD: /your/to/sub-path
     *
     * @return mixed|void
     */
    public function setLoggerSubPath($sub_path = '');

    /**
     * Hàm lấy tên file Log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     * @return mixed|string
     */
    public function getLoggerFilename();

    /**
     * Hàm cấu hình file lưu trữ Log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     * @param string $loggerFilename Filename cần lưu log, VD: app.log, Log-2018-10-17.log
     *
     * @return mixed|void
     */
    public function setLoggerFilename($loggerFilename = '');

    /**
     * Hàm lấy Date Format hiện tại
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:58
     *
     * @return null|string
     */
    public function getLoggerDateFormat();

    /**
     * Hàm quy định Date Format cho file Log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:59
     *
     * @param null $loggerDateFormat Logger Date Format, VD: Y-m-d H:i:s u
     *
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see   https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    public function setLoggerDateFormat($loggerDateFormat = NULL);

    /**
     * Hàm lấy thông tin về format dòng ghi log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:59
     *
     * @return null|string
     */
    public function getLoggerLineFormat();

    /**
     * Hàm cấu hình thông tin về format dòng ghi log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:00
     *
     * @param null $loggerLineFormat Line Format Input, example: [%datetime%] %channel%.%level_name%: %message%
     *                               %context% %extra%\n
     *
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see   https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    public function setLoggerLineFormat($loggerLineFormat = NULL);

    /**
     * Hàm ghi log cho hệ thống
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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function log($level = '', $name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function debug($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function info($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function notice($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function warning($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function error($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function critical($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function alert($name = 'log', $msg = 'My Message', $context = []);

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
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     */
    public function emergency($name = 'log', $msg = 'My Message', $context = []);
}

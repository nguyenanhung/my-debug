<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/30/18
 * Time: 17:11
 */

namespace nguyenanhung\MyDebug;

/**
 * Interface DebugInterface
 *
 * @category  Interface
 * @package   nguyenanhung\MyDebug
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface DebugInterface
{
    /**
     * Function getDebugStatus - Hàm lấy trạng thái Debug
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 59:07
     */
    public function getDebugStatus();

    /**
     * Function setDebugStatus - Hàm cấu hình trạng thái Debug
     *
     * @param bool $debug TRUE nếu xác định lưu log, FALSE hoặc các giá trị khác sẽ không lưu log
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 59:17
     */
    public function setDebugStatus($debug = FALSE);

    /**
     * Function getGlobalLoggerLevel - Hàm get Level lưu log cho toàn hệ thống
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 59:49
     */
    public function getGlobalLoggerLevel();

    /**
     * Function setGlobalLoggerLevel - Hàm cấu hình level Debug
     *
     * @param string|null $globalLoggerLevel - Level Debug được cấu hình theo chuẩn RFC 5424
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 00:09
     *
     * @see      https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
     * @see      https://tools.ietf.org/html/rfc5424
     */
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL);

    /**
     * Function getLoggerPath - Hàm lấy thư mục lưu log - main Path
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 01:17
     */
    public function getLoggerPath();

    /**
     * Function getLoggerSubPath - Hàm lấy thư mục lưu log - sub Path
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 01:26
     */
    public function getLoggerSubPath();

    /**
     * Function setLoggerPath - Hàm cấu hình thư mục lưu log - main Path
     *
     * @param string $loggerPath Đường dẫn tới thư mục lưu log, VD: /your/to/path
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 01:36
     */
    public function setLoggerPath($loggerPath = '');

    /**
     * Function setLoggerSubPath - Hàm cấu hình thư mục lưu log - sub Path
     *
     * @param string $loggerSubPath Đường dẫn tới thư mục lưu log, VD: /your/to/sub-path
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 02:19
     */
    public function setLoggerSubPath($loggerSubPath = '');

    /**
     * Function getLoggerFilename - Hàm lấy tên file Log nơi Log được ghi nhận
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 02:47
     */
    public function getLoggerFilename();

    /**
     * Function setLoggerFilename - Hàm cấu hình file lưu trữ Log
     *
     * @param string $loggerFilename - Filename cần lưu log, VD: app.log, Log-2018-10-17.log
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 03:20
     */
    public function setLoggerFilename($loggerFilename = '');

    /**
     * Function getLoggerDateFormat - Hàm lấy Date Format hiện tại
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 03:50
     */
    public function getLoggerDateFormat();

    /**
     * Function setLoggerDateFormat - Hàm quy định Date Format cho file Log
     *
     * @param null $loggerDateFormat Logger Date Format, VD: Y-m-d H:i:s u
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 03:59
     *
     * @see      https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see      https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    public function setLoggerDateFormat($loggerDateFormat = NULL);

    /**
     * Function getLoggerLineFormat - Hàm lấy thông tin về format dòng ghi log
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 04:30
     */
    public function getLoggerLineFormat();

    /**
     * Function setLoggerLineFormat - Hàm cấu hình thông tin về format dòng ghi log
     *
     * @param null $loggerLineFormat Line Format Input, example: [%datetime%] %channel%.%level_name%: %message% %context% %extra%\n
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 04:44
     *
     * @see      https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see      https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    public function setLoggerLineFormat($loggerLineFormat = NULL);

    /**
     * Function log - Hàm ghi log cho hệ thống
     *
     * @param string $level   Level Debug: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 05:20
     *
     * @example  log('info', 'test', 'Log Test', [])
     */
    public function log($level = '', $name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function debug - Ghi log ở chế đô DEBUG (100): Detailed debug information.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function debug($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function info - INFO (200): Interesting events. Examples: User logs in, SQL logs.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function info($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function notice - NOTICE (250): Normal but significant events.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function notice($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function warning - WARNING (300): Exceptional occurrences that are not errors. - Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function warning($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function error - ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function error($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function critical - CRITICAL (500): Critical conditions. - Application component unavailable, unexpected exception.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function critical($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function alert - ALERT (550): Action must be taken immediately. - Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function alert($name = 'log', $msg = 'My Message', $context = array());

    /**
     * Function emergency - EMERGENCY (600): Emergency: system is unusable.
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function emergency($name = 'log', $msg = 'My Message', $context = array());
}

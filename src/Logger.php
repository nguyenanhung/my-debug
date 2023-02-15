<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/27/18
 * Time: 18:31
 */

namespace nguyenanhung\MyDebug;

use Exception;
use Monolog\Logger as MonoLogger;
use Monolog\Formatter\LineFormatter as MonoLineFormatter;
use Monolog\Handler\StreamHandler as MonoStreamHandler;

/**
 * Class Logger
 *
 * Class Logger là 1 Wrapper class customize lại Monolog để tiện sử dụng
 *
 * Mọi logic trong class này có thể không đúng với rules của Monolog nhưng vẫn đảm bảo được việc ghi nhận log
 *
 * @category          Class
 * @package           nguyenanhung\MyDebug
 * @author            713uk13m <dev@nguyenanhung.com>
 * @copyright         713uk13m <dev@nguyenanhung.com>
 * @since             2018-10-17
 * @last_updated      2021-08-17
 * @version           2.0.5
 */
class Logger implements Project
{
    use Version;

    const LOG_BUBBLE = true;

    const FILE_PERMISSION = 0777;

    /** @var bool Cấu hình trạng thái Debug, TRUE nếu cấu hình Debug được bật */
    protected $DEBUG = false;

    /** @var string|null Cấu hình Level lưu Log theo tiêu chuẩn RFC 5424 */
    protected $globalLoggerLevel;

    /** @var string|null Đường dẫn thư mục lưu trữ Log, VD: /your/to/path */
    protected $loggerPath = 'logs';

    /** @var string|null Tương tự với $loggerPath, mặc định dùng để lưu tên class phát sinh log */
    protected $loggerSubPath;

    /** @var string|null Filename lưu log, khuyến nghị theo chuẩn Log-Y-m-d.log, VD: Log-2018-10-17.log */
    protected $loggerFilename;

    /** @var string|null Logger Date Format, VD: Y-m-d H:i:s u */
    protected $loggerDateFormat;

    /** @var string|null Logger Line Format, VD: "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n" */
    protected $loggerLineFormat;

    /**
     * Logger constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function getDebugStatus - Hàm lấy trạng thái Debug
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 59:07
     */
    public function getDebugStatus()
    {
        return $this->DEBUG;
    }

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
    public function setDebugStatus($debug = false)
    {
        $this->DEBUG = $debug;

        return $this;
    }

    /**
     * Function getGlobalLoggerLevel - Hàm get Level lưu log cho toàn hệ thống
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 59:49
     */
    public function getGlobalLoggerLevel()
    {
        return $this->globalLoggerLevel;
    }

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
    public function setGlobalLoggerLevel($globalLoggerLevel = null)
    {
        if (!empty($globalLoggerLevel) && is_string($globalLoggerLevel)) {
            $this->globalLoggerLevel = strtolower($globalLoggerLevel);
        }

        return $this;
    }

    /**
     * Function getLoggerPath - Hàm lấy thư mục lưu log - main Path
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 01:17
     */
    public function getLoggerPath()
    {
        return $this->loggerPath;
    }

    /**
     * Function getLoggerSubPath - Hàm lấy thư mục lưu log - sub Path
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 01:26
     */
    public function getLoggerSubPath()
    {
        return $this->loggerSubPath;
    }

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
    public function setLoggerPath($loggerPath = '')
    {
        if (!empty($loggerPath)) {
            $this->loggerPath = trim($loggerPath);
        }

        return $this;
    }

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
    public function setLoggerSubPath($loggerSubPath = '')
    {
        if (!empty($loggerSubPath)) {
            $this->loggerSubPath = trim($loggerSubPath);
        }

        return $this;
    }

    /**
     * Function getLoggerFilename - Hàm lấy tên file Log nơi Log được ghi nhận
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 02:47
     */
    public function getLoggerFilename()
    {
        return $this->loggerFilename;
    }

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
    public function setLoggerFilename($loggerFilename = '')
    {
        if (!empty($loggerFilename)) {
            $this->loggerFilename = trim($loggerFilename);
        } else {
            $this->loggerFilename = 'Log-' . date('Y-m-d') . '.log';
        }

        return $this;
    }

    /**
     * Function getLoggerDateFormat - Hàm lấy Date Format hiện tại
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 03:50
     */
    public function getLoggerDateFormat()
    {
        return $this->loggerDateFormat;
    }

    /**
     * Function setLoggerDateFormat - Hàm quy định Date Format cho file Log
     *
     * @param string|null $loggerDateFormat Logger Date Format, VD: Y-m-d H:i:s u
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 03:59
     *
     * @see      https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see      https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    public function setLoggerDateFormat($loggerDateFormat = null)
    {
        if (!empty($loggerDateFormat) && is_string($loggerDateFormat)) {
            $this->loggerDateFormat = $loggerDateFormat;
        } else {
            $this->loggerDateFormat = "Y-m-d H:i:s u";
        }

        return $this;
    }

    /**
     * Function getLoggerLineFormat - Hàm lấy thông tin về format dòng ghi log
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 04:30
     */
    public function getLoggerLineFormat()
    {
        return $this->loggerLineFormat;
    }

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
    public function setLoggerLineFormat($loggerLineFormat = null)
    {
        if (!empty($loggerLineFormat) && is_string($loggerLineFormat)) {
            $this->loggerLineFormat = $loggerLineFormat;
        } else {
            $this->loggerLineFormat = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        }

        return $this;
    }

    /**
     * Function log - Hàm ghi log cho hệ thống
     *
     * @param string       $level   Level Debug: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 05:20
     *
     * @example  log('info', 'test', 'Log Test', [])
     */
    public function log($level = '', $name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }
        $level = strtolower(trim($level));
        if ($this->DEBUG === true) {
            if (!class_exists(MonoLogger::class)) {
                if (function_exists('log_message')) {
                    $errorMsg = 'Không tồn tại class Monolog';
                    log_message('error', $errorMsg);
                }

                return false;
            }
            try {
                $loggerSubPath = trim($this->loggerSubPath);
                $loggerSubPath = !empty($loggerSubPath) ? Utils::slugify($loggerSubPath) : 'Default-Sub-Path';
                if (empty($this->loggerFilename)) {
                    $this->loggerFilename = 'Log-' . date('Y-m-d') . '.log';
                }
                $listLevel = array('debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency');
                if (// Tồn tại Global Logger Level
                    isset($this->globalLoggerLevel) && // Là 1 string
                    is_string($this->globalLoggerLevel) && // Và thuộc list Level được quy định
                    in_array($this->globalLoggerLevel, $listLevel, true)) {
                    // If valid globalLoggerLevel -> use globalLoggerLevel
                    $useLevel = strtolower($this->globalLoggerLevel);
                } else {
                    // Default Level is INFO
                    $useLevel = in_array($level, $listLevel) ? trim($level) : trim('info');
                }
                switch ($useLevel) {
                    case 'debug':
                        $keyLevel = MonoLogger::DEBUG;
                        break;
                    case 'info':
                        $keyLevel = MonoLogger::INFO;
                        break;
                    case 'notice':
                        $keyLevel = MonoLogger::NOTICE;
                        break;
                    case 'warning':
                        $keyLevel = MonoLogger::WARNING;
                        break;
                    case 'error':
                        $keyLevel = MonoLogger::ERROR;
                        break;
                    case 'critical':
                        $keyLevel = MonoLogger::CRITICAL;
                        break;
                    case 'alert':
                        $keyLevel = MonoLogger::ALERT;
                        break;
                    case 'emergency':
                        $keyLevel = MonoLogger::EMERGENCY;
                        break;
                    default:
                        $keyLevel = MonoLogger::WARNING;
                }
                $loggerFilename = $this->loggerPath . DIRECTORY_SEPARATOR . $loggerSubPath . DIRECTORY_SEPARATOR . $this->loggerFilename;
                $dateFormat = !empty($this->loggerDateFormat) ? $this->loggerDateFormat : "Y-m-d H:i:s u";
                $output = !empty($this->loggerLineFormat) ? $this->loggerLineFormat : "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
                $formatter = new MonoLineFormatter($output, $dateFormat);
                $stream = new MonoStreamHandler($loggerFilename, $keyLevel, self::LOG_BUBBLE, self::FILE_PERMISSION);
                $stream->setFormatter($formatter);
                $logger = new MonoLogger(ucfirst(trim($name)));
                $logger->pushHandler($stream);
                if (empty($msg)) {
                    $msg = 'My Log Message is Empty';
                }
                if (is_array($context)) {
                    return $logger->$level($msg, $context);
                }

                return $logger->$level($msg . json_encode($context));

            } catch (Exception $e) {
                if (function_exists('log_message')) {
                    log_message('error', 'Error Message: ' . $e->getMessage());
                    log_message('error', 'Error TraceAsString: ' . $e->getTraceAsString());
                }

                return false;
            }
        }

        return null;
    }

    /**
     * Function debug - Ghi log ở chế đô DEBUG (100): Detailed debug information.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function debug($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('debug', $name, $msg, $context);
    }

    /**
     * Function info - INFO (200): Interesting events. Examples: User logs in, SQL logs.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function info($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('info', $name, $msg, $context);
    }

    /**
     * Function notice - NOTICE (250): Normal but significant events.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function notice($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('notice', $name, $msg, $context);
    }

    /**
     * Function warning - WARNING (300): Exceptional occurrences that are not errors. - Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function warning($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('warning', $name, $msg, $context);
    }

    /**
     * Function error - ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function error($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('error', $name, $msg, $context);
    }

    /**
     * Function critical - CRITICAL (500): Critical conditions. - Application component unavailable, unexpected exception.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function critical($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('critical', $name, $msg, $context);
    }

    /**
     * Function alert - ALERT (550): Action must be taken immediately. - Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function alert($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('alert', $name, $msg, $context);
    }

    /**
     * Function emergency - EMERGENCY (600): Emergency: system is unusable.
     *
     * @param string       $name    Log Name: log, etc...
     * @param string       $msg     Log Message write to Log
     * @param array|string $context Log Context aka Log Message Array format
     *
     * @return bool|null TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 07:35
     */
    public function emergency($name = 'log', $msg = 'My Message', $context = array())
    {
        if (!is_array($context)) {
            $context = array($context);
        }

        return $this->log('emergency', $name, $msg, $context);
    }
}

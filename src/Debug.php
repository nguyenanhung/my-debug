<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/27/18
 * Time: 18:31
 */

namespace nguyenanhung\MyDebug;

use Exception;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

/**
 * Class Debug
 *
 * Class Debug là 1 Wrapper class customize lại Monolog để tiện sử dụng
 *
 * Mọi logic trong class này có thể không đúng với rules của Monolog
 * nhưng vẫn đảm bảo được việc ghi nhận log
 *
 * @category   Class
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
 * @since      2018-10-17
 * @version    2.0.2
 */
class Debug implements ProjectInterface, DebugInterface
{
    use Version;

    const LOG_BUBBLE      = TRUE;
    const FILE_PERMISSION = 0777;
    /** @var bool Cấu hình trạng thái Debug, TRUE nếu cấu hình Debug được bật */
    private $DEBUG = FALSE;
    /** @var null|string Cấu hình Level lưu Log theo tiêu chuẩn RFC 5424 */
    private $globalLoggerLevel = NULL;
    /** @var null|string Đường dẫn thư mục lưu trữ Log, VD: /your/to/path */
    private $loggerPath = 'logs';
    /** @var null|string Tương tự với $loggerPath, mặc định dùng để lưu tên class phát sinh log */
    private $loggerSubPath = NULL;
    /** @var null|string Filename lưu log, khuyến nghị theo chuẩn Log-Y-m-d.log, VD: Log-2018-10-17.log */
    private $loggerFilename = NULL;
    /** @var null|string Logger Date Format, VD: Y-m-d H:i:s u */
    private $loggerDateFormat = NULL;
    /** @var null|string Logger Line Format, VD: "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n" */
    private $loggerLineFormat = NULL;

    /**
     * Debug constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hàm lấy trạng thái Debug
     *
     * @return bool
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:52
     *
     */
    public function getDebugStatus()
    {
        return $this->DEBUG;
    }

    /**
     * Hàm cấu hình trạng thái Debug
     *
     * @param bool $debug TRUE nếu xác định lưu log, FALSE hoặc các giá trị khác sẽ không lưu log
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:52
     *
     */
    public function setDebugStatus($debug = FALSE)
    {
        $this->DEBUG = $debug;

        return $this;
    }

    /**
     * Hàm get Level lưu log cho toàn hệ thống
     *
     * @return null|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:53
     *
     */
    public function getGlobalLoggerLevel()
    {
        return $this->globalLoggerLevel;
    }

    /**
     * Hàm cấu hình level Debug
     *
     * @param null|string $globalLoggerLevel Level Debug được cấu hình theo chuẩn RFC 5424
     *
     * @return $this
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
     * @see   https://tools.ietf.org/html/rfc5424
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:53
     *
     */
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL)
    {
        if (!empty($globalLoggerLevel) && is_string($globalLoggerLevel)) {
            $this->globalLoggerLevel = strtolower($globalLoggerLevel);
        }

        return $this;
    }

    /**
     * Hàm lấy thư mục lưu log - main Path
     *
     * @return null|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:55
     *
     */
    public function getLoggerPath()
    {
        return $this->loggerPath;
    }

    /**
     * Hàm lấy thư mục lưu log - sub Path
     *
     * @return null|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:56
     *
     */
    public function getLoggerSubPath()
    {
        return $this->loggerSubPath;
    }

    /**
     * Hàm cấu hình thư mục lưu log - main Path
     *
     * @param string $logger_path Đường dẫn tới thư mục lưu log, VD: /your/to/path
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:56
     *
     */
    public function setLoggerPath($logger_path = '')
    {
        if (!empty($logger_path)) {
            $this->loggerPath = trim($logger_path);
        }

        return $this;
    }

    /**
     * Hàm cấu hình thư mục lưu log - sub Path
     *
     * @param string $sub_path Đường dẫn tới thư mục lưu log, VD: /your/to/sub-path
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     */
    public function setLoggerSubPath($sub_path = '')
    {
        if (!empty($sub_path)) {
            $this->loggerSubPath = trim($sub_path);
        }

        return $this;
    }

    /**
     * Hàm lấy tên file Log
     *
     * @return string|null
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     */
    public function getLoggerFilename()
    {
        return $this->loggerFilename;
    }

    /**
     * Hàm cấu hình file lưu trữ Log
     *
     * @param string $loggerFilename Filename cần lưu log, VD: app.log, Log-2018-10-17.log
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
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
     * Hàm lấy Date Format hiện tại
     *
     * @return null|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:58
     *
     */
    public function getLoggerDateFormat()
    {
        return $this->loggerDateFormat;
    }

    /**
     * Hàm quy định Date Format cho file Log
     *
     * @param null $loggerDateFormat Logger Date Format, VD: Y-m-d H:i:s u
     *
     * @return $this
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see   https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:59
     *
     */
    public function setLoggerDateFormat($loggerDateFormat = NULL)
    {
        if (!empty($loggerDateFormat) && is_string($loggerDateFormat)) {
            $this->loggerDateFormat = $loggerDateFormat;
        } else {
            $this->loggerDateFormat = "Y-m-d H:i:s u";
        }

        return $this;
    }

    /**
     * Hàm lấy thông tin về format dòng ghi log
     *
     * @return null|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:59
     *
     */
    public function getLoggerLineFormat()
    {
        return $this->loggerLineFormat;
    }

    /**
     * Hàm cấu hình thông tin về format dòng ghi log
     *
     * @param null $loggerLineFormat Line Format Input, example: [%datetime%] %channel%.%level_name%: %message%
     *                               %context% %extra%\n
     *
     * @return $this
     * @see   https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see   https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:00
     *
     */
    public function setLoggerLineFormat($loggerLineFormat = NULL)
    {
        if (!empty($loggerLineFormat) && is_string($loggerLineFormat)) {
            $this->loggerLineFormat = $loggerLineFormat;
        } else {
            $this->loggerLineFormat = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        }

        return $this;
    }

    /**
     * Hàm ghi log cho hệ thống
     *
     * @param string $level   Level Debug: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example log('info', 'test', 'Log Test', [])
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:35
     *
     */
    public function log($level = '', $name = 'log', $msg = 'My Message', $context = array())
    {
        $level = strtolower(trim($level));
        if ($this->DEBUG == TRUE) {
            if (!class_exists('\Monolog\Logger')) {
                if (function_exists('log_message')) {
                    $errorMsg = 'Không tồn tại class Monolog';
                    log_message('error', $errorMsg);
                }

                return FALSE;
            }
            try {
                $loggerSubPath = trim($this->loggerSubPath);
                $loggerSubPath = !empty($loggerSubPath) ? Utils::slugify($loggerSubPath) : 'Default-Sub-Path';
                if (empty($this->loggerFilename)) {
                    $this->loggerFilename = 'Log-' . date('Y-m-d') . '.log';
                }
                $listLevel = array('debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency');
                if (
                    // Tồn tại Global Logger Level
                    isset($this->globalLoggerLevel) &&
                    // Là 1 string
                    is_string($this->globalLoggerLevel) &&
                    // Và thuộc list Level được quy định
                    in_array($this->globalLoggerLevel, $listLevel)
                ) {
                    // If valid globalLoggerLevel -> use globalLoggerLevel
                    $useLevel = strtolower($this->globalLoggerLevel);
                } else {
                    // Default Level is INFO
                    $useLevel = in_array($level, $listLevel) ? trim($level) : trim('info');
                }
                switch ($useLevel) {
                    case 'debug':
                        $keyLevel = Logger::DEBUG;
                        break;
                    case 'info':
                        $keyLevel = Logger::INFO;
                        break;
                    case 'notice':
                        $keyLevel = Logger::NOTICE;
                        break;
                    case 'warning':
                        $keyLevel = Logger::WARNING;
                        break;
                    case 'error':
                        $keyLevel = Logger::ERROR;
                        break;
                    case 'critical':
                        $keyLevel = Logger::CRITICAL;
                        break;
                    case 'alert':
                        $keyLevel = Logger::ALERT;
                        break;
                    case 'emergency':
                        $keyLevel = Logger::EMERGENCY;
                        break;
                    default:
                        $keyLevel = Logger::WARNING;
                }
                $loggerFilename = $this->loggerPath . DIRECTORY_SEPARATOR . $loggerSubPath . DIRECTORY_SEPARATOR . $this->loggerFilename;
                $dateFormat     = !empty($this->loggerDateFormat) ? $this->loggerDateFormat : "Y-m-d H:i:s u";
                $output         = !empty($this->loggerLineFormat) ? $this->loggerLineFormat : "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
                $formatter      = new LineFormatter($output, $dateFormat);
                $stream         = new StreamHandler($loggerFilename, $keyLevel, self::LOG_BUBBLE, self::FILE_PERMISSION);
                $stream->setFormatter($formatter);
                $logger = new Logger(trim($name));
                $logger->pushHandler($stream);
                if (empty($msg)) {
                    $msg = 'My Log Message is Empty';
                }
                if (is_array($context)) {
                    return $logger->$level($msg, $context);
                } else {
                    return $logger->$level($msg . json_encode($context));
                }
            }
            catch (Exception $e) {
                if (function_exists('log_message')) {
                    log_message('error', 'Error Message: ' . $e->getMessage());
                    log_message('error', 'Error TraceAsString: ' . $e->getTraceAsString());
                }

                return FALSE;
            }
        }

        return NULL;
    }

    /**
     * Function debug
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example DEBUG (100): Detailed debug information.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:33
     *
     */
    public function debug($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('debug', $name, $msg, $context);
    }

    /**
     * Function info
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example INFO (200): Interesting events. Examples: User logs in, SQL logs.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:33
     *
     */
    public function info($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('info', $name, $msg, $context);
    }

    /**
     * Function notice
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example NOTICE (250): Normal but significant events.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     */
    public function notice($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('notice', $name, $msg, $context);
    }

    /**
     * Function warning
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example : WARNING (300): Exceptional occurrences that are not errors. - Use of deprecated APIs, poor use of an
     *          API, undesirable things that are not necessarily wrong.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     */
    public function warning($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('warning', $name, $msg, $context);
    }

    /**
     * Function error
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example ERROR (400): Runtime errors that do not require immediate action but should typically be logged and
     *          monitored.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:37
     *
     */
    public function error($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('error', $name, $msg, $context);
    }

    /**
     * Function critical
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example : CRITICAL (500): Critical conditions. - Application component unavailable, unexpected exception.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     */
    public function critical($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('critical', $name, $msg, $context);
    }

    /**
     * Function alert
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example : ALERT (550): Action must be taken immediately. - Entire website down, database unavailable, etc. This
     *          should trigger the SMS alerts and wake you up.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     */
    public function alert($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('alert', $name, $msg, $context);
    }

    /**
     * Function emergency
     *
     * @param string $name    Log Name: log, etc...
     * @param string $msg     Log Message write to Log
     * @param array  $context Log Context aka Log Message Array format
     *
     * @return mixed TRUE nếu ghi log thành công, FALSE nếu ghi log thất bại, Message Error nếu có lỗi Exception xảy
     *               ra, ngoài ra các trường hợp khác sẽ trả về mã Null
     * @example EMERGENCY (600): Emergency: system is unusable.
     *
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/6/18 23:38
     *
     */
    public function emergency($name = 'log', $msg = 'My Message', $context = array())
    {
        return $this->log('emergency', $name, $msg, $context);
    }
}

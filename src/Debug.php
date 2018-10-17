<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/27/18
 * Time: 18:31
 */

namespace nguyenanhung\MyDebug;

if (!interface_exists('nguyenanhung\MyDebug\Interfaces\ProjectInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'ProjectInterface.php';
}
if (!interface_exists('nguyenanhung\MyDebug\Interfaces\DebugInterface')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'Interfaces' . DIRECTORY_SEPARATOR . 'DebugInterface.php';
}

use nguyenanhung\MyDebug\Interfaces\ProjectInterface;
use nguyenanhung\MyDebug\Interfaces\DebugInterface;

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
 * @version    0.1.2.5
 */
class Debug implements ProjectInterface, DebugInterface
{
    const LOG_BUBBLE      = TRUE;
    const FILE_PERMISSION = 0777;
    /** @var bool Cấu hình trạng thái Debug, TRUE nếu cấu hình Debug được bật */
    private $DEBUG = FALSE;
    /**
     * @var null|string Cấu hình Level lưu Log
     * @see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
     */
    private $globalLoggerLevel = NULL;
    /** @var null|string Đường dẫn thư mục lưu trữ Log, VD: /your/to/path */
    private $loggerPath = 'logs';
    /** @var null|string Tương tự với $loggerPath, mặc định dùng để lưu tên class phát sinh log */
    private $loggerSubPath = NULL;
    /** @var string Filename lưu log, khuyến nghị theo chuẩn Log-Y-m-d.log, VD: Log-2018-10-17.log */
    private $loggerFilename = 'app.log';
    /** @var null|string Logger Date Format, VD: Y-m-d H:i:s u */
    private $loggerDateFormat = NULL;
    /** @var null|string Logger Line Format, VD: "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n" */
    private $loggerLineFormat = NULL;

    /**
     * BaseDebug constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hàm lấy thông tin phiên bản Packages
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:32
     *
     * @return string Phiên bản hiện tại của Packages, VD: 0.1.1
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Hàm lấy trạng thái Debug
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:52
     *
     * @return bool|mixed
     */
    public function getDebugStatus()
    {
        return $this->DEBUG;
    }

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
    public function setDebugStatus($debug = FALSE)
    {
        $this->DEBUG = $debug;
    }

    /**
     * Hàm get Level lưu log cho toàn hệ thống
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:53
     *
     * @return mixed|null|string
     */
    public function getGlobalLoggerLevel()
    {
        return $this->globalLoggerLevel;
    }

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
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL)
    {
        if (!empty($globalLoggerLevel) && is_string($globalLoggerLevel)) {
            $this->globalLoggerLevel = strtolower($globalLoggerLevel);
        }
    }

    /**
     * Hàm lấy thư mục lưu log - main Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:55
     *
     * @return mixed|null|string
     */
    public function getLoggerPath()
    {
        return $this->loggerPath;
    }

    /**
     * Hàm lấy thư mục lưu log - sub Path
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:56
     *
     * @return mixed|null|string
     */
    public function getLoggerSubPath()
    {
        return $this->loggerSubPath;
    }

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
    public function setLoggerPath($logger_path = '')
    {
        if (!empty($logger_path)) {
            $this->loggerPath = trim($logger_path);
        }
    }

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
    public function setLoggerSubPath($sub_path = '')
    {
        if (!empty($sub_path)) {
            $this->loggerSubPath = trim($sub_path) . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * Hàm lấy tên file Log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:57
     *
     * @return mixed|string
     */
    public function getLoggerFilename()
    {
        return $this->loggerFilename;
    }

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
    public function setLoggerFilename($loggerFilename = '')
    {
        if (!empty($loggerFilename)) {
            $this->loggerFilename = trim($loggerFilename);
        }
    }

    /**
     * Hàm lấy Date Format hiện tại
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:58
     *
     * @return null|string
     */
    public function getLoggerDateFormat()
    {
        return $this->loggerDateFormat;
    }

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
    public function setLoggerDateFormat($loggerDateFormat = NULL)
    {
        if (!empty($loggerDateFormat) && is_string($loggerDateFormat)) {
            $this->loggerDateFormat = $loggerDateFormat;
        }
    }

    /**
     * Hàm lấy thông tin về format dòng ghi log
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 09:59
     *
     * @return null|string
     */
    public function getLoggerLineFormat()
    {
        return $this->loggerLineFormat;
    }

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
    public function setLoggerLineFormat($loggerLineFormat = NULL)
    {
        if (!empty($loggerLineFormat) && is_string($loggerLineFormat)) {
            $this->loggerLineFormat = $loggerLineFormat;
        }
    }

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
    public function log($level = '', $name = 'log', $msg = 'My Message', $context = [])
    {
        $level = strtolower(trim($level));
        if ($this->DEBUG == TRUE) {
            if (!class_exists('\Monolog\Logger')) {
                return FALSE;
            }
            try {
                $loggerSubPath = trim($this->loggerSubPath);
                if (!empty($loggerSubPath)) {
                    $loggerSubPath = Utils::slugify($loggerSubPath);
                }
                $listLevel = [
                    'debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'
                ];
                if (
                    isset($this->globalLoggerLevel) &&
                    is_string($this->globalLoggerLevel) &&
                    in_array($this->globalLoggerLevel, $listLevel)
                ) {
                    // If valid globalLoggerLevel -> use globalLoggerLevel
                    $useLevel = strtolower($this->globalLoggerLevel);
                } else {
                    $useLevel = in_array($level, $listLevel) ? trim($level) : trim('info');
                }
                switch ($useLevel) {
                    case 'debug':
                        $keyLevel = \Monolog\Logger::DEBUG;
                        break;
                    case 'info':
                        $keyLevel = \Monolog\Logger::INFO;
                        break;
                    case 'notice':
                        $keyLevel = \Monolog\Logger::NOTICE;
                        break;
                    case 'warning':
                        $keyLevel = \Monolog\Logger::WARNING;
                        break;
                    case 'error':
                        $keyLevel = \Monolog\Logger::ERROR;
                        break;
                    case 'critical':
                        $keyLevel = \Monolog\Logger::CRITICAL;
                        break;
                    case 'alert':
                        $keyLevel = \Monolog\Logger::ALERT;
                        break;
                    case 'emergency':
                        $keyLevel = \Monolog\Logger::EMERGENCY;
                        break;
                    default:
                        $keyLevel = \Monolog\Logger::WARNING;
                }
                $loggerFilename = $this->loggerPath . DIRECTORY_SEPARATOR . $loggerSubPath . DIRECTORY_SEPARATOR . $this->loggerFilename;
                $dateFormat     = $this->loggerDateFormat ? $this->loggerDateFormat : "Y-m-d H:i:s u";
                $output         = $this->loggerLineFormat ? $this->loggerLineFormat : "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
                $formatter      = new \Monolog\Formatter\LineFormatter($output, $dateFormat);
                $stream         = new \Monolog\Handler\StreamHandler($loggerFilename, $keyLevel, self::LOG_BUBBLE, self::FILE_PERMISSION);
                $stream->setFormatter($formatter);
                $logger = new \Monolog\Logger(trim($name));
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
            catch (\Exception $e) {
                $message = 'Error File: ' . $e->getFile() . ' - Line: ' . $e->getLine() . ' - Code: ' . $e->getCode() . ' - Message: ' . $e->getMessage();

                return $message;
            }
        }

        return NULL;
    }

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
    public function debug($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('debug', $name, $msg, $context);
    }

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
    public function info($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('info', $name, $msg, $context);
    }

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
    public function notice($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('notice', $name, $msg, $context);
    }

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
    public function warning($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('warning', $name, $msg, $context);
    }

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
    public function error($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('error', $name, $msg, $context);
    }

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
    public function critical($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('critical', $name, $msg, $context);
    }

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
    public function alert($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('alert', $name, $msg, $context);
    }

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
    public function emergency($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('emergency', $name, $msg, $context);
    }
}

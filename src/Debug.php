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
 * @category   Class
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
 */
class Debug implements ProjectInterface, DebugInterface
{
    const LOG_BUBBLE      = TRUE;
    const FILE_PERMISSION = 0777;
    /**
     * Set Debug Status
     *
     * @var bool
     */
    private $DEBUG = FALSE;
    /**
     * Set Global Logger Level
     *
     * @var null
     */
    private $globalLoggerLevel = NULL;
    /**
     * Main Folder save Log
     *
     * @var string
     */
    private $loggerPath = 'logs';
    /**
     * Main Folder save Log
     *
     * @var null|string
     */
    private $loggerSubPath = NULL;
    /**
     * Filename to save Log
     *
     * @var string
     */
    private $loggerFilename = 'app.log';
    /**
     * @var null|string Logger Date Format
     */
    private $loggerDateFormat = NULL;
    /**
     * @var null|string Logger Line Format
     */
    private $loggerLineFormat = NULL;

    /**
     * BaseDebug constructor.
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:32
     *
     * @return string Current Version of Package
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function getDebugStatus
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:33
     *
     * @return bool
     */
    public function getDebugStatus()
    {
        return $this->DEBUG;
    }

    /**
     * Function setDebugStatus
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:33
     *
     * @param bool $debug Set TRUE if Enabled Debug
     */
    public function setDebugStatus($debug = FALSE)
    {
        $this->DEBUG = $debug;
    }

    /**
     * Function getGlobalLoggerLevel
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 09:55
     *
     * @return null
     */
    public function getGlobalLoggerLevel()
    {
        return $this->globalLoggerLevel;
    }

    /**
     * Function setGlobalLoggerLevel
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/9/18 09:55
     *
     * @param null $globalLoggerLevel or Key Level to Debug
     *                                debug, info, notice, warning, error, critical, alert, emergency
     */
    public function setGlobalLoggerLevel($globalLoggerLevel = NULL)
    {
        if (!empty($logger_filename) && is_string($globalLoggerLevel)) {
            $this->globalLoggerLevel = strtolower($globalLoggerLevel);
        }
    }

    /**
     * Function getLoggerPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:40
     *
     * @return string
     */
    public function getLoggerPath()
    {
        return $this->loggerPath;
    }

    /**
     * Function getLoggerSubPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 19:03
     *
     * @return mixed|null
     */
    public function getLoggerSubPath()
    {
        return $this->loggerSubPath;
    }

    /**
     * Function setLoggerPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:40
     *
     * @param string $logger_path /your/to/path
     */
    public function setLoggerPath($logger_path = '')
    {
        if (!empty($logger_path)) {
            $this->loggerPath = trim($logger_path);
        }
    }

    /**
     * Function setLoggerSubPath
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 19:04
     *
     * @param string $sub_path /your/to/sub_path
     */
    public function setLoggerSubPath($sub_path = '')
    {
        if (!empty($sub_path)) {
            $this->loggerSubPath = trim($sub_path) . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * Function getLoggerFilename
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:49
     *
     * @return mixed Get Logger filename
     */
    public function getLoggerFilename()
    {
        return $this->loggerFilename;
    }

    /**
     * Function setLoggerFilename
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:49
     *
     * @param string $logger_filename Set Log Filename, example app.log
     */
    public function setLoggerFilename($logger_filename = '')
    {
        if (!empty($logger_filename)) {
            $this->loggerFilename = trim($logger_filename);
        }
    }

    /**
     * Function getLoggerDateFormat
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:07
     *
     * @return null|string Get Logger Date Format
     */
    public function getLoggerDateFormat()
    {
        return $this->loggerDateFormat;
    }

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
    public function setLoggerDateFormat($loggerDateFormat = NULL)
    {
        if (!empty($loggerDateFormat) && is_string($loggerDateFormat)) {
            $this->loggerDateFormat = $loggerDateFormat;
        }
    }

    /**
     * Function getLoggerLineFormat
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/10/18 10:08
     *
     * @return null|string  Get Logger Line Format
     */
    public function getLoggerLineFormat()
    {
        return $this->loggerLineFormat;
    }

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
    public function setLoggerLineFormat($loggerLineFormat = NULL)
    {
        if (!empty($loggerLineFormat) && is_string($loggerLineFormat)) {
            $this->loggerLineFormat = $loggerLineFormat;
        }
    }

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
                $useLevel  = $this->globalLoggerLevel && in_array($listLevel, $listLevel) ? strtolower($this->globalLoggerLevel) : (in_array($level, $listLevel) ? $level : 'info');
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
                    return $logger->$useLevel($msg, $context);
                } else {
                    return $logger->$useLevel($msg . json_encode($context));
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
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
     * @return mixed TRUE if Success, FALSE if not, NULL if Error
     */
    public function emergency($name = 'log', $msg = 'My Message', $context = [])
    {
        return $this->log('emergency', $name, $msg, $context);
    }
}

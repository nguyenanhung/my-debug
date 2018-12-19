<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/13/18
 * Time: 10:48
 */

namespace nguyenanhung\MyDebug;

use nguyenanhung\MyDebug\Interfaces\ProjectInterface;
use nguyenanhung\MyDebug\Interfaces\BenchmarkInterface;

/**
 * Class Benchmark
 *
 * Được thiết kế dựa trên ý tưởng từ class Benchmark của CodeIgniter
 *
 * @category   Class
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
 * @since      2018-10-17
 * @version    0.1.2.5
 */
class Benchmark implements ProjectInterface, BenchmarkInterface
{
    /**
     * Benchmark constructor.
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 10:49
     *
     * @return mixed|string
     */
    public function getVersion()
    {
        return self::VERSION;
    }
    /***************************** SIMPLE BENCHMARKING BY CI *****************************/
    /**
     * List of all benchmark markers
     *
     * @var    array
     */
    public $marker = [];

    /**
     * Set a benchmark marker
     *
     * Multiple calls to this function can be made so that several
     * execution points can be timed.
     *
     * @param    string $name Marker name
     *
     * @return    void
     */
    public function mark($name)
    {
        $this->marker[$name] = microtime(TRUE);
    }

    /**
     * Elapsed time
     *
     * Calculates the time difference between two marked points.
     *
     * If the first parameter is empty this function instead returns the
     * {elapsed_time} pseudo-variable. This permits the full system
     * execution time to be shown in a template. The output class will
     * swap the real value for this variable.
     *
     * @param    string $point1   A particular marked point
     * @param    string $point2   A particular marked point
     * @param    int    $decimals Number of decimal places
     *
     * @return    string    Calculated elapsed time on success,
     *            an '{elapsed_string}' if $point1 is empty
     *            or an empty string if $point1 is not found.
     */
    public function elapsed_time($point1 = '', $point2 = '', $decimals = 4)
    {
        if ($point1 === '') {
            return '{elapsed_time}';
        }

        if (!isset($this->marker[$point1])) {
            return '';
        }

        if (!isset($this->marker[$point2])) {
            $this->marker[$point2] = microtime(TRUE);
        }

        return number_format($this->marker[$point2] - $this->marker[$point1], $decimals);
    }

    /**
     * Function memory_usage
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 10:52
     *
     * @return string
     */
    public function memory_usage()
    {
        $memory = round(memory_get_usage() / 1024 / 1024, 2) . 'MB';

        return $memory;
    }
}

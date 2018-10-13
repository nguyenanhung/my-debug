<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/13/18
 * Time: 11:04
 */

namespace nguyenanhung\MyDebug\Interfaces;

/**
 * Interface BenchmarkInterface
 *
 * @category  Interface
 * @package   nguyenanhung\MyDebug\Interfaces
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface BenchmarkInterface
{
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
    public function mark($name);

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
    public function elapsed_time($point1 = '', $point2 = '', $decimals = 4);

    /**
     * Function memory_usage
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/13/18 10:52
     *
     * @return string
     */
    public function memory_usage();
}
<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/7/18
 * Time: 20:27
 */

namespace nguyenanhung\MyDebug;

/**
 * Interface Project
 *
 * @package   nguyenanhung\MyDebug
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface Project
{
	const VERSION = '4.0.5';

	/**
	 * Hàm lấy thông tin phiên bản Packages
	 *
	 * @return string Phiên bản hiện tại của Packages, VD: 2.0.1
	 *
	 * @author   : 713uk13m <dev@nguyenanhung.com>
	 * @copyright: 713uk13m <dev@nguyenanhung.com>
	 * @time     : 9/27/18 18:32
	 */
	public function getVersion(): string;
}

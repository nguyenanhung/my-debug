<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/17/18
 * Time: 10:17
 */

namespace nguyenanhung\MyDebug\Manager;

use Symfony\Component\Filesystem\Filesystem;
use TheSeer\DirectoryScanner\DirectoryScanner;

/**
 * Class File
 *
 * Class File được kế thừa từ class Filesystem của Symfony và bổ sung thêm 1 số phương thức khác
 *
 * @see        https://symfony.com/doc/current/components/filesystem.html
 *
 * @category   Class
 * @package    nguyenanhung\MyDebug
 * @author     713uk13m <dev@nguyenanhung.com>
 * @copyright  713uk13m <dev@nguyenanhung.com>
 * @since      2018-10-17
 * @version    0.1.2.5
 */
class File extends Filesystem
{
    const VERSION = '1.0.0';

    /** @var null|array Mảng dữ liệu chứa các thuộc tính cần quét */
    private $removeLogInclude = [
        '*.log',
        '*.txt'
    ];

    /** @var null|array Mảng dữ liệu chứa các thuộc tính bỏ qua không quét */
    private $removeLogExclude;

    /**
     * File constructor.
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
     * Hàm quét thư mục và list ra danh sách các file con
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:19
     *
     * @param string     $path    Đường dẫn thư mục cần quét, VD: /your/to/path
     * @param null|array $include Mảng dữ liệu chứa các thuộc tính cần quét
     * @param null|array $exclude Mảng dữ liệu chứa các thuộc tính bỏ qua không quét
     *
     * @see   https://github.com/theseer/DirectoryScanner/blob/master/samples/sample.php
     *
     * @return \Iterator
     */
    public function directoryScanner($path = '', $include = NULL, $exclude = NULL)
    {
        $scanner = new DirectoryScanner();
        if (is_array($include) && !empty($include)) {
            foreach ($include as $inc) {
                $scanner->addInclude($inc);
            }
        }
        if (is_array($exclude) && !empty($exclude)) {
            foreach ($exclude as $exc) {
                $scanner->addExclude($exc);
            }
        }

        return $scanner($path);
    }

    /**
     * Function setInclude
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:23
     *
     * @param array $include
     */
    public function setInclude($include = [])
    {
        $this->removeLogInclude = $include;
    }

    /**
     * Function setExclude
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:23
     *
     * @param array $exclude
     */
    public function setExclude($exclude = [])
    {
        $this->removeLogExclude = $exclude;
    }

    /**
     * Hàm xóa các file Log được chỉ định
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:21
     *
     * @param string $path     Thư mục cần quét và xóa
     * @param int    $dayToDel Số ngày cần giữ lại file
     *
     * @return array Mảng thông tin về các file đã xóa
     */
    public function clean($path = '', $dayToDel = 3)
    {
        $getDir = $this->directoryScanner($path, $this->removeLogInclude, $this->removeLogExclude);
        $result = [];
        foreach ($getDir as $fileName) {
            $SplFileInfo = new \SplFileInfo($fileName);
            $filename    = $SplFileInfo->getPathname();
            $format      = 'YmdHis';
            // Lấy thời gian xác định xóa fileName
            $dateTime   = new \DateTime("-" . $dayToDel . " days");
            $deleteTime = $dateTime->format($format);
            // Lấy modifyTime của file
            $getfileTime = filemtime($filename);
            $fileTime    = date($format, $getfileTime);
            if ($fileTime < $deleteTime) {
                $this->chmod($filename, 0777);
                $this->remove($filename);
                $result[] .= "Delete file: " . $filename;
            }
        }

        return $result;
    }
}

<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/17/18
 * Time: 10:17
 */

namespace nguyenanhung\MyDebug\Manager;

use Exception;
use SplFileInfo;
use DateTime;
use Symfony\Component\Filesystem\Filesystem;
use TheSeer\DirectoryScanner\DirectoryScanner;
use Alchemy\Zippy\Zippy;

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
    private $scanInclude = ['*.log', '*.txt'];
    /** @var null|array Mảng dữ liệu chứa các thuộc tính bỏ qua không quét */
    private $scanExclude = ['*/Zip-Archive/*.zip'];

    /**
     * File constructor.
     */
    public function __construct()
    {
    }

    /**
     * Hàm lấy thông tin phiên bản Packages
     *
     * @return string Phiên bản hiện tại của Packages, VD: 0.1.1
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/27/18 18:32
     *
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Hàm quét thư mục và list ra danh sách các file con
     *
     * @param string     $path    Đường dẫn thư mục cần quét, VD: /your/to/path
     * @param null|array $include Mảng dữ liệu chứa các thuộc tính cần quét
     * @param null|array $exclude Mảng dữ liệu chứa các thuộc tính bỏ qua không quét
     *
     * @return \Iterator
     * @see   https://github.com/theseer/DirectoryScanner/blob/master/samples/sample.php
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:19
     *
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
     * @param array $include
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:23
     *
     */
    public function setInclude($include = [])
    {
        $this->scanInclude = $include;
    }

    /**
     * Function setExclude
     *
     * @param array $exclude
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:23
     *
     */
    public function setExclude($exclude = [])
    {
        $this->scanExclude = $exclude;
    }

    /**
     * Hàm xóa các file Log được chỉ định
     *
     * @param string $path        Thư mục cần quét và xóa
     * @param int    $dayToDelete Số ngày cần giữ lại file
     *
     * @return array|bool Array nếu trả về mảng dữ liệu cần delete, false nếu có lỗi xảy ra
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/30/2020 59:36
     */
    public function cleanLog($path = '', $dayToDelete = 3)
    {
        try {
            $getDir             = $this->directoryScanner($path, $this->scanInclude, $this->scanExclude);
            $result             = [];
            $result['time']     = date('Y-m-d H:i:s');
            $result['listFile'] = [];
            foreach ($getDir as $fileName) {
                $SplFileInfo = new SplFileInfo($fileName);
                $filename    = $SplFileInfo->getPathname();
                $format      = 'YmdHis';
                // Lấy thời gian xác định xóa fileName
                $dateTime   = new DateTime("-" . $dayToDelete . " days");
                $deleteTime = $dateTime->format($format);
                // Lấy modifyTime của file
                $getfileTime = filemtime($filename);
                $fileTime    = date($format, $getfileTime);
                if ($fileTime < $deleteTime) {
                    $this->chmod($filename, 0777);
                    $this->remove($filename);
                    $result['listFile'][] .= "Delete file: " . $filename;
                }
            }

            return $result;
        }
        catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', 'Error Message: ' . $e->getMessage());
                log_message('error', 'Error Trace As String: ' . $e->getTraceAsString());
            }

            return FALSE;
        }
    }

    /**
     * Hàm quét và xoá các file Log từ 1 mảng chỉ định
     *
     * @param array $listFolder  Mảng chứa dữ liệu các folder cần quét
     * @param int   $dayToDelete Số ngày cần lưu giữ
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/30/2020 03:15
     */
    public function scanAndCleanLog($listFolder = array(), $dayToDelete = 3)
    {
        if (empty($listFolder)) {
            echo "Không có mảng dữ liệu cần quét";
        }
        foreach ($listFolder as $folder) {
            echo "=========|| DELETE FOLDER LOG: " . $folder . " ||=========" . PHP_EOL;
            echo $this->cleanLog($folder, $dayToDelete) . PHP_EOL;
        }
    }

    /**
     * Hàm quét thư mục và zip toàn bộ các file thỏa mãn điều kiện
     *
     * @param string $scanPath Thư mục cần quét file và zip
     * @param int    $dayToZip Số ngày bỏ qua không zipm mặc định = 3
     * @param string $zipPath  Thư mục lưu trữ file Zip
     *
     * @return array Mảng thông tin về các file đã Zip được và thư mục lưu trữ file Zip, trong đó
     *
     *               'time' => Là thời gian thực hiện quét và nén file
     *
     *               'timeToZip' => Là mốc thời gian thực hiện để quét file
     *
     *               'zipPath' => Là thư mục đích lưu trữ file đã nén
     *
     *               'zipFilePath' => Tên file nén
     *
     *               'listFile' => Mảng dữ liệu chứa danh sách file đã nén, trống biến này nghĩa là ko tìm thấy file nào
     * @throws \Exception
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/17/18 10:51
     *
     */
    public function scanAndZip($scanPath = '', $dayToZip = 3, $zipPath = '')
    {
        $getDir = $this->directoryScanner($scanPath, $this->scanInclude, $this->scanExclude);
        if (empty($zipPath)) {
            /**
             * Nếu không truyền folder đích lưu trữ file Zip
             * sẽ Tạo 1 thư mục Con trong folder đó để lưu trữ file Zip
             */
            $zipPath = $scanPath . DIRECTORY_SEPARATOR . 'Zip-Archive' . DIRECTORY_SEPARATOR;
        }
        $zipPathFilename = $zipPath . date('Y-m-d-H-i-s') . '-archive.zip';
        // Lấy thời gian xác định sẽ Zip file
        $format                = 'YmdHis';
        $dateTime              = new DateTime("-" . $dayToZip . " days");
        $zipTime               = $dateTime->format($format);
        $result                = [];
        $result['time']        = date('Y-m-d H:i:s');
        $result['timeToZip']   = $dateTime->format('Y-m-d H:i:s');
        $result['zipPath']     = $zipPath;
        $result['zipFilePath'] = $zipPathFilename;
        $result['listFile']    = [];
        foreach ($getDir as $fileName) {
            $SplFileInfo = new SplFileInfo($fileName);
            $filename    = $SplFileInfo->getPathname();
            // Lấy modifyTime của file
            $getfileTime = filemtime($filename);
            $fileTime    = date($format, $getfileTime);
            if ($fileTime < $zipTime) {
                if (!file_exists($zipPath)) {
                    $this->mkdir($zipPath);
                }
                // Load Zippy
                $zippy                = Zippy::load();
                $archive              = $zippy->create($zipPathFilename, [
                    $filename => $filename
                ], TRUE);
                $result['listFile'][] .= "Zip file: " . $filename . ' -> ' . json_encode($archive);
            }
        }

        return $result;
    }
}

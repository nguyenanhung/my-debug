<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 9/19/18
 * Time: 13:37
 */
spl_autoload_register(function ($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName = __DIR__ . DIRECTORY_SEPARATOR . $fileName . $className . '.php';
    //
    if (strpos($fileName, 'nguyenanhung\MyDebug\Interfaces') !== FALSE) {
        $fileName = str_replace('nguyenanhung\MyDebug\Interfaces', 'src\Interfaces', $fileName);
    } elseif (strpos($fileName, 'nguyenanhung\MyDebug\Repository') !== FALSE) {
        $fileName = str_replace('nguyenanhung\MyDebug\Repository', 'src\Repository', $fileName);
    } elseif (strpos($fileName, 'nguyenanhung\MyDebug\Helpers') !== FALSE) {
        $fileName = str_replace('nguyenanhung\MyDebug\Helpers', 'src\Helpers', $fileName);
    } else {
        $fileName = str_replace('nguyenanhung\MyDebug', 'src', $fileName);
    }

    if (file_exists($fileName)) {
        require $fileName;

        return TRUE;
    }

    return FALSE;
});

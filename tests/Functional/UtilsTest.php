<?php
/**
 * Project my-debug.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/25/18
 * Time: 11:37
 */

namespace Tests\Functional;

use nguyenanhung\MyDebug\Utils;
class UtilsTest extends BaseTestCase
{
    public function testUtilsSlugify()
    {
        $str    = 'Nguyễn An Hưng';
        $needle = 'nguyen-an-hung';
        $this->assertContains($needle, Utils::slugify($str), 'Test Ok Utils slugify');
    }
}

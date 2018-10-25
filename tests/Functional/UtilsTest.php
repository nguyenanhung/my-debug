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
    /**
     * Function testUtilsSlugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/25/18 11:45
     *
     */
    public function testUtilsSlugify()
    {
        $this->assertContains('nguyen-an-hung', Utils::slugify('nguyễn an hưng'), 'false');
    }
}

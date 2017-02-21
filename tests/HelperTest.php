<?php

/*
 * This file is part of the limit0/helpers package.
 *
 * (c) Limit Zero, LLC <contact@limit0.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Limit0\Assets\Tests;

use PHPUnit\Framework\TestCase;
use Limit0\Helpers\Helper;

/**
 * Tests the helper class.
 *
 * @author Jacob Bare <jacob@limit0.io>
 */
class HelperTest extends TestCase
{
    public function testInstance()
    {
        $helper  = Helper::getInstance();
        $helper2 = Helper::getInstance();

        $this->assertSame($helper2, $helper);
    }
}

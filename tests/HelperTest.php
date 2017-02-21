<?php

/*
 * This file is part of the limit0/helpers package.
 *
 * (c) Limit Zero, LLC <contact@limit0.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Limit0\Helpers;

use PHPUnit\Framework\TestCase;
use Limit0\Helpers\Helper;

/**
 * Tests the helper class.
 *
 * @author Jacob Bare <jacob@limit0.io>
 */
class HelperTest extends TestCase
{
    public function testFormatEmailAddress()
    {
        $helper = Helper::getInstance();
        $email  = $helper->formatEmailAddress('  jAcoB@limiT0.io ');
        $this->assertEquals('jacob@limit0.io', $email);
    }

    public function testIsEmailAddressValid()
    {
        $helper = Helper::getInstance();
        $good   = ['jacob@limit0.io', '123@some.com'];
        $bad    = [null, 'foo', 'foo@', 'foo.com@', 'foo@foo', 'foo@@foo.com', 'foo@bar.co@m', 'foo@ bar.com'];

        foreach ($good as $value) {
            $this->assertTrue($helper->isEmailAddressValid($value));
        }
        foreach ($bad as $value) {
            $this->assertFalse($helper->isEmailAddressValid($value));
        }
    }

    public function testIsMongoIdFormat()
    {
        $helper = Helper::getInstance();
        $good   = ['57d964fc35ab46fd3de68544', strtoupper('57b20ffc95b9de6773baebeb')];
        $bad    = ['', null, 12, '5734af34', '57y964fc35xb46fd3dg68544'];

        foreach ($good as $value) {
            $this->assertTrue($helper->isMongoIdFormat($value));
        }
        foreach ($bad as $value) {
            $this->assertFalse($helper->isMongoIdFormat($value));
        }
    }

    public function testPrivateClassMethods()
    {
        $reflection = new \ReflectionClass('\Limit0\Helpers\Helper');
        foreach (['__construct', '__clone', '__wakeup'] as $name) {
            $method = $reflection->getMethod($name);
            $this->assertFalse($method->isPublic());
        }
    }

    public function testSingletonInstance()
    {
        $helper  = Helper::getInstance();
        $helper2 = Helper::getInstance();

        $this->assertSame($helper2, $helper);
    }
}

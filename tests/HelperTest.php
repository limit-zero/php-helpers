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

    public function testIsHexValue()
    {
        $helper = Helper::getInstance();
        $good = [
            ['abc34a', null, null],
            ['abc34a', 0, 0],
            ['abc34a', -2, -1],
            ['abc34a', 0, 6],
            ['a34a', 0, 6],
            ['abc34a', 6, null],
            ['abc34ab', 6, 0],
            ['abc34AB', 6, 0],
        ];
        foreach ($good as $value) {
            list($string, $min, $max) = $value;
            $this->assertTrue($helper->isHexValue($string, $min, $max));
        }

        $bad = [
            ['abc34', 6, null],
            ['abc34', 6, 6],
            ['abc34ab', 6, 6],
            ['abc34ab', 0, 6],
            ['abc34z', null, null],
        ];
        foreach ($bad as $value) {
            list($string, $min, $max) = $value;
            $this->assertFalse($helper->isHexValue($string, $min, $max));
        }
    }

    /**
     * @expectedException OutOfRangeException
     */
    public function testIsHexValueException()
    {
        $helper     = Helper::getInstance();
        $helper->isHexValue('abc', 2, 1);
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

    public function testSluggifyValue()
    {
        $helper = Helper::getInstance();
        $cases = [
            'hello-world'        => 'Hello World',
            'hello-world'        => '<p>Hello <strong>World</strong></p>',
            'hello-world'        => '<p>Hello <a href="#">World</a>',
            'hello-world'        => 'Hello <a href="#">World</a></p>',
            'hello-world'        => '&#x3C;p&#x3E;Hello &#x3C;a href=&#x22;#&#x22;&#x3E;World&#x3C;/a&#x3E;',
            'hello-world'        => '&lt;p&gt;Hello &lt;a href=&quot;#&quot;&gt;World&lt;/a&gt;',
            'hello-world-1'      => '   Hello      world       1   ',
            'hello-and-at-world' => 'Hello & @ World!',
            'hello-and-at-world' => 'Hello &amp; @ World! # $ % ^ * ( ) { } [ ] ; : " < > , . / ? | \\ \'',
        ];

        foreach ($cases as $expected => $value) {
            $this->assertEquals($expected, $helper->sluggifyValue($value));
        }
    }
}

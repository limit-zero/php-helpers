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

/**
 * Helper utilities for common activities.
 *
 * @author Jacob Bare <jacob@limit0.io>
 */
final class Helper
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * Gets the singleton instance.
     *
     * @return  self
     */
    final public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Formats an email address value.
     *
     * @param   string  $value  The email address.
     * @return  string
     */
    public function formatEmailAddress($value)
    {
        return strtolower(trim($value));
    }

    /**
     * Determines if an email address value is valid.
     *
     * @param   string  $value  The email address.
     * @return  bool
     */
    public function isEmailAddressValid($value)
    {
        return false === filter_var($value, FILTER_VALIDATE_EMAIL) ? false : true;
    }

    /**
     * Determines if the string value is formatted as hexidecimal.
     *
     * If min and max are used together, the value must be within that range.
     * For instance, with a min of 2 and a max of four, ab, abb, and abbb would return true.
     * For a specific length, send the same value for min and max, e.g. set 24 as both
     * the min and the max for a 24 character-long hex string.
     *
     * @param   string      $value  The hex string value.
     * @param   int|null    $min    The minimum required length of the hex string.
     * @param   int|null    $max    The maximum required length of the hex string.
     * @return  bool
     * @throws  \OutOfRangeException If the minimum is less than the max when a max is specified.
     */
    public function isHexValue($value, $min = null, $max = null)
    {
        $max = (integer) $max;
        $min = (integer) $min;
        if ($min > $max && $max !== 0) {
            throw new \OutOfRangeException('The minimum length cannot be greater than the maximum.');
        }
        $length  = sprintf('{%s,%s}', $min > 0 ? $min : 1, $max > 0 ? $max : '');
        $pattern = sprintf('/^[a-f0-9]%s$/i', $length);
        return 1 === preg_match($pattern, $value);
    }

    /**
     * Disable cloning.
     */
    private function __clone()
    {
    }

    /**
     * Disable outside instantiation.
     */
    private function __construct()
    {
    }

    /**
     * Disable deserialization.
     */
    private function __wakeup()
    {
    }
}

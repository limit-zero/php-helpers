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
     * @param   string  $value
     * @return  string
     */
    public function formatEmailAddress($value)
    {
        return strtolower(trim($value));
    }

    /**
     * Determines if an email address value is valid.
     *
     * @param   string  $value
     * @return  bool
     */
    public function isEmailAddressValid($value)
    {
        return false === filter_var($value, FILTER_VALIDATE_EMAIL) ? false : true;
    }

    /**
     * Determines if the string value is formatted as a MongoId.
     *
     * @param   string  $value
     * @return  bool
     */
    public function isMongoIdFormat($value)
    {
        return 1 === preg_match('/^[a-f0-9]{24}$/i', $value);
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

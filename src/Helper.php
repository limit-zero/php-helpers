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

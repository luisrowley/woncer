<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * This class provides with the default values and Nonce creation support.
 * It follows the Factory design pattern to propose the simplest possible scenario.
 *
 * @link https://refactoring.guru/design-patterns/factory-method/php/example
 */
class WPNonceFactory
{
    /**
     * Default action.
     *
     * @var int DEFAULT_NONCE_ACTION
     */
    const DEFAULT_NONCE_ACTION = '-1';

    /**
     * Default nonce name.
     *
     * @var string DEFAULT_NONCE_NAME
     */
    const DEFAULT_NONCE_NAME = '_wpnonce';

    /**
     * Creates and returns a default WPNonce instance
     *
     * @return WPNonce
     */
    public static function initDefaultCreator(
        string $action = self::DEFAULT_NONCE_ACTION,
        string $name = self::DEFAULT_NONCE_NAME
    ): WPNonceCreator {

        return new WPNonceCreator($action, $name);
    }

    /**
     * Creates and returns a default WPNonceChecker instance
     *
     * @return WPNonceChecker
     */
    public static function createDefaultChecker(
        string $action = self::DEFAULT_NONCE_ACTION,
        string $name = self::DEFAULT_NONCE_NAME
    ): WPNonceChecker {

        return new WPNonceChecker($action, $name);
    }
}

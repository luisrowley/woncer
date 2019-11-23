<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * This class provides with the default values and Nonce creation support.
 * It follows the Factory design pattern to propose the simplest possible scenario.
 * 
 * @see https://refactoring.guru/design-patterns/factory-method/php/example
 */
class WPNonceFactory
{
    /**
     * Default action.
     *
     * @var int DEFAULT_NONCE_ACTION
     */
    const DEFAULT_NONCE_ACTION = -1;

    /**
     * Default nonce name.
     *
     * @var string DEFAULT_NONCE_NAME
     */
    const DEFAULT_NONCE_NAME = '_wpnonce';

    /**
     * Creates and returns a new
     *
     * @return WpNonce
     */
    public static function createDefault(): WPNonce
    {
        $action = self::DEFAULT_WP_NONCE_ACTION;
        $name = self::DEFAULT_WP_NONCE_NAME;

        return new WPNonce($action, $name);
    }
}

<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * @see
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
    public static function createDefaultNonce(): WPNonce
    {
        $action = self::DEFAULT_WP_NONCE_ACTION;
        $name = self::DEFAULT_WP_NONCE_NAME;

        return new WPNonce($action, $name);
    }
}

<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Interfaces\WPNonceInterface as WPNonceInterface;

/**
 * Absctract class to provide with the basic Nonce Object structure.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 *
 * @since v0.0.2
 */
abstract class WPNonceAbstract implements WPNonceInterface
{
    /**
     * Default action.
     *
     * @var int DEFAULT_NONCE_ACTION
     */
    const DEFAULT_NONCE_ACTION = '-1';

    /**
     * The current WordPress `default nonce name`.
     *
     * @var string DEFAULT_NONCE_NAME
     */
    const DEFAULT_NONCE_NAME = '_wpnonce';

    /**
     * The default lifetime for WordPress Nonces.
     *
     * @var int DEFAULT_LIFETIME
     */
    const DEFAULT_LIFETIME = 24 * 60 * 60;

    /**
     * Value to represent the context for a nonce.
     *
     * @var string|int $action
     */
    private $action;

    /**
     * The name value for the nonce.
     *
     * @var string $name
     */
    private $name;

    /**
     * The lifetime for the nonce in seconds.
     *
     * @var int $time
     */
    private $time;

    /**
     * One-time cryptographic hash to verify any user, user session and action.
     *
     * @var string $token
     */
    private $token;

    /**
     * Class constructor.
     * Initializes the action, name and token properties.
     * A custom lifetime can be set for the nonce. Default is 24 hours.
     *
     * @param string $action
     * @param string $name
     */
    public function __construct(string $action, string $name)
    {
        if (trim($action) === "") {
            $action = self::DEFAULT_NONCE_ACTION;
        }

        if (trim($name) === "") {
            $name = self::DEFAULT_NONCE_NAME;
        }

        $this->action = $action;
        $this->name = $name;
    }

    /**
     * Setter method for the `$token` private property.
     *
     * @param string $token | the nonce context.
     */
    public function changeNonceToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * Getter method for the `$action` private property.
     *
     * @return string $this->action | the nonce action.
     */
    public function action(): string
    {
        return $this->action;
    }

    /**
     * Getter method for the `$name` private property.
     *
     * @return string $this->name | the nonce name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Getter method for the `$token` private property.
     *
     * @return string $this->token | the nonce token.
     */
    public function token(): string
    {
        return $this->token;
    }
}

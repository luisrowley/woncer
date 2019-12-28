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
     * @var string NONCE_FIELD_FUNCTION_NAME
     */
    const DEFAULT_NONCE_NAME = '_wpnonce';

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
     * One-time cryptographic hash to verify any user, user session and action.
     *
     * @var string $token
     */
    private $token;

    /**
     * Class constructor.
     * Initializes the action, name and token properties.
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

        $this->setAction($action);
        $this->setName($name);
        $this->setNonceToken($this->action);
    }

    /**
     * Setter method for the `$action` private property.
     *
     * @param string $action | the nonce action.
     */
    private function setAction(string $_action)
    {
        $this->action = $_action;
    }

    /**
     * Setter method for the `$name` private property.
     *
     * @param string $name | the nonce name.
     */
    private function setName(string $_name)
    {
        $this->name = $_name;
    }

    /**
     * Setter method for the `$token` private property.
     *
     * @param string $action | the nonce context.
     */
    private function setNonceToken(string $_token)
    {
        $this->token = $_token;
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

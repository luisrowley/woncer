<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Interfaces;

interface WPNonceInterface
{
    /**
     * Setter method for the `$token` private property.
     *
     * @param string $token | the nonce token value.
     */
    public function changeNonceToken(string $token);

    /**
     * Getter method for the `$action` private property.
     *
     * @return string $this->action | the nonce action.
     */
    public function action(): string;

    /**
     * Getter method for the `$name` private property.
     *
     * @return string $this->name | the nonce name.
     */
    public function name(): string;

    /**
     * Getter method for the `$token` private property.
     *
     * @return string $this->token | the nonce token.
     */
    public function token(): string;
}

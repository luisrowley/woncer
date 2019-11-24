<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Interfaces;

interface WPNonceInterface
{
    /**
     * Creates a new token tied to a specific action, user, user session, and window of time
     *
     * @see https://developer.wordpress.org/reference/functions/wp_create_nonce/
     *
     * @param string $action | the nonce context.
     */
    public function createNonceToken(string $action): string;

    /**
     * Retrieve URL with nonce added to URL query.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_url/
     *
     * @param string $actionUrl | the URL to add nonce action.
     * @param string $action    | the nonce action name.
     * @param string $name      | nonce name.
     */
    public function addNonceUrl(
        string $actionUrl,
        string $action = null,
        string $name = null
    ): string;

    /**
     * Retrieves or displays the nonce hidden form field.
     *
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_field
     *
     * @param string $action  | the nonce action name.
     * @param string $name    | nonce name.
     * @param bool $referer   | whether to create the referer hidden form field.
     * @param bool $echo      | whether to display the hidden form field.
     */
    public function addNonceToForm(
        string $action = null,
        string $name = null,
        bool $referer = true,
        bool $echo = true
    ): string;
}

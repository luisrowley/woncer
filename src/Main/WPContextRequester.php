<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * General-purpose Nonce verification class.
 * It implements different verifier methods depending on Nonce context.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
final class WPContextRequester
{
    /**
     * The HTTP request data based on method.
     *
     * @var int $time
     */
    private $httpRequest;

        /**
     * Class constructor covering basic parameters.
     * Initializes the action, name and token properties.
     *
     * @param string $action
     * @param string $name
     */
    public function __construct()
    {
    }
}

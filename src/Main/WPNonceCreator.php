<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Main\WPNonceAbstract as WPNonceAbstract;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It is context-independent, meaning that the action is optional.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonceCreator extends WPNonceAbstract
{
    /**
     * The current WordPress `create nonce function name`.
     *
     * @var string CREATE_NONCE_FUNCTION_NAME
     */
    const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';
    
    /**
     * Class constructor.
     * Initializes the action, name and token properties.
     *
     * @param string $action
     * @param string $name
     */
    public function __construct(string $action, string $name)
    {
        parent::__construct($action, $name);
    }

    /**
     * Creates a new token tied to a specific action, user, user session, and window of time
     *
     * @see https://developer.wordpress.org/reference/functions/wp_create_nonce/
     *
     * @param string $action | the nonce context.
     *
     * @return string $result | the cryptographic token hash
     */
    public function createNonceToken(string $action = null): string
    {
        $result = "";
        $nonceAction = (!$action) ? $this->action : $action;

        if (function_exists(self::CREATE_NONCE_FUNCTION_NAME)) {
            $result = (string)wp_create_nonce($nonceAction);
            $this->setNonceToken($result);
        }

        return $result;
    }
}

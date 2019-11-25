<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Interfaces\WPNonceInterface as WPNonceInterface;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It implements original WordPress funtions as per the doc files.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonce implements WPNonceInterface
{
    /**
     * The current WordPress `create nonce function name`.
     *
     * @var string CREATE_NONCE_FUNCTION_NAME
     */
    const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    /**
     * The current WordPress `nonce URL function name`.
     *
     * @var string NONCE_URL_FUNCTION_NAME
     */
    const NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    /**
     * The current WordPress `nonce field function name`.
     *
     * @var string NONCE_FIELD_FUNCTION_NAME
     */
    const NONCE_FIELD_FUNCTION_NAME = 'wp_nonce_field';

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
    public $action;

    /**
     * The name value for the nonce.
     *
     * @var string $name
     */
    public $name;

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
    private function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * Setter method for the `$name` private property.
     *
     * @param string $name | the nonce name.
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Setter method for the `$token` private property.
     *
     * @param string $action | the nonce context.
     */
    private function setNonceToken(string $action)
    {
        $this->token = $this->createNonceToken($action);
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
    public function createNonceToken(string $action): string
    {
        $result = "";

        if (function_exists(self::CREATE_NONCE_FUNCTION_NAME)) {
            $result = (string)wp_create_nonce($action);
        }

        return $result;
    }

    /**
     * Retrieve URL with nonce added to URL query.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_url/
     *
     * @param string $actionUrl | the URL to add nonce action.
     * @param string $action    | the nonce action name.
     * @param string $name      | nonce name.
     *
     * @var string $nonceAction | takes the local action value in case $action is not set.
     * @var string $nonceName   | takes the local name value in case $name is not set.
     *
     * @return string $nonceUrl | the cryptographic token hash
     */
    public function addNonceUrl(
        string $actionUrl,
        string $action = null,
        string $name = null
    ): string {

        $nonceUrl = "";
        $nonceAction = (!$action) ? $this->action : $action;
        $nonceName = (!$name) ? $this->name : $name;

        if (function_exists(self::NONCE_URL_FUNCTION_NAME)) {
            $nonceUrl = wp_nonce_url($actionUrl, $nonceAction, $nonceName);
        }

        return $nonceUrl;
    }

    /**
     * Retrieves or displays the nonce hidden form field.
     *
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_field
     *
     * @param string $action  | the nonce action name.
     * @param string $name    | nonce name.
     * @param bool $referer   | whether to create the referer hidden form field.
     * @param bool $echo      | whether to display the hidden form field.
     *
     * @var string $nonceAction | takes the local action value in case $action is not set.
     * @var string $nonceName   | takes the local name value in case $name is not set.
     *
     * @return string $nonceField | the nonce hidden form field
     */
    public function addNonceToForm(
        string $action = null,
        string $name = null,
        bool $referer = true,
        bool $echo = true
    ): string {

        $nonceField = "";
        $nonceAction = (!$action) ? $this->action : $action;
        $nonceName = (!$name) ? $this->name : $name;

        if (function_exists(self::NONCE_FIELD_FUNCTION_NAME)) {
            $nonceField = wp_nonce_field($nonceAction, $nonceName, $referer, $echo);
        }

        return $nonceField;
    }
}

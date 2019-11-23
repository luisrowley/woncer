<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Classes;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It implements original WordPress funtions as per the doc files.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonce
{
    /**
     * The current WordPress create nonce function name.
     *
     * @var string CREATE_NONCE_FUNCTION_NAME
     */
    const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    /**
     * The current WordPress nonce URL function name.
     *
     * @var string NONCE_URL_FUNCTION_NAME
     */
    const NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    /**
     * The current WordPress nonce URL function name.
     *
     * @var string NONCE_FIELD_FUNCTION_NAME
     */
    const NONCE_FIELD_FUNCTION_NAME = 'wp_nonce_field';

    const DEFAULT_NONCE_NAME = '_wpnonce';

    private $action;

    private $name;

    private $token;

    public function __construct(string $action, string $name)
    {
        if (trim($name) === "") {
            $name = DEFAULT_NONCE_NAME;
        }

        if (isset($action) && trim($action) !== "") {
            $this->setAction($action);
            $this->setName($name);
            $this->setNonceToken($this->action);
        }
    }

    private function setAction(string $action)
    {
        $this->action = $action;
    }

    private function setElementId(string $id)
    {
        $this->element_id = $id;
    }

    private function setName(string $name)
    {
        $this->name = $name;
    }

    private function setNonceToken(string $action)
    {
        $this->token = createNonceToken($action);
    }

    private function createNonceToken(string $action): string
    {
        $result = "";

        if (function_exists(self::CREATE_NONCE_FUNCTION_NAME)) {
            $result = wp_create_nonce($action);
        }

        return $result;
    }

    private function addNonceUrl(
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

    private function addNonceToForm(
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

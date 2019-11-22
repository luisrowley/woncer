<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Classes;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It implements original WordPress funtions as per the doc files.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 *
 */
class WPNonce
{

    const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    const NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    const NONCE_FIELD_FUNCTION_NAME = 'wp_nonce_field';

    private $action;

    private $elementId;

    private $name;

    private $url;

    private $token;

    public function __construct(string $action, string $elementId, string $name)
    {
        if (!empty($action) && !empty($elementId)) {
            $this->setAction($action);
            $this->setElementId($elementId);
            $this->setName($name);
            $this->setNonceToken($this->action.$this->elementId);
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

    private function setNonceToken(string $actionFull)
    {
        $this->token = createNonceToken($actionFull);
    }

    private function createNonceToken(string $actionFull): string
    {
        $result = "";

        if (function_exists(self::CREATE_NONCE_FUNCTION_NAME)) {
            $result = wp_create_nonce($actionFull);
        }

        return $result;
    }

    private function addNonceToUrl(string $baseUrl, string $actionFull, string $name=""): string
    {
        $nonceUrl = "";

        if (function_exists(self::NONCE_URL_FUNCTION_NAME)) {
            $nonceUrl = wp_nonce_url($baseUrl, $actionFull);
        }

        return $nonceUrl;
    }
}

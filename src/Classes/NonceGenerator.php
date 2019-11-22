<?php

declare(strict_types=1);

namespace Luisdeb\Woncer\Classes;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It implements original WordPress funtions as per the doc files.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 *
 */
class NonceGenerator
{

    const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    const NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    private $baseUrl;

    private $action;

    private $elementId;

    private $name;

    private $token;

    public function __construct(string $action, string $elementId, string $name)
    {
        if (!empty($action) && !empty($elementId)) {
            $this->setAction($action);
            $this->setElementId($elementId);
            $this->setName($name);
            $this->CreateNonceToken($this->action.$this->elementId);
        }
    }


    private function setAction($action) {
        $this->action = $action;
    }

    private function setElementId($id) {
        $this->element_id = $id;
    }

    private function setName($name) {
        $this->name = $name;
    }

    private function CreateNonceToken(string $actionFull) {
        if (function_exists(self::CREATE_NONCE_FUNCTION_NAME)) {
            $this->token = wp_create_nonce($actionFull);
        }
    }

}


?>
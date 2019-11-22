<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use luisdeb\Woncer\Classes\WPNonce;

/**
 * This class handles the logic to generate new WordPress Nonces.
 * It implements original WordPress funtions as per the doc files.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 *
 */
class WPNonceTest extends TestCase{

    private const CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    private const NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    private $base_url;

    private $action;

    private $actionFull;

    private $element_id;

    private $name;

    private $token;

    public function __construct($action, $element_id, $name) {

        $this->setAction($action);
        $this->setElementId($element_id);
        $this->setName($name);

        if( !empty($this->action) && !empty($this->element_id) )
        {
            $this->actionFull = $this->action.$this->element_id ;

            $this->token = call_user_func(
                            self::CREATE_NONCE_FUNCTION_NAME,
                            $this->actionFull
                           );
        }

    }


    private function setAction($action) {
        $this->action = $action;
    }

    private function setElementId($id) {
        $this->element_id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

}


?>
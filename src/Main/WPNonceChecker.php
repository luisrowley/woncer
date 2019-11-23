<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * This class handles the logic for Nonce verification.
 * It implements different methods depending on Nonce context.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonceChecker
{
    /**
     * The current WordPress `check admin referer function name`.
     *
     * @var string CHECK_ADMIN_REFERER_FUNCTION_NAME
     */
    const CHECK_ADMIN_REFERER_FUNCTION_NAME = 'check_admin_referer';

    /**
     * The current WordPress `check ajax referer function name`.
     *
     * @var string CHECK_AJAX_REFERER_FUNCTION_NAME
     */
    const CHECK_AJAX_REFERER_FUNCTION_NAME = 'check_ajax_referer';

    /**
     * The current WordPress `verify nonce function name`.
     *
     * @var string VERIFY_NONCE_FUNCTION_NAME
     */
    const VERIFY_NONCE_FUNCTION_NAME = 'wp_verify_nonce';

    /**
     * Value to represent the context for the nonce.
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
     * Class constructor.
     * Initializes the action, name and token properties.
     *
     * @param string $action
     * @param string $name
     */
    public function __construct(string $action, string $name)
    {
        if (trim($name) === "") {
            super::DEFAULT_NONCE_NAME;
        }

        if (isset($action) && trim($action) !== "") {
            $this->setAction($action);
            $this->setName($name);
        }
    }
}

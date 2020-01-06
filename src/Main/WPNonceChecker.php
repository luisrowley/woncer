<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Main\WPNonceAbstract as WPNonceAbstract;

/**
 * General-purpose Nonce verification class.
 * It implements different verifier methods depending on Nonce context.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonceChecker extends WPNonceAbstract
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
     * Class constructor covering basic parameters.
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
     * Verifies the nonce passed in some other context
     *
     * @see https://codex.wordpress.org/Function_Reference/wp_verify_nonce
     *
     * @param WPContextRequester $httpContext | the HTTP request.
     *
     * @var WPContextRequester $httpContext | object instance containing the request data.
     * @var string $nonce | stores the nonce name from request.
     * @var string $nonceAction | stores the nonce action from request.
     *
     * @return int $result | value `0` if nonce is invalid.
     *                     | value `1` if nonce was generated in the past 12 hours or less.
     *                     | value `2` if nonce was generated between 12 and 24 hours ago.
     *
     * wp_verify_nonce returns a boolean `false`. In this function we return an int `0` as `false`,
     * as multiple return types are not supported yet, and will not be until PHP 8.0 is released.
     *
     * @see https://wiki.php.net/rfc/union_types_v2
     *
     */
    public function verifyNonce(WPContextRequester $httpContext = null): int 
    {
        $result = 0;
        $httpContext = (!$httpContext) ? new WPContextRequester() : $httpContext;
        $nonce = $httpContext->offsetExists($this->name()) ? $httpContext[$this->name()] : '';
        $nonceAction = $httpContext->offsetExists($this->action()) ? $httpContext[$this->action()] : '';

        if (!is_string($nonce) || !is_string($nonceAction)) {
            return 0;
        }

        if (function_exists(self::VERIFY_NONCE_FUNCTION_NAME)) {
            $result = wp_verify_nonce($nonce, $nonceAction);
        }

        return (!$result) ? 0 : $result;
    }

    /**
     * Tests if the nonce is valid or if the request was referred from an admin.
     *
     * @see https://codex.wordpress.org/Function_Reference/check_admin_referer
     *
     * @param string $action    | the context for the referal.
     * @param string $queryArg  | Where to look for nonce in $_REQUEST global variable.
     *
     * @var string $nonceAction | takes the local action value in case $action is not set.
     *
     * @return bool $result | Whether the nonce is valid or not
     */
    public function checkAdminReferer(
        string $action = null,
        string $queryArg = '_wpnonce'
    ): bool {

        $result = false;
        $nonceAction = (!$action) ? $this->action() : $action;

        if (function_exists(self::CHECK_ADMIN_REFERER_FUNCTION_NAME)) {
            $result = check_admin_referer($nonceAction, $queryArg);
        }

        return $result;
    }

    /**
     * Verifies the AJAX request to prevent any requests from third-party sites
     *
     * @see https://codex.wordpress.org/Function_Reference/check_ajax_referer
     *
     * @param string $action    | the context for the referal.
     * @param string $queryArg  | Where to look for nonce in $_REQUEST global variable.
     * @param bool $die         | Whether to die if the nonce is invalid.
     *
     * @var string $nonceAction | takes the local action value in case $action is not set.
     *
     * @return bool $result | `true` if check passes or `false` if check fails
     */
    public function checkAjaxReferer(
        string $action = null,
        string $queryArg = null,
        bool $die = true
    ): bool {

        $result = false;
        $nonceAction = (!$action) ? $this->action() : $action;

        if (function_exists(self::CHECK_AJAX_REFERER_FUNCTION_NAME)) {
            $result = check_ajax_referer($nonceAction, $queryArg, $die);
        }

        return $result;
    }
}

<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Main\WPNonceCreator as WPNonceCreator;

/**
 * Handles Nonce creation as a URL query parameter.
 * It implements the original wp_nonce_url function logic.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_nonce_url/
 *
 * @since v0.0.2
 */
class WPNonceURLCreator extends WPNonceCreator
{
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
     * Generates new URL with nonce added to input URL query
     * or an empty string if the input URL query is invalid.
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
        $nonceAction = (!$action) ? $this->action() : $action;
        $nonceName = (!$name) ? $this->name() : $name;

        if (filter_var($actionUrl, FILTER_VALIDATE_URL)) {
            $actionUrl = str_replace('&amp;', '&', $actionUrl);
            $nonceToken = $this->createNonceToken($nonceAction);
            $nonceUrl = esc_html(add_query_arg($nonceName, $nonceToken, $actionUrl));
        }

        return $nonceUrl;
    }
}

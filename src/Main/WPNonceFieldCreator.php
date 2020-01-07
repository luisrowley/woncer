<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

use luisdeb\Woncer\Main\WPNonceCreator as WPNonceCreator;

/**
 * This class adds a hidden nonce field to be sent alongside a form.
 * It follows the original WordPress function implementation.
 *
 * @see https://codex.wordpress.org/Wordpress_Nonce_Implementation
 */
class WPNonceFieldCreator extends WPNonceCreator
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

        $nonceAction = (!$action) ? $this->action() : $action;
        $nonceName = (!$name) ? $this->name() : $name;
        $nonceToken = $this->createNonceToken($nonceAction);

        $nonceField = sprintf(
            '<input type="hidden" id="%1$s" name="%1$s" value="%2$s" />',
            esc_attr($nonceName),
            esc_attr($nonceToken)
        );

        if ($referer) {
            $nonceField .= wp_referer_field(false);
        }
     
        if ($echo) {
            echo esc_js($nonceField);
        }

        return $nonceField;
    }
}

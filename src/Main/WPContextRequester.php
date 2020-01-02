<?php

declare(strict_types=1);

namespace luisdeb\Woncer\Main;

/**
 * Helper class to provide with HTTP context for a Nonce request.
 *
 * @since v0.0.2
 */
final class WPContextRequester implements ArrayAccess
{
    /**
     * The HTTP request data based on method.
     *
     * @var int $httpRequest
     */
    private $httpRequest = [];

    /**
     * Class constructor covering basic parameters.
     * Initializes the action, name and token properties.
     *
     */
    public function __construct()
    {
        $inputMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
        $httpMethod = !isset($inputMethod) ? null : $inputMethod;
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetExists($offset)
    {
        return isset($this->httpRequest[$offset]);
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetGet($offset)
    {
        return isset($this->httpRequest[$offset]) ? $this->httpRequest[$offset] : null;
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetSet($offset, $value)
    {
        $this->httpRequest[$offset] = $value;  
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetUnset($offset)
    {
        unset($this->httpRequest[$offset]);
    }
}

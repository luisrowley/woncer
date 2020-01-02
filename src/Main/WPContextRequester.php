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
    public function __construct(array $httpRequest)
    {
        $inputMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
        $httpMethod = !isset($inputMethod) ? null : $inputMethod;
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetExists($offset): bool
    {
        return isset($this->httpRequest[$offset]);
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     * 
     * Offset getter method
     */
    public function offsetGet($offset)
    {
        return isset($this->httpRequest[$offset]) ? $this->httpRequest[$offset] : null;
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     * 
     * Offset setter method is disabled for security reasons
     */
    public function offsetSet($offset, $value)
    {
        throw new Exception("Request parameters are immutable"); 
    }

    /**
     * {@inheritDoc} From ArrayAccess implementation 
     */
    public function offsetUnset($offset)
    {
        throw new Exception("Request parameters are immutable"); 
    }
}

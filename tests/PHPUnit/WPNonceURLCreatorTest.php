<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceURLCreator;

/**
 * This class Implements the Unit Test methodology for the WPNonce class.
 *
 * PHPUnit version 8.0 *
 * @see https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceTest extends TestCase
{
    /**
     * Unit tests for WPNonce::addNonceUrl() method.
     *
     * covers @method WPNonceURLCreator::__construct
     * covers @method WPNonceURLCreator::setAction
     * covers @method WPNonceURLCreator::setName
     * covers @method WPNonceURLCreator::createNonceToken
     * covers @method WPNonceURLCreator::setNonceToken
     * covers @method WPNonceURLCreator::addNonceUrl
     *
     * @return void
     */
    public function testUrl()
    {
        $nonceName = "_wpnonce";
        $nonceAction = "-1";
        $tokenParam = "nonce";
        $actionUrl = 'http://www.somewpdomain.com';

        $wpNonceURLCreator = new WPNonceURLCreator($nonceAction, $nonceName);

        MonkeyFunctions\expect(WPNonceURLCreator::CREATE_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn($tokenParam);

        MonkeyFunctions\expect('esc_html')
            ->once()
            ->andReturn($actionUrl.'?'.$nonceName.'='.$tokenParam);

        MonkeyFunctions\expect('add_query_arg')
            ->once()
            ->andReturn($actionUrl.'?'.$nonceName.'='.$tokenParam);

        MonkeyFunctions\expect('addNonceUrl')
            ->once()
            ->andReturn($actionUrl . '?_wpnonce=nonce');

        $result = $wpNonceURLCreator->addNonceUrl($actionUrl);
        $this->assertStringStartsWith('http', $result);
        $this->assertSame($actionUrl . '?_wpnonce=nonce', $result);
    }
}

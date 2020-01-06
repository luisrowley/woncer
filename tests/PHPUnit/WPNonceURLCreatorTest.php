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
        $actionUrl = 'http://www.somewpdomain.com';

        $wpNonceURLCreator = new WPNonceURLCreator($nonceAction, $nonceName);

        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->once();
        $wpNonce = $wpNonceFactory->createDefault();
        $result = $wpNonce->addNonceUrl($actionUrl);
        $this->assertEmpty($result);
        MonkeyFunctions\expect(WPNonce::NONCE_URL_FUNCTION_NAME)
            ->once()
            ->andReturn($actionUrl . '?escaped=with-nonce-action');
        $result = $wpNonce->addNonceUrl($actionUrl);
        $this->assertStringStartsWith('http', $result);
    }
}

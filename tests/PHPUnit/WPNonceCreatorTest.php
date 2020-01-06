<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceCreator;

use luisdeb\Woncer\Main\WPNonceFactory;

use luisdeb\Woncer\Main\WPContextRequester;

/**
 * This class Implements the Unit Test methodology for the WPNonce class.
 *
 * PHPUnit version 8.0 *
 * @see https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceCreatorTest extends TestCase
{
    /**
     * Unit tests for WPNonce::addNonceUrl() method.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonceCreator::__construct
     * covers @method WPNonceCreator::setAction
     * covers @method WPNonceCreator::setName
     * covers @method WPNonceCreator::setNonceToken
     * covers @method WPNonceCreator::createFromRequest
     *
     * @return void
     */
    public function testCreateFromRequest()
    {
        $wpNonceFactory = new WPNonceFactory();
        $mockRequest = $this->getMockBuilder(WPContextRequester::class)
             ->disableOriginalConstructor()
             ->getMock();

        $mockRequest->httpRequest = array("_wpnonce" => "bar", "action" => "foo");
        $mockRequest->httpMethod = 'POST';

        $wpNonceCreator = $wpNonceFactory->createDefaultChecker();

        MonkeyFunctions\expect(WPNonceCreator::CREATE_NONCE_FUNCTION_NAME)
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

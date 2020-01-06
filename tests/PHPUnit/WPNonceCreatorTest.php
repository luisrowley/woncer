<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceCreator;

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
     * covers @method WPNonceCreator::createFromRequest
     * covers @method WPNonceCreator::createNonceToken
     * covers @method WPNonceCreator::setNonceToken
     *
     * @return void
     */
    public function testCreateFromRequest()
    {
        $tokenParam = "my_token";

        $mockRequest = $this->getMockBuilder(WPContextRequester::class)
             ->disableOriginalConstructor()
             ->getMock();

        $mockRequest->httpRequest = array("_wpnonce" => "bar", "action" => "foo");
        $mockRequest->httpMethod = 'POST';

        $wpNonceCreator = new WPNonceCreator('-1', '_wpnonce');

        MonkeyFunctions\expect(WPNonceCreator::CREATE_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn($tokenParam);
        
        $result = $wpNonceCreator->createFromRequest($mockRequest);
        $this->assertNotEmpty($result);
        $this->assertSame($tokenParam, $wpNonceCreator->token());
    }
}

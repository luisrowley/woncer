<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceChecker;

use luisdeb\Woncer\Main\WPNonceFactory;

use luisdeb\Woncer\Main\WPContextRequester;

/**
 * This class implements the Unit Test methodology for WPNonceChecker class.
 *
 * PHPUnit version 8.0 *
 * @link https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceCheckerTest extends TestCase
{
    /**
     * Tests checkAdminReferer with all possible function outputs.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::checkAdminReferer
     *
     * @return void
     */
    public function testCheckAdminReferer()
    {
        $wpNonceFactory = new WPNonceFactory();
        
        $wpNonceChecker = $wpNonceFactory->createDefaultChecker();
        $result = $wpNonceChecker->checkAdminReferer();
        $this->assertEmpty($result);
        
        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $wpNonceChecker->checkAdminReferer();
        $this->assertIsBool($result);
        $this->assertEquals($result, false);
        
        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(true);

        $result = $wpNonceChecker->checkAdminReferer();
        $this->assertIsBool($result);
        $this->assertEquals($result, true);
    }

    /**
     * Tests checkAjaxReferer with all possible function outputs.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::setNonceToken
     * covers @method WPNonceChecker::createNonceToken
     * covers @method WPNonceChecker::checkAjaxReferer
     *
     * @return void
     */
    public function testCheckAjaxReferer()
    {
        $wpNonceFactory = new WPNonceFactory();
        
        $wpNonceChecker = $wpNonceFactory->createDefaultChecker();
        $result = $wpNonceChecker->checkAjaxReferer();
        $this->assertEmpty($result);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $wpNonceChecker->checkAjaxReferer();
        $this->assertIsBool($result);
        $this->assertEquals($result, false);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(true);

        $result = $wpNonceChecker->checkAjaxReferer();
        $this->assertIsBool($result);
        $this->assertEquals($result, true);
    }

    /**
     * Tests verifyNonce with all possible function outputs.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::setNonceToken
     * covers @method WPNonceChecker::createNonceToken
     * covers @method WPNonceChecker::verifyNonce
     *
     * @return void
     */
    public function testVerifyNonce()
    {
        $wpNonceFactory = new WPNonceFactory();
        $mockRequest = $this->getMockBuilder(WPContextRequester::class)
             ->disableOriginalConstructor()
             ->getMock();

        $mockRequest->httpRequest = array("_wpnonce" => "bar", "action" => "foo");
        $mockRequest->httpMethod = 'POST';

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker();
        
        $result = $wpNonceChecker->verifyNonce($mockRequest);
        $this->assertEmpty($result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $wpNonceChecker->verifyNonce($mockRequest);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(0);

        $result = $wpNonceChecker->verifyNonce($mockRequest);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
        
        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(1);

        $result = $wpNonceChecker->verifyNonce($mockRequest);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(2);

        $result = $wpNonceChecker->verifyNonce($mockRequest);
        $this->assertIsInt($result);
        $this->assertEquals(2, $result);
    }
}

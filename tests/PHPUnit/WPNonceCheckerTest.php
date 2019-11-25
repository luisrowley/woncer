<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceChecker;

use luisdeb\Woncer\Main\WPNonceFactory;

/**
 * This class Implements the Unit Test methodology for detecting bugs.
 *
 * PHPUnit version 8.0 * 
 * @link https://phpunit.de/getting-started/phpunit-8.html
 * 
 */
class WPNonceCheckerTest extends TestCase
{
    public function testCheckAdminReferer() {

        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect(WPNonceChecker::CREATE_NONCE_FUNCTION_NAME)
            ->once();
        
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();
        $result = $WPNonceChecker->checkAdminReferer();
        $this->assertEmpty($result);
        
        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $WPNonceChecker->checkAdminReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 0);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(0);

        $result = $WPNonceChecker->checkAdminReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 0);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(1);

        $result = $WPNonceChecker->checkAdminReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 1);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_ADMIN_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(2);

        $result = $WPNonceChecker->checkAdminReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 2);
    }

    public function testCheckAjaxReferer() {

        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once();
        
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();
        $result = $WPNonceChecker->checkAjaxReferer();
        $this->assertEmpty($result);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $WPNonceChecker->checkAjaxReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 0);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(0);

        $result = $WPNonceChecker->checkAjaxReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 0);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(1);

        $result = $WPNonceChecker->checkAjaxReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 1);

        MonkeyFunctions\expect(WPNonceChecker::CHECK_AJAX_REFERER_FUNCTION_NAME)
            ->once()
            ->andReturn(2);

        $result = $WPNonceChecker->checkAjaxReferer();
        $this->assertIsInt($result);
        $this->assertEquals($result, 2);
    }

    public function testVerifyNonce() {

        $sampleToken = "mySampleToken";
        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect(WPNonceChecker::CREATE_NONCE_FUNCTION_NAME)
            ->once();
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();
        $result = $WPNonceChecker->verifyNonce($sampleToken);
        $this->assertEmpty($result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(false);

        $result = $WPNonceChecker->verifyNonce($sampleToken);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(0);

        $result = $WPNonceChecker->verifyNonce($sampleToken);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
        
        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(1);

        $result = $WPNonceChecker->verifyNonce($sampleToken);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);

        MonkeyFunctions\expect(WPNonceChecker::VERIFY_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn(2);

        $result = $WPNonceChecker->verifyNonce($sampleToken);
        $this->assertIsInt($result);
        $this->assertEquals(2, $result);
    }
}


?>
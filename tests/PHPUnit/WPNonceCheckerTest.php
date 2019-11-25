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
    public function testVerifyNonce() {

        $sampleToken = "mySampleToken";
        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')
            ->once();
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();
        $result = $WPNonceChecker->verifyNonce($sampleToken);
    }
}


?>
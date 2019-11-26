<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonce;

use luisdeb\Woncer\Main\WPNonceChecker;

use luisdeb\Woncer\Main\WPNonceFactory;

/**
 * This class Implements the Unit Test methodology for detecting bugs.
 *
 * PHPUnit version 8.0 * 
 * @see https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceFactoryTest extends TestCase
{
    public function testCreateDefault() {

        $defaultAction = '-1';
        $defaultName = '_wpnonce';

        $WPNonceFactory = new WPNonceFactory();
        $WPNonce = $WPNonceFactory->createDefault();

        $this->assertInstanceOf(WPNonce::class, $WPNonce);
        $this->assertClassHasAttribute('action', WPNonce::class);

        $this->assertSame($defaultAction, $WPNonce->getAction());
        $this->assertSame($defaultName, $WPNonce->getName());
    }

    
    public function testCreateDefaultChecker() {
        
        $defaultAction = '-1';
        $defaultName = '_wpnonce';

        $WPNonceFactory = new WPNonceFactory();
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();

        $this->assertInstanceOf(WPNonceChecker::class, $WPNonceChecker);

        $this->assertSame($defaultAction, $WPNonceChecker->getAction());
        $this->assertSame($defaultName, $WPNonceChecker->getName());
    }

    
    public function testCreateDefaultWithParameters() {

        $actionParam = 'my_action';
        $nameParam = 'my_name';
        $tokenParam  = 'my_token_1234';
        $wpNonceFactory  = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonce = $wpNonceFactory->createDefault($actionParam, $nameParam);

        $this->assertSame($actionParam, $wpNonce->getAction());
        $this->assertSame($nameParam, $wpNonce->getName());
        $this->assertNotEmpty($wpNonce->getNonceToken());
        $this->assertSame($tokenParam, $wpNonce->getNonceToken());
    }

    
    public function testCreateCheckerWithParameters() {

        $actionParam = 'my_action';
        $nameParam = 'my_name';
        $tokenParam  = 'my_token_1234';
        $wpNonceFactory  = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker($actionParam, $nameParam);

        $this->assertSame($actionParam, $wpNonceChecker->getAction());
        $this->assertSame($nameParam, $wpNonceChecker->getName());
        $this->assertNotEmpty($wpNonceChecker->getNonceToken());
        $this->assertSame($tokenParam, $wpNonceChecker->getNonceToken());
    }
}

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
        $this->assertObjectHasAttribute('action', $WPNonce);

        $this->assertSame($defaultAction, $WPNonce->action);
        $this->assertSame($defaultName, $WPNonce->name);
    }

    
    public function testCreateDefaultChecker() {
        
        $defaultAction = '-1';
        $defaultName = '_wpnonce';

        $WPNonceFactory = new WPNonceFactory();
        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();

        $this->assertInstanceOf(WPNonceChecker::class, $WPNonceChecker);
        $this->assertObjectHasAttribute('action', $WPNonceChecker);

        $this->assertSame($defaultAction, $WPNonceChecker->action);
        $this->assertSame($defaultName, $WPNonceChecker->name);

    }

    
    public function testCreateWithParameters() {
        
    }

    /*
    public function testCreateCheckerWithParameters() {

    }*/
}
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonce;

use luisdeb\Woncer\Main\WPNonceFactory;

/**
 * This class Implements the Unit Test methodology for detecting bugs.
 *
 * PHPUnit version 8.0 * 
 * @see https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceTest extends TestCase
{
    /**
     * Tests WPNonce::addNonceUrl() method.
     *
     * @return void
     */
    public function testUrl() {
        $actionUrl      = 'http://www.somewpdomain.com';
        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')
            ->once();
        $WPNonce = $WPNonceFactory->createDefault();
        $result  = $WPNonce->addNonceUrl($actionUrl);
        $this->assertEmpty($result);
        MonkeyFunctions\expect('wp_nonce_url')
            ->once()
            ->andReturn($actionUrl . '?escaped=with-nonce-action');
        $result = $WPNonce->addNonceUrl($actionUrl);
        $this->assertStringStartsWith('http', $result);
    }

    /**
     * Tests WPNonce::addNonceToForm() method.
     *
     * @return void
     */
    public function testForm() {
        $WPField   = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="nonce" />';
        $WPNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')
            ->once();
        $WPNonce = $WPNonceFactory->createDefault();
        $result  = $WPNonce->addNonceToForm();
        $this->assertEmpty($result);
        MonkeyFunctions\expect('wp_nonce_field')
            ->once()
            ->andReturn($WPField);
        $result = $WPNonce->addNonceToForm();
        $this->assertEquals($WPField, $result);
    }
}


?>
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

    public function testEmpty()
    {
        $this->assertEmpty([]);
    }

    public function testEquals()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

    public function additionProvider()
    {
        return [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1]
        ];
    }

    /**
     * Tests the WpNonce url method.
     *
     * @return void
     */
    public function testUrl() {
        $actionUrl      = 'http://www.somewpdomain.es';
        $wpNonceFactory = new WPNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $nonce = $wpNonceFactory->createDefault();
        $result  = $nonce->url($actionUrl);
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_nonce_url')
            ->once()
            ->andReturn($actionUrl . '?escaped=with-nonce-action');
        $result = $nonce->url($actionUrl);
        $this->assertStringStartsWith('http', $result);
    }

}


?>
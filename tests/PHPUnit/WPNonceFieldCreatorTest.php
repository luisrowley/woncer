<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceFieldCreator;

use luisdeb\Woncer\Main\WPNonceFactory;

/**
 * This class Implements the Unit Test methodology for the WPNonce class.
 *
 * PHPUnit version 8.0 *
 * @see https://phpunit.de/getting-started/phpunit-8.html
 *
 */
class WPNonceFieldCreatorTest extends TestCase
{
    /**
     * Tests WPNonce::addNonceToForm() method.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonce::__construct
     * covers @method WPNonce::setAction
     * covers @method WPNonce::setName
     * covers @method WPNonce::setNonceToken
     * covers @method WPNonce::createNonceToken
     * covers @method WPNonce::addNonceToForm
     *
     * @return void
     */
    public function testForm()
    {        
        $nonceName = "_wpnonce";
        $nonceAction = "-1";
        $tokenParam = "nonce";
        $wpField = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="nonce" />';
        $referer = '<input type="hidden" name="_wp_http_referer" value="http://dev.wordpress.org" />';

        $wpNonceFieldCreator = new WPNonceFieldCreator($nonceAction, $nonceName);

        MonkeyFunctions\expect(WPNonceFieldCreator::CREATE_NONCE_FUNCTION_NAME)
            ->once()
            ->andReturn($tokenParam);

        MonkeyFunctions\expect('esc_attr')
        ->twice()
        ->andReturn($nonceName, $tokenParam);

        MonkeyFunctions\expect('wp_referer_field')
        ->once()
        ->andReturn($referer);

        MonkeyFunctions\expect('addNonceToForm')
            ->once()
            ->andReturn($wpField);

        $result = $wpNonceFieldCreator->addNonceToForm();
        $this->assertEquals($wpField . $referer, $result);
    }
}

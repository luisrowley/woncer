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
    /**
     * Tests createDefault method with no parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonce::__construct
     * covers @method WPNonce::setAction
     * covers @method WPNonce::setName
     * covers @method WPNonce::setNonceToken
     * covers @method WPNonce::createNonceToken
     * 
     * @return void
     */
    public function testCreateDefault() {

        $defaultAction = '-1';
        $defaultName = '_wpnonce';
        $tokenParam = "my_token";

        $WPNonceFactory = new WPNonceFactory();

        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($defaultAction)
            ->andReturn($tokenParam);
        
        $wpNonce = $WPNonceFactory->createDefault();

        $this->assertInstanceOf(WPNonce::class, $wpNonce);
        $this->assertClassHasAttribute('action', WPNonce::class);

        $this->assertSame($defaultAction, $wpNonce->getAction());
        $this->assertSame($defaultName, $wpNonce->getName());
        $this->assertSame($tokenParam, $wpNonce->getNonceToken());
    }

    /**
     * Tests createDefaultChecker method with no parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::setNonceToken
     * covers @method WPNonceChecker::createNonceToken
     * 
     * @return void
     */
    public function testCreateDefaultChecker() {
        
        $defaultAction = '-1';
        $defaultName = '_wpnonce';
        $tokenParam = "my_token";

        $WPNonceFactory = new WPNonceFactory();

        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($defaultAction)
            ->andReturn($tokenParam);

        $WPNonceChecker = $WPNonceFactory->createDefaultChecker();

        $this->assertInstanceOf(WPNonceChecker::class, $WPNonceChecker);

        $this->assertSame($defaultAction, $WPNonceChecker->getAction());
        $this->assertSame($defaultName, $WPNonceChecker->getName());
        $this->assertSame($tokenParam, $WPNonceChecker->getNonceToken());
    }

    /**
     * Tests createDefault method with custom-made parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonce::__construct
     * covers @method WPNonce::setAction
     * covers @method WPNonce::setName
     * covers @method WPNonce::setNonceToken
     * covers @method WPNonce::createNonceToken
     * 
     * @return void
     */
    public function testCreateDefaultWithParameters() {

        $actionParam = 'my_action';
        $nameParam = 'my_name';
        $tokenParam  = 'my_token';
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

    /**
     * Tests createDefaultChecker method with custom-made parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::setNonceToken
     * covers @method WPNonceChecker::createNonceToken
     * 
     * @return void
     */
    public function testCreateCheckerWithParameters() {

        $actionParam = 'my_action';
        $nameParam = 'my_name';
        $tokenParam  = 'my_token';
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

    /**
     * Test to assert that giving string of `space characters` as parameters for createDefault()
     * results in the default class properties for the WPNonce function.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonce::__construct
     * covers @method WPNonce::setAction
     * covers @method WPNonce::setName
     * covers @method WPNonce::setNonceToken
     * covers @method WPNonce::createNonceToken
     * 
     * @return void
     */
    public function testCreateDefaultWithSpaceParameters() {

        $actionParam = '     ';
        $nameParam = '     ';
        $tokenParam  = 'my_token';
        $wpNonceFactory  = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonce = $wpNonceFactory->createDefault($actionParam, $nameParam);

        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_ACTION, $wpNonce->getAction());
        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_NAME, $wpNonce->getName());
    }

    /**
     * Test to assert that giving string of `space characters` as parameters for createDefaultChecker()
     * results in the default class properties for the WPNonce function.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     * covers @method WPNonceChecker::setNonceToken
     * covers @method WPNonceChecker::createNonceToken
     * 
     * @return void
     */
    public function testCreateDefaultCheckerWithSpaceParameters() {

        $actionParam = '     ';
        $nameParam = '     ';
        $tokenParam  = 'my_token';
        $wpNonceFactory  = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonceChecker::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker($actionParam, $nameParam);

        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_ACTION, $wpNonceChecker->getAction());
        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_NAME, $wpNonceChecker->getName());
    }
}

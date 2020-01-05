<?php

declare(strict_types=1);

namespace luisdeb\Woncer\tests;

use PHPUnit\Framework\TestCase;

use Brain\Monkey\Functions as MonkeyFunctions;

use luisdeb\Woncer\Main\WPNonceAbstract;

use luisdeb\Woncer\Main\WPNonceCreator;

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
     * covers @method WPNonceCreator::__construct
     * covers @method WPNonceCreator::setAction
     * covers @method WPNonceCreator::setName
     * covers @method WPNonceCreator::createNonceToken
     *
     * @return void
     */
    public function testCreateDefault()
    {
        $defaultAction = '-1';
        $defaultName = '_wpnonce';
        $tokenParam = "my_token";

        $wpNonceFactory = new WPNonceFactory();

        MonkeyFunctions\expect(WPNonceCreator::CREATE_NONCE_FUNCTION_NAME)
            ->with($defaultAction)
            ->andReturn($tokenParam);
        
        $wpNonce = $wpNonceFactory->createDefault();

        $this->assertInstanceOf(WPNonceCreator::class, $wpNonce);
        $this->assertClassHasAttribute('action', WPNonceAbstract::class);

        $this->assertSame($defaultAction, $wpNonce->action());
        $this->assertSame($defaultName, $wpNonce->name());
        $this->assertSame($tokenParam, $wpNonce->token());
    }

    /**
     * Tests createDefaultChecker method with no parameters.
     * It asserts that the correct object properties are returned.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     *
     * @return void
     */
    public function testCreateDefaultChecker()
    {
        $defaultAction = '-1';
        $defaultName = '_wpnonce';

        $wpNonceFactory = new WPNonceFactory();

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker();

        $this->assertInstanceOf(WPNonceChecker::class, $wpNonceChecker);

        $this->assertSame($defaultAction, $wpNonceChecker->action());
        $this->assertSame($defaultName, $wpNonceChecker->name());
    }

    /**
     * Tests createDefault method with custom-made parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefault
     * covers @method WPNonceCreator::__construct
     * covers @method WPNonceCreator::setAction
     * covers @method WPNonceCreator::setName
     * covers @method WPNonceCreator::createNonceToken
     * covers @method WPNonceCreator::setNonceToken
     *
     * @return void
     */
    public function testCreateDefaultWithParameters()
    {
        $actionParam = 'my_action';
        $nameParam = 'my_name';
        $tokenParam = 'my_token';
        
        $wpNonceFactory = new WpNonceFactory();

        MonkeyFunctions\expect(WPNonceCreator::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonce = $wpNonceFactory->createDefault($actionParam, $nameParam);

        $this->assertSame($actionParam, $wpNonce->action());
        $this->assertSame($nameParam, $wpNonce->name());
        $this->assertNotEmpty($wpNonce->token());
        $this->assertSame($tokenParam, $wpNonce->token());
    }

    /**
     * Tests createDefaultChecker method with custom-made parameters.
     * It asserts that the correct token is returned.
     *
     * covers @method WPNonceFactory::createDefaultChecker
     * covers @method WPNonceChecker::__construct
     * covers @method WPNonceChecker::setAction
     * covers @method WPNonceChecker::setName
     *
     * @return void
     */
    public function testCreateCheckerWithParameters()
    {
        $actionParam = 'my_action';
        $nameParam = 'my_name';

        $wpNonceFactory = new WpNonceFactory();

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker($actionParam, $nameParam);

        $this->assertSame($actionParam, $wpNonceChecker->action());
        $this->assertSame($nameParam, $wpNonceChecker->name());
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
     *//*
    public function testCreateDefaultWithSpaceParameters()
    {
        $actionParam = '     ';
        $nameParam = '     ';
        $tokenParam = 'my_token';
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonce::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonce = $wpNonceFactory->createDefault($actionParam, $nameParam);

        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_ACTION, $wpNonce->action());
        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_NAME, $wpNonce->name());
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
     *//*
    public function testCreateDefaultCheckerWithSpaceParameters()
    {
        $actionParam = '     ';
        $nameParam = '     ';
        $tokenParam = 'my_token';
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect(WPNonceChecker::CREATE_NONCE_FUNCTION_NAME)
            ->with($actionParam)
            ->andReturn($tokenParam);

        $wpNonceChecker = $wpNonceFactory->createDefaultChecker($actionParam, $nameParam);

        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_ACTION, $wpNonceChecker->action());
        $this->assertSame($wpNonceFactory::DEFAULT_NONCE_NAME, $wpNonceChecker->name());
    }*/
}

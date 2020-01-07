# Woncer

**Woncer** is a Composer package that serves as a toolbox for [WordPress Nonces](https://codex.wordpress.org/Wordpress_Nonce_Implementation). It aims to provide a developer-friendly API to help you implement the most common functions for creating and validating tokens in a secure way. All the logic has been restructured to follow an Object-Oriented approach that builds upon the original Wordpress functions.



## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.



### Prerequisites

For this package to properly run, you'll need **PHP 7.0** as a minimum:

```
"php": "^7.0"
```

And **Composer** installed to the [latest version](https://getcomposer.org/download/)



### Installing

Installation should be as smooth as: 

 1. Cloning this repository:

    ```
    git clone https://luis_dbm@bitbucket.org/luis_dbm/woncer.git
    ```

 2. Changing to the project directory:

    ```
    cd woncer
    ```

 3. And installing the composer dependencies by running:

    ```
    composer install
    ```



## How to use

The logic behind this API is divided in two main Classes: **WPNonceCreator** and **WPNonceChecker**.



### WPNonceCreator functions

```
WPNonceCreator ( string $action, string $name )
```

**WPNonceCreator** handles the functions to create a new Nonce token from request data. You can also use this class to initiate a simple Nonce token independent from context.

Any _Object instance_ will require two parameters: 

 1. An action, representing the context in which the nonce is created.
 2. A name for the nonce token.

After being initialized, you can call any of the 'create' methods which derive from the original [wp_create_nonce](https://developer.wordpress.org/reference/functions/wp_create_nonce/) function to provide with the token value.

#### Creating a Nonce from request

```
WPNonceCreator::createFromRequest ( WPContextRequester $httpContext = null )
```

**WPNonceCreator::createFromRequest** function generates a new Nonce token directly from request data. It receives an optional parameter representing the request context data. 

This parameter is an instance of **WPContextRequester** with provides with the tools to more easily access Nonce data.

If this parameter is present, the function will extract the nonce _action_ from the request to generate the token.

As mentioned above, the only optional parameter is:

 1. `$httpContext` the nonce request context.


#### Creating a Nonce from action

```
WPNonceCreator::createNonceToken ( string $action )
```

**WPNonceCreator::createNonceToken** function is called automatically every time you call **createFromRequest**. Nonetheless, you can also call it manually whenever needed in order to generate a new Nonce token hash value to fit any custom context.

Following the [official implementation](https://developer.wordpress.org/reference/functions/wp_create_nonce/), it only takes one required _action_ parameter:

 1. `$action` the nonce field context.


### Other creator functions

#### Adding nonce to URL

```
WPNonceURLCreator::addNonceUrl ( string $actionUrl [, string $action, string $name ] )
```

**WPNonceURLCreator::addNonceUrl** receives an URL as input and returns the same URL with a Nonce token value attached to it. This URL always refer to a specific _action_ and if no _action_ is provided it will resort to the _default action_ value.

Defaults are supported for the optional parameters as per the [official docs](https://codex.wordpress.org/Function_Reference/wp_nonce_url):

 1. `$actionUrl` the base URL to which to append the Nonce value.
 2. `$action` the nonce field context.
 3. `$name` the nonce name. 


#### Adding nonce to Form

```
WPNonceFieldCreator::addNonceToForm ( [ string $action, string $name, bool $referer, bool $echo ] )
```

**WPNonceFieldCreator::addNonceToForm** returns or displays the nonce hidden form field. This form field is attached to a given form to guarantee its legitimacy, proving that the contents of the form request came from the current site and not from somewhere else. It internally calls the Wordpress [wp_nonce_field](https://codex.wordpress.org/Function_Reference/wp_nonce_field) function to get the nonce field.

All parameters are optional: 
 
 1. `$action` the nonce field context.
 2. `$name` the nonce name. 
 3. `$referer` to specify whether the referer hidden form field should also be created. (Default: true)
 4. `$echo` whether to display or not the hidden fields. (Default: true)



### WPNonceChecker functions

```
WPNonceChecker ( string $action, string $name )
```

**WPNonceChecker** main purpose is to validate any given Nonce token comming from a set of different possible contexts.

It requires the following parameters for initialization:

 1. An action, representing the context in which the nonce is created.
 2. A name for the nonce token.


#### Verifying a nonce from request

```
WPNonceChecker::verifyNonce( [ WPContextRequester $httpContext = null ] )
```

**WPNonceChecker::verifyNonce** performs nonce validation against structured request data. Think of this as the counterpart of the `ẀPNonceCreator::createFromRequest` function but for verification purposes.

Some real-world applications for this function may include a REST API integration, which may need to validate a given nonce based on HTTP request headers, either for a GET request (think of url nonce validation) or POST (nonce input field sent as part of a form).

This function takes one optional parameter, which is an instance of **WPContextRequester** containing the request data:

 1. `$httpContext` the nonce request context.

It will return an `integer` that can be one of the following:

 * value `0` if nonce is invalid.
 * value `1` if nonce was generated in the past 12 hours or less.
 * value `2` if nonce was generated between 12 and 24 hours ago.


#### Validating a nonce from an admin screen

```
WPNonceChecker::checkAdminReferer ( [ $action, $queryArg ] )
```

**WPNonceChecker::checkAdminReferer** tests if the nonce is valid or if the request was referred from an admin screen. It will return a boolean _true_ in case you call the function with empty parameters and the request was referred from a Wordpress administration screen. In case you provide it with both parameters, the nonce sent must be valid.

Parameters are all OPTIONAL:

 1. `$action` the nonce field context.
 2. `$queryArg` Where to look for nonce in $_REQUEST global variable.


#### Validating a nonce from an AJAX request

```
WPNonceChecker::checkAjaxReferer( [ string $action, string $queryArg, bool $die ] )
```

**WPNonceChecker::checkAjaxReferer** verifies the AJAX request to prevent any requests from unauthorized third-party sites. It returns a boolean _true_ if the parameter `$die` is set to false AND the check passes.

Parameters are all OPTIONAL:

 1. `$action` the nonce field context.
 2. `$queryArg` Where to look for nonce in $_REQUEST global variable.
 3. `$die` whether to die if the nonce is invalid.


### Using the Factory class

The suggested architechture implements the **Factory Pattern** to create a class that initiates a new **WPNonceCreator** or **WPNonceChecker** Object that can be easily used for testing purposes. These new Objects can be created either using the default values for `$action` and `$name`, or custom-made ones.

To use this approach, you can create a new **WPNonceFactory** instance and make a call to its **createDefault** method:

```
$wpNonceFactory = new WPNonceFactory();

$wpNonce = $wpNonceFactory->createDefault();
```

By calling the `createDefault()` method without parameters, _WPNonceFactory_ will create a new **WPNonce** instance class with the DEFAULT `$action` and `$name` properties.

With this same technique, you can create an instance of the **WPNonceChecker** class:

```
$wpNonceFactory = new WPNonceFactory();

$wpNonceChecker = $wpNonceFactory->createDefaultChecker();
```

Notice how this time, we are calling the `createDefaultChecker()` method, also with no parameters.


## Running the tests

This project has integrated the [PHPUnit](https://phpunit.de/) framework to perform **unit tests** for all class methods on an individual basis. By employing this procedure, it guarantees that the resulting code is solid and secure, regardless the input values that you feed the functions with.

### Performing PHPUnit tests

To perform a test for a file using PHPUnit, simply run:

```
./vendor/bin/phpunit < ./path/to/file >
```


For example, in order to test the **WPNonce** class from the project folder you would run:

```
./vendor/bin/phpunit ./tests/PHPUnit/WPNonceTest.php
```

### Testing coding format standards

All the code from this library was designed to comply with the famous [php_codesniffer](https://packagist.org/packages/squizlabs/php_codesniffer) coding style.

In order to check that all files complies to this, you can simply run:

```
./vendor/bin/phpcs
```

### Development Caveats

* The separation of concerns between **WPNonceCreator** and **WPNonceChecker** made necessary an additional class to define the basic nonce properties(_action, name, token_) sitting on top of these two. This class (**WPNonceAbstract**) was defined as _abstract_ with the intention of providing with the needed flexibility to give alternative Nonce definitions if needed in future implementations.

* To meet with some initial requirements, I added an *Interface* (**WPNonceInterface**) to be implemented by **WPNonceAbstract**. This is to ensure that the class definition meets the minimum expected API methods.

* To isolate the logic behind nonce http requests as much as possible, a dedicated helper class (**WPContextRequester**) was created. This helper class makes easier to compare request parameters thanks to the **ArrayAccess** native interface, which it implements.

* **Strict typing PHP mode** must be activated. This posed a challenge given that some original WP functions expect their `$action` parameter to be either type `int` (**-1** for the default case) OR `string`. In practice, using Strict Types you can't declare a Scalar variable which can expect multiple types. That is why this default `int` type should be converted to `string` for consistency with any other non-default `$action` provided by the user.

* Finding a way to call the original **Wordpress functions** without being implemented. Finally I opted for [Brain Monkey](https://brain-wp.github.io/BrainMonkey/docs/what-and-why.html) for mocking and testing the functions in an 'unit test' fashion. 


## Built With

* [PHP7](https://www.php.net/releases/7_0_0.php)
* [Composer](https://getcomposer.org/) - PHP Dependency Manager
* [PHPUnit 8](https://phpunit.de/getting-started/phpunit-8.html) - Testing framework for PHP
* [Brain Monkey](https://brain-wp.github.io/BrainMonkey/docs/what-and-why.html) - Utility for mocking PHP functions
* [PHP_CodeSniffer](https://packagist.org/packages/squizlabs/php_codesniffer) - Coding style checker
* [PSR-4](https://www.php-fig.org/psr/psr-4/) - Specification for autoloading classes
* [Git](https://git-scm.com/) - version-control system

## Authors

* **Luis De Benito** 

## License

This project is licensed under the **GPLv3 License** - see the [LICENSE.md](LICENSE.md) file for details


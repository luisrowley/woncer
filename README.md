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

The logic behind this API is divided in two main Classes: **WPNonce** and **WPNonceChecker**.

### WPNonce functions

```
WPNonce($action, $name)
```

**WPNonce** handles the functions to create a new Nonce token, and optionally adding it as a query string inside a URL, a hidden form field, or any other custom context if required.

Any _Object instance_ will require two parameters: 

 1. An action, representing the context in which the nonce is created.
 2. A name for the nonce token.

Upon creation, it will call the [wp_create_nonce](https://developer.wordpress.org/reference/functions/wp_create_nonce/) function to provide with an initial token value.

#### Adding nonce to URL

```
WPNonce::addNonceUrl ( string $actionUrl [, string $action, string $name] )
```

**WPNonce::addNonceUrl** receives an URL as input and returns the same URL with a Nonce token value attached to it. This URL always refer to a specific _action_ and if no _action_ is provided it will resort to the _default action_ value.

Defaults are supported for the optional parameters as per the [official docs](https://codex.wordpress.org/Function_Reference/wp_nonce_url):

 1. `$actionUrl` the base URL to which to append the Nonce value.
 2. `$action` the nonce field context.
 3. `$name` the nonce name. 


#### Adding nonce to Form

```
WPNonce::addNonceToForm ( [string $action, string $name, bool $referer, bool $echo] )
```

**WPNonce::addNonceToForm** returns or displays the nonce hidden form field. This form field is attached to a given form to guarantee its legitimacy, proving that the contents of the form request came from the current site and not from somewhere else. It internally calls the Wordpress [wp_nonce_field](https://codex.wordpress.org/Function_Reference/wp_nonce_field) function to get the nonce field.

All parameters are optional: 
 
 1. `$action` the nonce field context.
 2. `$name` the nonce name. 
 3. `$referer` to specify whether the referer hidden form field should also be created. (Default: true)
 4. `$echo` whether to display or not the hidden fields. (Default: true)

#### Creating a Nonce for any other context

```
WPNonce::createNonceToken ( string $action )
```

**WPNonce::createNonceToken** function is called automatically every time you create a new _WPNonce_ object instance, for consistency purposes. Nonetheless, you can also call it manually whenever needed in order to generate a new Nonce token hash value to fit any custom context.

Following the [official implementation](https://developer.wordpress.org/reference/functions/wp_create_nonce/), it only takes one required _action_ parameter:

 1. `$action` the nonce field context.

### WPNonceChecker functions

```
WPNonceChecker($action, $name)
```

**WPNonceChecker** is a child class of _WPNonce_. It inherits its properties and its main purpose is to validate any given Nonce token comming from a set of different possible contexts.

As a subclass of _WPNonce_ it requires the same parameters for initialization:

 1. An action, representing the context in which the nonce is created.
 2. A name for the nonce token.

#### Validating a nonce from an admin screen



### Using the Factory class

## Running the tests

This project has integrated the [PHPUnit](https://phpunit.de/) framework to perform **unit tests** for all class methods on an individual basis. By employing this procedure, it guarantees that the resulting code is solid and secure, regardless the input values that you feed the functions with.

### Performing PHPUnit tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

### Development Caveats

* The logic behind defining **WPNonceChecker** a subclass of **WPNonce** is that the former will need the properties (_action, name, token_) provided by the latter in order for the verification process to work. Also the _inheritance_ approach allows to apply the DRY (*D*on't *R*epeat *Y*ourself) principle to our code base for shared properties and common methods between these classes.

* On top of this Parent/Child relationship, I added an *Interface* (**WPNonceInterface**) to be implemented by the main **WPNonce** class for consistency purposes. This is to ensure that the class definition meets the minimum expected API methods.

* Strinct typing PHP mode is activated. This posed a challenge...


## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Authors

* **Luis De Benito** -

## License

This project is licensed under the **GPLv3 License** - see the [LICENSE.md](LICENSE.md) file for details


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

 1) Cloning this repository:

```
git clone https://luis_dbm@bitbucket.org/luis_dbm/woncer.git
```

 2) Changing to the project directory:

```
cd woncer
```

 3) And installing the composer dependencies by running:

```
composer install
```

## How to use

The logic behind this API is divided in two main Classes: **WPNonce** and **WPNonceChecker**.

### WPNonce functions



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

* The tough part was
* ...
* etc


## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Authors

* **Luis De Benito** - *Find me on github as* [luisrowley](https://github.com/luisrowley)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the **GPLv3 License** - see the [LICENSE.md](LICENSE.md) file for details


# Changelog

## 0.0.2 (2019-12-23)

**Fixed bugs:**

 1. Inheritance: Fixed the "decoupling" problem between the `WPNonceChecker` (nonce validation class) and its parent class `WPNonce` (main nonce class definition).

 2. In the previous version, all the Nonce creation logic was centralized in the `WPNonce` class, which made the structure very rigid and was lacking modularity.

 3. The whole interface architecture needed to be redefined to follow the new class segmentation.

**Implemented enhancements:**

1. Instead of building a parent/child relationship between these two classes (`WPNonce` and `WPNonceChecker`), a better solution was to implement a "top-level" abstract class called `WPNonceAbstract` with the main Nonce definition. This abstract class will be implemented by any of the classes which may need a basic Nonce definition to properly work.

2. The solution was to implement a separate class for each different context: `WPNonceDefaultCreator`, `WPNonceURLCreator` and `WPNonceFieldCreator`.

3. The `WPNonceInterface` was replaced by a new set of interfaces, matching the new class structure accordingly: `DefaultCreatorInterface`, `URLCreatorInterface` and `FieldCreatorInterface` for the "creator classes". 

| Class                 | Interface               |
|:---------------------:|:-----------------------:|
| WPNonceDefaultCreator | DefaultCreatorInterface |
| WPNonceURLCreator     | URLCreatorInterface     |
| WPNonceFieldCreator   | FieldCreatorInterface   |


And `CheckerInterface` for `WPNonceChecker` class:

| Class                 | Interface               |
|:---------------------:|:-----------------------:|
| WPNonceChecker        | CheckerInterface        |
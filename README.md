Installation
============
TODO

CHANGELOG
=========
* 1.0.4
  * Removed bin folder
* 1.0.3
  * Fixed issue with Singleton class.
    * Description: When using the library in multiple plugins the Singleton class was only returning the class firstly ever
    used by it. Obviously this was not intended behavior. It now returns the only the first used instance of each class type
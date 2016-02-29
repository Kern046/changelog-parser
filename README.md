Changelog Parser
===============

Introduction
------------

This library is meant to parse changelog files and convert its data to different formats.

It would be used to get dynamically data from a changelog file to inform users about the different versions and their changes.

With this library it is easy to use changelog data in any way.

Installation
------------

You can use composer to set the library as your project dependency

```shell
composer require kern046/changelog-parser
```

Usage
------------

To use this library, you can create an instance of the changelog manager

```php
use ChangelogParser\Manager\ChangelogManager;

$changelogManager = new ChangelogManager();
```

To get the last version data of your changelog file, write the following code :

```php
// The second parameter is optional, default is 'json'
$changelogManager->getLastVersion('CHANGELOG.md', 'json');
```
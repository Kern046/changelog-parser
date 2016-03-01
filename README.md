Changelog Parser
===============

[![Latest Stable Version](https://poser.pugx.org/kern046/changelog-parser/v/stable)](https://packagist.org/packages/kern046/changelog-parser)
[![Latest Unstable Version](https://poser.pugx.org/kern046/changelog-parser/v/unstable)](https://packagist.org/packages/kern046/changelog-parser)
[![Build Status](https://scrutinizer-ci.com/g/Kern046/changelog-parser/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Kern046/changelog-parser/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Kern046/changelog-parser/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Kern046/changelog-parser/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Kern046/changelog-parser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Kern046/changelog-parser/?branch=master)
[![Total Downloads](https://poser.pugx.org/kern046/changelog-parser/downloads)](https://packagist.org/packages/kern046/changelog-parser)
[![License](https://poser.pugx.org/kern046/changelog-parser/license)](https://packagist.org/packages/kern046/changelog-parser)

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

To get all data contained in the changelog file, use the following method :

```php
// The second parameter is optional, default is 'json'
$changelogManager->getAllVersions('CHANGELOG.md', 'json');
```
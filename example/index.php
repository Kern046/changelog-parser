<?php

require(dirname(__DIR__) . '/vendor/autoload.php');

use ChangelogParser\Manager\ChangelogManager;

$manager = new ChangelogManager();
// Set the cache validity time to one day
$manager->getCacheManager()->setCacheTime(60*60*24);
echo $manager->getLastVersion(__DIR__ . '/EXAMPLE_CHANGELOG.md') . "\n";
echo $manager->getAllVersions(__DIR__ . '/EXAMPLE_CHANGELOG.md') . "\n";
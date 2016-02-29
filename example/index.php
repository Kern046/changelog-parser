<?php

require(dirname(__DIR__) . '/vendor/autoload.php');

use ChangelogParser\Manager\ChangelogManager;

$manager = new ChangelogManager();
echo $manager->getLastVersion(__DIR__ . '/EXAMPLE_CHANGELOG.md') . "\n";
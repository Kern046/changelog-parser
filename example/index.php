<?php

require(dirname(__DIR__) . '/vendor/autoload.php');

use ChangelogParser\Driver\JsonDriver;

$parser = new JsonDriver();
$parser->convert(__DIR__ . '/EXAMPLE_CHANGELOG.md');
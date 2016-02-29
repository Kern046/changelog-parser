<?php

namespace Changelog\Test\Driver;

use ChangelogParser\Driver\JsonDriver;

class JsonDriverTest extends \PHPUnit_Framework_TestCase {
    /** @var JSonDriver **/
    protected $driver;
    
    public function setUp() {
        $this->driver = new JsonDriver();
        $this->driver->setStoragePath(dirname(__DIR__) . '/fixtures/storage/changelog.json');
    }
    
    public function testConvert() {
        $this->driver->convert(realpath(dirname(__DIR__) . '/fixtures/changelog-fixture.md'));
        
        $destinationPath = realpath(dirname(__DIR__) . '/fixtures/storage/changelog.json');
        
        $this->assertFileExists($destinationPath);
        
        $fileContent = file_get_contents($destinationPath);
        
        $this->assertJson($fileContent);
        $this->assertCount(3, json_decode($fileContent, true));
    }
}
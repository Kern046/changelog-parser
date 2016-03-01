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
    
    public function testGetLastVersion() {
        $lastVersion = $this->driver->getLastVersion();
        
        $this->assertJson($lastVersion);
        $this->assertEquals([
            '0.3.0' => [
                'date' => '2015-12-03',
                'items' => [
                    'added'=> [
                        'RU translation from @aishek.',
                        'pt-BR translation from @tallesl.',
                        'es-ES translation from @ZeliosAriex.'
                    ]
                ]
            ]
        ], json_decode($lastVersion, true));
    }
    
    public function testGetAllVersions() {
        $versions = $this->driver->getAllVersions();
        
        $this->assertJson($versions);
        $this->assertEquals([
            'unreleased' => [
                'items' => [
                    'added' => [
                        'zh-CN and zh-TW translations from @tianshuo.',
                        'de translation from @mpbzh.'
                    ]
                ]
            ],
            '0.3.0' => [
                'date' => '2015-12-03',
                'items' => [
                    'added'=> [
                        'RU translation from @aishek.',
                        'pt-BR translation from @tallesl.',
                        'es-ES translation from @ZeliosAriex.'
                    ]
                ]
            ],
            '0.2.0' => [
                'date' => '2015-10-06',
                'items' => [
                    'changed' => [
                        'Remove exclusionary mentions of "open source" since this project can benefit'
                    ]
                ]
            ]
        ], json_decode($versions, true));
    }
}
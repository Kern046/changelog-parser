<?php

namespace Changelog\Test\Manager;

use ChangelogParser\Manager\ChangelogManager;

class ChangelogManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var \ChangelogParser\Manager\ChangelogManager **/
    protected $manager;
    
    public function setUp() {
        $this->manager = new ChangelogManager();
        $this->manager->setStoragePath(dirname(__DIR__) . '/fixtures/storage/changelog.json');
    }
    
    public function testGetLastVersion() {
        $lastVersion = $this->manager->getLastVersion(realpath(dirname(__DIR__) . '/fixtures/changelog-fixture.md'));
        
        $this->assertJson($lastVersion);
        $this->assertEquals([
            '0.3.0' => [
                'date' => '2015-12-03',
                'items' => [
                    'Added'=> [
                        'RU translation from @aishek.',
                        'pt-BR translation from @tallesl.',
                        'es-ES translation from @ZeliosAriex.'
                    ]
                ]
            ]
        ], json_decode($lastVersion, true));
    }
    
    public function testGetAllVersions() {
        $versions = $this->manager->getAllVersions(realpath(dirname(__DIR__) . '/fixtures/changelog-fixture.md'));
        
        $this->assertJson($versions);
        $this->assertEquals([
            'unreleased' => [
                'items' => [
                    'Added' => [
                        'zh-CN and zh-TW translations from @tianshuo.',
                        'de translation from @mpbzh.'
                    ]
                ]
            ],
            '0.3.0' => [
                'date' => '2015-12-03',
                'items' => [
                    'Added'=> [
                        'RU translation from @aishek.',
                        'pt-BR translation from @tallesl.',
                        'es-ES translation from @ZeliosAriex.'
                    ]
                ]
            ],
            '0.2.0' => [
                'date' => '2015-10-06',
                'items' => [
                    'Changed' => [
                        'Remove exclusionary mentions of "open source" since this project can benefit'
                    ]
                ]
            ]
        ], json_decode($versions, true));
    }
}
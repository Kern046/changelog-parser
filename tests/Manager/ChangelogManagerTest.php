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
}
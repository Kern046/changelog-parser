<?php

namespace Changelog\Test\Manager;

use ChangelogParser\Manager\CacheManager;

class CacheManagerTest extends \PHPUnit_Framework_TestCase {
    /** @var \ChangelogParser\Manager\CacheManager **/
    protected $cacheManager;
    
    public function setUp() {
        $this->cacheManager = new CacheManager();
    }
    
    public function testGenerateCache() {
        $this->cacheManager->generateCache(dirname(__DIR__) . '/fixtures/changelog-fixture.md', 'test-changelog.json', 'cached content');
        
        $cacheFile = __DIR__ . '/../../data/cache/fixtures-changelog-fixture-test-changelog.json.cache';
        
        $this->assertFileExists($cacheFile);
        $this->assertEquals('cached content', file_get_contents($cacheFile));
    }
    
    public function testGetCacheWithCachedFile() {
        $this->assertEquals('cached content', $this->cacheManager->getCache(dirname(__DIR__) . '/fixtures/changelog-fixture.md', 'test-changelog.json'));
    }
    
    public function testGetCacheWithUncachedFile() {
        $this->assertFalse($this->cacheManager->getCache(dirname(__DIR__) . '/fixtures/false-changelog.md', 'test-false-changelog.json'));
    }
}
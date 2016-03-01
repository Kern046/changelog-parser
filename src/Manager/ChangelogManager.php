<?php

namespace ChangelogParser\Manager;

class ChangelogManager {
    /** @var \ChangelogParser\Driver\Driver **/
    protected $driver;
    /** @var \ChangelogParser\Manager\CacheManager **/
    protected $cacheManager;
    /** @var string **/
    protected $storagePath;
    
    public function __construct() {
        $this->cacheManager = new CacheManager();
    }
    
    /**
     * @param string $storagePath
     * @return \ChangelogParser\Driver\Driver
     */
    public function setStoragePath($storagePath) {
        $this->storagePath = $storagePath;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getStoragePath() {
        return $this->storagePath;
    }
    
    /**
     * @param string $filepath
     * @param string $format
     * @return mixed
     */
    public function getLastVersion($filepath, $format = 'json') {
        $cacheFile = "last-version.$format";
        if(($cache = $this->cacheManager->getCache($filepath, $cacheFile)) !== false) {
            return $cache;
        }
        $this->initializeDriver($format);
        $this->driver->convert($filepath);
        $content = $this->driver->getLastVersion();
        $this->cacheManager->generateCache($filepath, $cacheFile, $content);
        return $content;
    }
    
    /**
     * @param string $filepath
     * @param string $format
     * @return mixed
     */
    public function getAllVersions($filepath, $format = 'json') {
        $cacheFile = "all-versions.$format";
        if(($cache = $this->cacheManager->getCache($filepath, $cacheFile)) !== false) {
            return $cache;
        }
        $this->initializeDriver($format);
        $this->driver->convert($filepath);
        $content = $this->driver->getAllVersions();
        $this->cacheManager->generateCache($filepath, $cacheFile, $content);
        return $content;
    }
    
    /**
     * @param string $format
     * @throws \InvalidArgumentException
     */
    public function initializeDriver($format) {
        $driverClass = 'ChangelogParser\\Driver\\' . ucfirst($format) . 'Driver';
        
        if(!class_exists($driverClass)) {
            throw new \InvalidArgumentException('The requested format is not supported');
        }
        
        $this->driver = new $driverClass();
        if($this->storagePath !== null) {
            $this->driver->setStoragePath($this->storagePath);
        }
    }
    
    /**
     * @return \ChangelogParser\Manager\CacheManager
     */
    public function getCacheManager() {
        return $this->cacheManager;
    }
}
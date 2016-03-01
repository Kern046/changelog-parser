<?php

namespace ChangelogParser\Manager;

class ChangelogManager {
    /** @var \ChangelogParser\Driver\Driver **/
    protected $driver;
    /** @var string **/
    protected $storagePath;
    
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
        $this->initializeDriver($format);
        $this->driver->convert($filepath);
        return $this->driver->getLastVersion();
    }
    
    /**
     * @param string $filepath
     * @param string $format
     * @return mixed
     */
    public function getAllVersions($filepath, $format = 'json') {
        $this->initializeDriver($format);
        $this->driver->convert($filepath);
        return $this->driver->getAllVersions();
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
}
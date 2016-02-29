<?php

namespace ChangelogParser\Manager;

class ChangelogManager {
    /** @var \ChangelogParser\Driver\Driver **/
    protected $driver;
    
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
     * @param string $format
     * @throws \InvalidArgumentException
     */
    public function initializeDriver($format) {
        $driverClass = 'ChangelogParser\\Driver\\' . ucfirst($format) . 'Driver';
        
        if(!class_exists($driverClass)) {
            throw new \InvalidArgumentException('The requested format is not supported');
        }
        
        $this->driver = new $driverClass();
    }
}
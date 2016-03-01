<?php

namespace ChangelogParser\Driver;

use ChangelogParser\Parser\Parser;

abstract class Driver {
    /** @var ChangelogParser\Parser\Parser **/
    protected $parser;
    /** @var string **/
    protected $storagePath;
    
    public function __construct() {
        $this->parser = new Parser();
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
     * @param array $data
     * @return string
     */
    abstract protected function formatData($data);
    
    /**
     * @return mixed
     */
    abstract protected function getLastVersion();
    
    /**
     * @return mixed
     */
    abstract protected function getAllVersions();
    
    /**
     * @param string $filepath
     */
    public function convert($filepath) {
        $formattedData = $this->formatData($this->parser->parse($filepath));
        $this->storeResults($formattedData);
    }
    
    /**
     * @param mixed $data
     */
    protected function storeResults($data) {
        if(is_file($this->storagePath)) {
            unlink($this->storagePath);
        }
        file_put_contents($this->storagePath, $data);
    }
}
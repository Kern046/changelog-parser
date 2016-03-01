<?php

namespace ChangelogParser\Manager;

class CacheManager {
    /** @var int **/
    protected $cacheTime = 3600;
    
    /**
     * Time in seconds
     * 
     * @param int $cacheTime
     */
    public function setCacheTime($cacheTime) {
        $this->cacheTime = $cacheTime;
    }
    
    /**
     * @return int
     */
    public function getCacheTime() {
        return $this->cacheTime;
    }
    
    /**
     * @param string $file
     * @param string $content
     */
    public function generateCache($file, $content) {
        file_put_contents($this->generateCachePath($file), $content);
    }
    
    /**
     * @param string $file
     * @return mixed
     */
    public function getCache($file) {
        $path = $this->generateCachePath($file);
        if(!is_file($path) || ($generationTime = filemtime($path)) === false || $generationTime < (time() - $this->cacheTime)) {
            clearstatcache(true, $path);
            return false;
        }
        $content = file_get_contents($path);
        clearstatcache(true, $path);
        return $content;
    }
    
    /**
     * @param string $file
     * @return string
     */
    public function generateCachePath($file) {
        return realpath(__DIR__ . "/../../data/cache") . "/$file.cache";
    }
}
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
     * @param string $changelogFile
     * @param string $cacheFile
     * @param string $content
     */
    public function generateCache($changelogFile, $cacheFile, $content) {
        file_put_contents($this->generateCachePath($changelogFile, $cacheFile), $content);
    }
    
    /**
     * @param string $changelogFile
     * @param string $cacheFile
     * @return mixed
     */
    public function getCache($changelogFile, $cacheFile) {
        $path = $this->generateCachePath($changelogFile, $cacheFile);
        if(!is_file($path) || ($generationTime = filemtime($path)) === false || $generationTime < (time() - $this->cacheTime)) {
            clearstatcache(true, $path);
            return false;
        }
        $content = file_get_contents($path);
        clearstatcache(true, $path);
        return $content;
    }
    
    /**
     * @param string $changelogFile
     * @param string $cacheFile
     * @return string
     */
    public function generateCachePath($changelogFile, $cacheFile) {
        $changelogSignature = str_replace([':', ' ', '/', '\\'], '-', strtolower(basename(dirname($changelogFile)) . '-' . basename($changelogFile, 'md')));
        
        return realpath(__DIR__ . "/../../data/cache"). '/' . $changelogSignature . "-$cacheFile.cache";
    }
}
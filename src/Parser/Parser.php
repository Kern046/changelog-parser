<?php

namespace ChangelogParser\Parser;

class Parser {
    /** @var array **/
    protected $releases;
    /** @var string **/
    protected $currentRelease;
    /** @var string **/
    protected $currentReleasePart;
    
    /**
     * @param string $filepath
     * @return array
     */
    public function parse($filepath) {
        foreach($this->parseFile($filepath) as $line) {
            $this->parseLine($line);
        }
        return $this->releases;
    }
    
    /**
     * @param string $filepath
     * @throws \RuntimeException
     */
    private function parseFile($filepath) {
        if(($file = fopen($filepath, 'r')) === false) {
            throw new \RuntimeException("The file $filepath does not exist");
        }
        
        while($line = fgets($file)) {
            yield $line;
        }
        fclose($file);
    }
    
    /**
     * @param string $line
     */
    private function parseLine($line) {
        switch($line{0}) {
            case '#':
                $this->parseTitle($line);
                break;
            case '-':
                $this->parseItem($line);
                break;
        }
    }
    
    /**
     * @param string $line
     */
    private function parseTitle($line) {
        for($i = 0; $i < 3; ++$i) {
            if($line{$i} !== '#') {
                break;
            }
        }
        switch($i) {
            case 2:
                $parts = explode('-', $line);
                if(count($parts) === 1) {
                    $this->currentRelease = $this->formatReleaseVersion($line);
                    break;
                }
                $this->currentRelease = $this->formatReleaseVersion($parts[0]);
                unset($parts[0]);
                $this->releases[$this->currentRelease]['date'] = trim(implode('-', $parts));
                
                break;
            case 3:
                $this->currentReleasePart = trim(substr($line, 3));
                break;
        }
    }
    
    /**
     * @param string $releaseVersion
     * @return string
     */
    private function formatReleaseVersion($releaseVersion) {
        return strtolower(str_replace(['[', ']'], '', trim(substr($releaseVersion, 2))));
    }
    
    /**
     * @param string $line
     */
    private function parseItem($line) {
        $this->releases[$this->currentRelease]['items'][$this->currentReleasePart][] = trim(substr($line,1));
    }
}
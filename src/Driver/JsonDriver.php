<?php

namespace ChangelogParser\Driver;

class JsonDriver extends Driver {
    public function __construct() {
        parent::__construct();
        $this->storagePath = __DIR__ . '/../../data/changelog.json';
    }
    
    /**
     * {@inheritdoc}
     */
    public final function formatData($data) {
        return json_encode($data);
    }
    
    /**
     * {@inheritdoc}
     */
    public final function getLastVersion() {
        $data = json_decode($this->getAllVersions(), true);
        
        foreach($data as $version => $changelog) {
            if($version === 'unreleased') {
                continue;
            }
            return json_encode([$version => $changelog]);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public final function getAllVersions() {
        return file_get_contents($this->storagePath);
    }
}
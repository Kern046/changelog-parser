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
}
<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class ModuleExtend {
    private $path = null;

    public function __construct($path) {
        $this->path = $path;

        require_once $this->path.'/module.php';
    }

    public function path() {
        return $this->path;
    }
}
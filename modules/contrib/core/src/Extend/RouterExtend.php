<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class RouterExtend {
    private $uri = null;
    public function init() {
        $this->uri = $_SERVER['REQUEST_URI'];

    }

    public function getUri() {
        return $this->uri;
    }
}
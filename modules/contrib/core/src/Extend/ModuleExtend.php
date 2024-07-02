<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class ModuleExtend {
    private $path = null;

    public function __construct($path) {
        $this->path = $path;

        require_once $this->path.'/module.php';

        /* Load config/services */

        /* Load entities */
        if (file_exists($this->path.'/config/entities.yml')) {
            $data = YAML::parse(file_get_contents($this->path.'/config/entities.yml'));
            foreach($data as $key => $value) {
                core()->addResource('entity', $key, $value);
            }
        }
    }

    public function path() {
        return $this->path;
    }
}
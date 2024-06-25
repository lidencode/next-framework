<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class RepositoryExtend {
    private $repository = null;
    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function find($ids) {
        return "hola find";
    }
}
<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class RepositoryExtend {
    private $repository = null;
    private $schema = null;
    public function __construct($repository) {
        if ($entity = core()->getResource('entity', $repository)) {
            $this->repository = $entity;
            $this->schema = $this->repository['class']::schema();
        }
    }

    public function find($ids) {
        return "hola find";
    }
}
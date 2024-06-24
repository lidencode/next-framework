<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class DatabaseExtend {
    private $connection = null;

    public function __construct($key, $config) {
        $charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        $connection = new \mysqli($config['hostname'], $config['username'],
            $config['password'], $config['database']);

        if ($connection->connect_error) {
            error('MySQL ERROR: '.$connection->connect_error);
        }

        if (!$connection->set_charset($charset)) {
            error('MySQL ERROR: '.$connection->connect_error);
        }

        $this->connection[$key] = $connection;

        return $this->connection[$key];
    }

    public function get($key) {
        if (isset($this->connection[$key])) {
            return $this->connection[$key];
        } else {
            error('MySQL ERROR: Connection does not exist!');
        }
    }
}
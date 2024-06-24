<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class DatabaseExtend {
    private $connection = null;

    public function __construct($config) {
        $charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        $connection = new \mysqli($config['hostname'], $config['username'],
            $config['password'], $config['database']);

        if ($connection->connect_error) {
            error('MySQL ERROR: '.$connection->connect_error);
        }

        if (!$connection->set_charset($charset)) {
            error('MySQL ERROR: '.$connection->connect_error);
        }

        $this->connection = $connection;

        return $this->connection;
    }

    /**
     * Get Database Connection
     *
     * @param $database
     * @return \mysqli
     */
    public function getConnection() {
        if (isset($this->connection)) {
            return $this->connection;
        } else {
            error('MySQL ERROR: Connection does not exist!');
        }
    }

    public function query($sql, $params = [], $database = 'main') {
        if (!isset($this->connection)) {
            error('MySQL ERROR: Database does not exist!');
        }

        if (count($params)) {
            $paramValue = null;

            foreach ($params as $key => $value) {
                if (is_int($value)) {
                    $paramValue = $value;
                } elseif (is_double($value)) {
                    $paramValue = $value;
                } elseif (is_string($value)) {
                    $paramValue = "'".$value."'";
                } else {
                    $paramValue = "'".$value."'";
                }
            }

            $sql = str_replace(':'.$key, $paramValue, $sql);
        }

        if (!$stmt = $this->connection->prepare($sql)) {
            error('MySQL ERROR: '.$this->connection->error);
        }

        if (!$stmt->execute()) {
            error('MySQL ERROR: '.$stmt->error);
        }

        if ($result = $stmt->get_result()) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return true;
        }

        return false;
    }
}
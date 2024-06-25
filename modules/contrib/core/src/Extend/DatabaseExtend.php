<?php

namespace NextFramework\Core\Extend;

use Symfony\Component\Yaml\Yaml;

class DatabaseExtend {
    private $connection = null;

    public function __construct($config) {
        $charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        try {
            $dsn = 'mysql:host='.$config['hostname'].';dbname='.$config['database'].';charset='.$charset;
            $this->connection = new \PDO($dsn, $config['username'], $config['password']);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            error('MySQL ERROR: '.$e->getMessage());
        }

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

        if (!$stmt = $this->connection->prepare($sql)) {
            error('MySQL ERROR: '.$this->connection->error);
        }

        if (count($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindParam(':'.$key, $value);
            }
        }

        if (!$stmt->execute()) {
            error('MySQL ERROR: '.$stmt->error);
        }

        if ($result = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            return $result;
        }

        return false;
    }

    /**
     * @param $repository
     * @return RepositoryExtend
     */
    public function repository($repository) {
        $repositoryObject = new RepositoryExtend($repository);

        return $repositoryObject;
    }
}
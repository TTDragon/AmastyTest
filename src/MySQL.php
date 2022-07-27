<?php

namespace Amasty\Trainee;

class MySQL
{
    private \PDO $mysql;

    public function __construct() {
        $this->mysql = new \PDO(
            sprintf('mysql:dbname=%s;host=%s', MYSQL_DB, MYSQL_HOST),
            MYSQL_USER,
            MYSQL_PASSWORD
        );

        $directoryIterator = new \DirectoryIterator(BP . '/src/install');
        $connection = $this;

        foreach ($directoryIterator as $file) {
            if (strpos($file->getFilename(), '.php') !== false) {
                include $file->getRealPath();
            }
        }
    }

    public function query(string $query)
    {
        $this->mysql->query($query);
    }

    public function fetchAll(string $query, $params = null)
    {
        $fetchParams = $params ? [$params] : [];
        $statement = $this->getStatement($query);
        $statement->execute(...$fetchParams);

        return (array) $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchOne(string $query, $params = null)
    {
        $result = $this->fetchAll($query, $params);

        if (empty($result)) {
            return null;
        }

        $firstRow = reset($result);

        return reset($firstRow);
    }

    private function getStatement(string $query)
    {
        $statement = $this->mysql->prepare($query);

        return $statement;
    }
}
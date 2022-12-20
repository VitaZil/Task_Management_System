<?php

namespace Vitab\TaskManagementSystem\Services;

use PDO;

class DatabaseService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO(
            'mysql:host=localhost:3306;dbname=management_system',
            'root',
            '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
    }

    public function execute(string $sql): int
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function fetchAll(string $sql): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

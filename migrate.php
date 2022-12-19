<?php

$pdo = new PDO(
    'mysql:host=localhost:3306',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);

$queries = [
    'CREATE DATABASE IF NOT EXISTS management_system',
    'USE management_system; CREATE TABLE IF NOT EXISTS employees (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        multiworker VARCHAR(100) DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP
    )',
    'USE management_system; CREATE TABLE IF NOT EXISTS assignments (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        status VARCHAR(10) DEFAULT \'running\',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP
    )',
    'USE management_system; CREATE TABLE IF NOT EXISTS employees_assignments (
        assignment_id INT NOT NULL,
        employee_id INT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (assignment_id ) REFERENCES assignments(id) ON DELETE CASCADE,
        FOREIGN KEY (employee_id ) REFERENCES employees(id)
    )'
];

foreach ($queries as $query) {
    $statement = $pdo->prepare($query);
    $statement->execute();
}


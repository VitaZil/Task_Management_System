<?php

namespace Vitab\TaskManagementSystem\Models;

use Vitab\TaskManagementSystem\Services\DatabaseService;

class Employee
{
    public function store(array $newEmployee): int
    {
        $query = "
        INSERT INTO employees (firstname, lastname, multiworker) 
        VALUES ('{$newEmployee['firstname']}', '{$newEmployee['lastname']}', '{$newEmployee['multiworker']}')
        ";

        $database = new DatabaseService();
        $lastInsertId = $database->execute($query);

        return $lastInsertId;
    }

    public function getEmployees(): array
    {
        $query = "
        SELECT e.id, e.firstname, e.lastname, e.multiworker, a.status, COUNT(IF(a.status='complete', null, 'available')) as number_of_running_tasks
        FROM employees e
        LEFT JOIN employees_assignments ea ON ea.employee_id=e.id
        LEFT JOIN assignments a ON ea.assignment_id=a.id
        GROUP BY e.id
        ";

        $database = new DatabaseService();
        $employees = $database->fetchAll($query);

        $allAvailableEmployees = [];

        foreach ($employees as $employee) {
            if ($employee['multiworker'] === 'null' && $employee['number_of_running_tasks'] == 0 ||
                $employee['multiworker'] === 'multiworker' && $employee['number_of_running_tasks'] < 3 ||
                $employee['multiworker'] === 'null' && $employee['status'] === null && $employee['number_of_running_tasks'] < 2
            ) {
                $allAvailableEmployees[] = $employee;
            }
        }

        return $allAvailableEmployees;
    }
}

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

    public function getAllEmployees(int|string $currentPage, int $assignmentsPerPage): array
    {
        $offset = $assignmentsPerPage * ($currentPage - 1);

        $query = "
        SELECT e.id, e.firstname, e.lastname, e.multiworker, e.created_at, a.status,
       count(if(a.status='complete' OR a.status is null, null, 1)) as running_tasks,
       GROUP_CONCAT(a.title) as tasks_titles
FROM employees e
         Left JOIN employees_assignments ea ON ea.employee_id=e.id
         LEFT JOIN assignments a ON ea.assignment_id=a.id
GROUP BY e.id, e.created_at
ORDER BY e.created_at DESC
        LIMIT $assignmentsPerPage OFFSET $offset
        ";

        $database = new DatabaseService();
        return $database->fetchAll($query);
    }

    public function getAvailableEmployees(): array
    {
        $query = "
        SELECT e.id, e.firstname, e.lastname, e.multiworker, a.status,
        COUNT(IF(a.status='complete' OR a.status is null, null, 'working')) as running_tasks
        FROM employees e
        LEFT JOIN employees_assignments ea ON ea.employee_id=e.id
        LEFT JOIN assignments a ON ea.assignment_id=a.id
        GROUP BY e.id
        ";

        $database = new DatabaseService();
        $employees = $database->fetchAll($query);

        $allAvailableEmployees = [];

        foreach ($employees as $employee) {
            if ($employee['multiworker'] == 0 && $employee['running_tasks'] == 0 ||
                $employee['multiworker'] == 1 && $employee['running_tasks'] < 3) {
                $allAvailableEmployees[] = $employee;
            }
        }

        return $allAvailableEmployees;
    }

    public function getPageNumber(int $assignmentsPerPage): array
    {
        $query = "SELECT COUNT(id) as page FROM employees";
        $database = new DatabaseService();
        $numberOfEmployees = $database->fetchAll($query);
        $pageNumber = ceil($numberOfEmployees[0]['page'] / $assignmentsPerPage);

        return [$pageNumber, $numberOfEmployees[0]['page']];
    }

    public function getEmployee(int $id): array
    {
        $query = "
        SELECT firstname, lastname, id, multiworker 
        FROM employees
        WHERE id=$id
        ";

        $database = new DatabaseService();
        $employee = $database->fetchAll($query);
        return $employee[0];
    }

    public function update(int $id, array $request): void
    {
        if($request['multiworker'] == 1) {
            $multiworker = 1;
        } else {
            $multiworker = 0;
        }

        $query = "
        UPDATE employees
        SET firstname='{$request['firstname']}', lastname='{$request['lastname']}', multiworker='$multiworker'
        WHERE id=$id
        ";

        $database = new DatabaseService();
        $database->execute($query);
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM employees WHERE id=$id";

        $database = new DatabaseService();
        $database->execute($query);
    }
}

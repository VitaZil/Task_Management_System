<?php

namespace Vitab\TaskManagementSystem\Models;

use Vitab\TaskManagementSystem\Services\DatabaseService;

class Task
{
    public function store(array $newTask): void
    {
        $query = "
        INSERT INTO assignments (title) 
        VALUES ('{$newTask['title']}')
        ";

        $database = new DatabaseService();
        $taskId = $database->execute($query);

        foreach ($newTask['employee_id'][0] as $employee) {
            if ($employee != '') {
                $query = "
                INSERT INTO employees_assignments (assignment_id, employee_id)
                VALUES ($taskId, $employee)
                ";

                $database->execute($query);
            }
        }
    }

    public function getRunningAssignments(int|string $currentPage, int $assignmentsPerPage): array
    {
        $offset = $assignmentsPerPage * ($currentPage - 1);

        $query = "
        SELECT a.id, a.title, a.status, GROUP_CONCAT( e.firstname, ' ', e.lastname) as name, a.created_at, a.updated_at FROM assignments a
        JOIN employees_assignments ea ON ea.assignment_id=a.id
        JOIN employees e ON ea.employee_id=e.id
        WHERE a.status='running'
        GROUP BY a.title, a.updated_at
        ORDER BY a.updated_at DESC
        LIMIT $assignmentsPerPage OFFSET $offset
        ";

        $database = new DatabaseService();

        return $database->fetchAll($query);
    }

    public function update(int $id): void
    {
        $query = "
        UPDATE assignments
        SET status='complete' 
        WHERE id=$id
        ";

        $database = new DatabaseService();
        $database->execute($query);
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM assignments WHERE id=$id";

        $database = new DatabaseService();
        $database->execute($query);
    }

    public function getPageNumber(int $assignmentsPerPage, string $status): array
    {
        $query = "SELECT COUNT(id) as page FROM assignments WHERE status='$status'";
        $database = new DatabaseService();
        $numberOfAssignments = $database->fetchAll($query);
        $pageNumber = ceil($numberOfAssignments[0]['page'] / $assignmentsPerPage);

        return [$pageNumber, $numberOfAssignments[0]['page']];
    }

    public function getArchiveAssignments(int|string $currentPage, int $assignmentsPerPage)
    {
        $offset = $assignmentsPerPage * ($currentPage - 1);

        $query = "
        SELECT a.id, a.title, a.status, GROUP_CONCAT( e.firstname, ' ', e.lastname) as name, a.created_at, a.updated_at 
        FROM assignments a
        JOIN employees_assignments ea ON ea.assignment_id=a.id
        JOIN employees e ON ea.employee_id=e.id
        WHERE a.status='complete'
        GROUP BY a.title, a.updated_at
        ORDER BY a.updated_at DESC
        LIMIT $assignmentsPerPage OFFSET $offset
        ";

        $database = new DatabaseService();

        return $database->fetchAll($query);
    }
}

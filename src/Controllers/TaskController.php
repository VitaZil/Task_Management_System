<?php

namespace Vitab\TaskManagementSystem\Controllers;

use Vitab\TaskManagementSystem\Exceptions\NotTheSameEmployeeInOneTask;
use Vitab\TaskManagementSystem\Models\Employee;
use Vitab\TaskManagementSystem\Models\Task;

class TaskController
{
    public function create(): void
    {
        $employeeModel = new Employee();
        $employees = $employeeModel->getEmployees();

        require './views/new_task_form.php';
    }

    public function store($request): void
    {
        $task = new Task();

        try {
            foreach ($request['employee'] as $employee) {
                if ($employee != '' && !array_unique($request['employee'])) {
                    throw new NotTheSameEmployeeInOneTask;
                }

                $task->store([
                    'title' => $request['title'],
                    'employee_id' => [$employee]
                ]);
            }

            header('Location: /');

        } catch (NotTheSameEmployeeInOneTask $exception) {
            $message = $exception->getMessage();
            $employeeModel = new Employee();
            $employees = $employeeModel->getEmployees();

            require './views/new_task_form.php';
        }
    }

    public function edit(): void
    {
        $task = new Task();
        $assignments = $task->getAssignments();

        require './views/assignment.php';
    }

    public function index(): void
    {
        $task = new Task();

        $currentPage = $_GET['page'] ?? 1;

        $assignments = $task->getAssignmentsWithPagination($currentPage);

        $pageNumber = $task->getPageNumber();

        require './views/archive.php';
    }

    public function update($request): void
    {
        $task = new Task();
        $task->update((int)$request['complete']);

        header('Location: /archive');
    }

    public function delete($request): void
    {
        $task = new Task();
        $task->delete((int)$request['delete']);

        header('Location: /');
    }
}

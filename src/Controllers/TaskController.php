<?php

namespace Vitab\TaskManagementSystem\Controllers;

use Vitab\TaskManagementSystem\Exceptions\NotTheSameEmployeeInOneTask;
use Vitab\TaskManagementSystem\Models\Employee;
use Vitab\TaskManagementSystem\Models\Task;
use Vitab\TaskManagementSystem\Services\ValidationService;

class TaskController
{
    public function create(): void
    {
        $employeeModel = new Employee();
        $employees = $employeeModel->getAvailableEmployees();

        require './views/forms/new_task_form.php';
    }

    public function store(array $request): void
    {
        $task = new Task();

        try {
            if (ValidationService::checkIfEmployeeUniqueInTask($request['employee'])) {
                throw new NotTheSameEmployeeInOneTask;
            }

            $task->store([
                'title' => $request['title'],
                'employee_id' => [$request['employee']]
            ]);

            $successMessage = 'Successfully added new task!';

            header("Location: /?successmessage=$successMessage");

        } catch (NotTheSameEmployeeInOneTask $exception) {
            $message = $exception->getMessage();
            $title = $request['title'];

            header("Location: /newtask?message=$message&title=$title");
        }
    }

    public function edit(array|string $request): void
    {
        $task = new Task();
        $currentPage = $request['page'] ?? 1;
        $assignmentsPerPage = 5;

        $assignments = $task->getRunningAssignments($currentPage, $assignmentsPerPage);
        $dataForPage = $task->getPageNumber($assignmentsPerPage, 'running');
        $pageNumber = $dataForPage[0];
        $numberOfItems = $dataForPage[1];

        require './views/listings/assignment.php';
    }

    public function index(array|string $request): void
    {
        $task = new Task();
        $currentPage = $request['page'] ?? 1;
        $assignmentsPerPage = 5;

        $assignments = $task->getArchiveAssignments($currentPage, $assignmentsPerPage);
        $dataForPage = $task->getPageNumber($assignmentsPerPage, 'complete');
        $pageNumber = $dataForPage[0];
        $numberOfItems = $dataForPage[1];

        require './views/listings/archive.php';
    }

    public function update(array $request): void
    {
        $task = new Task();
        $task->update((int)$request['complete']);

        header('Location: /archive');
    }

    public function delete(array $request): void
    {
        $task = new Task();
        $task->delete((int)$request['delete']);

        header('Location: /');
    }

    public function search($request): void
    {
        $task= new Task();
        $assignments = $task->search(strtolower($request['search']));

        require './views/listings/assignment.php';
    }
}

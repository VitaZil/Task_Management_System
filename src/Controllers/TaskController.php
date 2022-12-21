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
            if (($request['employee'][0] === $request['employee'][1])
                || ($request['employee'][1] === $request['employee'][2] && $request['employee'][2] != '')
                || ($request['employee'][0] === $request['employee'][2])) {
                throw new NotTheSameEmployeeInOneTask;
            }

            $task->store([
                'title' => $request['title'],
                'employee_id' => [$request['employee']]
            ]);

            $message = 'Successfully added new task!';

//            header('Location: /');
            $task = new Task();
            $assignments = $task->getRunningAssignments();
            require './views/assignment.php';

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
        $assignments = $task->getRunningAssignments();

        require './views/assignment.php';
    }

    public function index($request): void
    {
        $task = new Task();
        $currentPage = $request['page'] ?? 1;
        $assignmentsPerPage = 10;

        $assignments = $task->getArchiveAssignments($currentPage, $assignmentsPerPage);
        $dataForPage = $task->getPageNumber($assignmentsPerPage);
        $pageNumber = $dataForPage[0];
        $numberOfItems = $dataForPage[1];

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

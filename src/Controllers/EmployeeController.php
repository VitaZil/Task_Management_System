<?php

namespace Vitab\TaskManagementSystem\Controllers;

use Vitab\TaskManagementSystem\Exceptions\NameIsTooShortException;
use Vitab\TaskManagementSystem\Models\Employee;
use Vitab\TaskManagementSystem\Models\Task;

class EmployeeController
{
    public function create(): void
    {
        require './views/new_employee_form.php';
    }

    public function store($request): void
    {
        $employee = new Employee();

        try {
            if (strlen($request['firstname']) < 3 || strlen($request['lastname']) < 3) {
                throw new NameIsTooShortException;
            }

            $employee->store([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'multiworker' => $request['multiworker'] ?? 'null',
            ]);

            $message = 'Successfully added new employee!';

            $task = new Task();
            $assignments = $task->getRunningAssignments();

            require './views/assignment.php';

        } catch (NameIsTooShortException $exception) {
            $message = $exception->getMessage();

            require './views/new_employee_form.php';
        }
    }
}

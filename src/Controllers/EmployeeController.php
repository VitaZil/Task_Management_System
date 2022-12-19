<?php

namespace Vitab\TaskManagementSystem\Controllers;

use Vitab\TaskManagementSystem\Exceptions\NameIsTooShortException;
use Vitab\TaskManagementSystem\Models\Employee;

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

            header('Location: /');

        } catch (NameIsTooShortException $exception) {
            $message = $exception->getMessage();
            require './views/new_employee_form.php';
        }
    }
}

<?php

namespace Vitab\TaskManagementSystem\Controllers;

use Vitab\TaskManagementSystem\Exceptions\NameIsTooShortException;
use Vitab\TaskManagementSystem\Exceptions\OnlyLettersAllowedInNameException;
use Vitab\TaskManagementSystem\Models\Employee;
use Vitab\TaskManagementSystem\Services\ValidationService;

class EmployeeController
{
    public function create(): void
    {
        require './views/new_employee_form.php';
    }

    public function store(array $request): void
    {
        $employee = new Employee();

        $message = '';

        try {
            if (ValidationService::checkNameLength($request['firstname'])
                || ValidationService::checkNameLength($request['lastname'])) {
                throw new NameIsTooShortException;
            }

            if (!ValidationService::validateName($request['firstname'])
                || !ValidationService::validateName($request['lastname'])) {
                throw new OnlyLettersAllowedInNameException;
            }

            $employee->store([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'multiworker' => (int)$request['multiworker'] ?? 0,
            ]);

            $successMessage = 'Successfully added new employee!';

        } catch (NameIsTooShortException $exception) {
            $message = $exception->getMessage();
        } catch (OnlyLettersAllowedInNameException $exception) {
            $message = $exception->getMessage();
        }

        if (strlen($message) === 0) {
            header("Location: /employees?successmessage=$successMessage");
        }

        if (strlen($message) > 0) {
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            header("Location: /newemployee?message=$message&firstname=$firstname&lastname=$lastname");
        }
    }

    public function index(array|string $request): void
    {
        $employeeModel = new Employee();

        $currentPage = $request['page'] ?? 1;
        $assignmentsPerPage = 5;
        $employees = $employeeModel->getAllEmployees($currentPage, $assignmentsPerPage);
        $dataForPage = $employeeModel->getPageNumber($assignmentsPerPage);
        $pageNumber = $dataForPage[0];
        $numberOfItems = $dataForPage[1];

        require './views/employees.php';
    }

    public function edit(int $id): void
    {
        $employeeModel = new Employee();
        $employee = $employeeModel->getEmployee($id);

        require './views/employee_show.php';
    }

    public function update(int $id): void
    {
        $employeeModel = new Employee();

        $message = '';

        try {
            if (ValidationService::checkNameLength($_POST['firstname'])
                || ValidationService::checkNameLength($_POST['lastname'])) {
                throw new NameIsTooShortException;
            }

            if (!ValidationService::validateName($_POST['firstname'])
                || !ValidationService::validateName($_POST['lastname'])) {
                throw new OnlyLettersAllowedInNameException;
            }

            $employeeModel->update($id, $_POST);

            $successMessage = 'Employee was successfully updated!';

        } catch (NameIsTooShortException $exception) {
            $message = $exception->getMessage();
        } catch (OnlyLettersAllowedInNameException $exception) {
            $message = $exception->getMessage();
        }

        if (strlen($message) === 0) {
            header("Location: /employees?successmessage=$successMessage");
        }

        if (strlen($message) > 0) {
            header("Location: /employees/$id?message=$message");
        }
    }

    public function delete(array $request): void
    {
        $employee = new Employee();
        $employee->delete((int)$request['delete']);

        $successMessage = 'Employee was successfully deleted!';

        header("Location: /employees?successmessage=$successMessage");
    }

}

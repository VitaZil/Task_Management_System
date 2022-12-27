<?php

namespace Vitab\TaskManagementSystem\Services;

use Vitab\TaskManagementSystem\Exceptions\OnlyLettersAllowedInNameException;

class ValidationService
{
    static public function validateName(string $name): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $name);
    }

    static public function checkNameLength(string $name): bool
    {
        return strlen($name) < 3;
    }

    static  public function checkIfEmployeeUniqueInTask(array $employees): bool
    {
        return (($employees[0] === $employees[1])
        || ($employees[1] === $employees[2] && $employees[2] != '')
        || ($employees[0] === $employees[2]));
    }

}
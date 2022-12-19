<?php

namespace Vitab\TaskManagementSystem\Exceptions;

class NotTheSameEmployeeInOneTask extends \Exception
{
protected $message = "Can't be the same employee in one task. Choose another employee.";
}
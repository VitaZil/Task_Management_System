<?php

namespace Vitab\TaskManagementSystem\Exceptions;

class CantDeleteException extends \Exception
{
    protected $message = "Can't delete this employee. Employee has related tasks!";
}

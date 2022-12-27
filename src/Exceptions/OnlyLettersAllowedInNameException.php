<?php

namespace Vitab\TaskManagementSystem\Exceptions;

class OnlyLettersAllowedInNameException extends \Exception
{
    protected $message = 'Name should consist only from letters.';
}

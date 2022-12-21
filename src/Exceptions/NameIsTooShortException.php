<?php

namespace Vitab\TaskManagementSystem\Exceptions;

class NameIsTooShortException extends \Exception
{
    protected $message = 'Your name is too short. Name should be minimum from 3 characters.';
}

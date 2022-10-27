<?php

namespace InetStudio\SchedulePackage\Slots\Application\Exceptions;

use Exception;

class ResourceDoesNotExistException extends Exception
{
    public static function create(string $id): self
    {
        $message = 'The slot %s does not exist.';

        return new static(sprintf($message, $id), 404);
    }
}

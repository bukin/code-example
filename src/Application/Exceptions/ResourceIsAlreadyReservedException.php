<?php

namespace InetStudio\SchedulePackage\Slots\Application\Exceptions;

use Exception;

class ResourceIsAlreadyReservedException extends Exception
{
    public static function create(string $id): self
    {
        $message = 'The slot %s is already reserved.';

        return new static(sprintf($message, $id), 409);
    }
}

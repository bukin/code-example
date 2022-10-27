<?php

namespace InetStudio\SchedulePackage\Slots\Application\Exceptions;

use Exception;

class ResourceReservationHasExpiredException extends Exception
{
    public static function create(string $id): self
    {
        $message = 'The slot %s reservation has expired.';

        return new static(sprintf($message, $id), 409);
    }
}

<?php

namespace InetStudio\SchedulePackage\Slots\Application\Actions\Api\GetSlots;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class GetSlotsData extends DataTransferObject
{
    public string $brand;
}

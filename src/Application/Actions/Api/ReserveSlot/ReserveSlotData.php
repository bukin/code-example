<?php

namespace InetStudio\SchedulePackage\Slots\Application\Actions\Api\ReserveSlot;

use Spatie\DataTransferObject\DataTransferObject;

class ReserveSlotData extends DataTransferObject
{
    public string $id;

    public string $hash;
}

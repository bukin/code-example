<?php

namespace InetStudio\SchedulePackage\Slots\Application\Actions\Api\ReserveSlot;

use Carbon\Carbon;
use InetStudio\SchedulePackage\Slots\Application\Exceptions\ResourceDoesNotExistException;
use InetStudio\SchedulePackage\Slots\Application\Exceptions\ResourceIsAlreadyReservedException;
use InetStudio\SchedulePackage\Slots\Domain\Entity\SlotModelContract;

class ReserveSlotAction
{
    public function __construct(
        protected SlotModelContract $model
    ) {}

    /**
     * @throws ResourceDoesNotExistException
     * @throws ResourceIsAlreadyReservedException
     */
    public function execute(ReserveSlotData $data): SlotModelContract
    {
        $slot = $this->model::find($data->id);

        if (! $slot) {
            throw ResourceDoesNotExistException::create($data->id);
        }

        if ($slot->reserved_at) {
            throw ResourceIsAlreadyReservedException::create($data->id);
        }

        $slot->reserved_at = Carbon::now();
        $slot->reserved_by = $data->hash;
        $slot->save();

        return $slot;
    }
}

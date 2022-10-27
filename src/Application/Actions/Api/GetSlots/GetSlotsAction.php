<?php

namespace InetStudio\SchedulePackage\Slots\Application\Actions\Api\GetSlots;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use InetStudio\SchedulePackage\Slots\Domain\Entity\SlotModelContract;

class GetSlotsAction
{
    public function __construct(
        protected SlotModelContract $model
    ) {}

    public function execute(GetSlotsData $data): Collection
    {
        $brand = $data->brand;

        $query = $this->model::query()
            ->with('user.roles')
            ->whereHas('user', function ($userQuery) use ($brand) {
                return $userQuery->whereHas('roles', function ($rolesQuery) use ($brand) {
                    return $rolesQuery->where('name', 'consultant-'.$brand);
                });
            })
            ->where('full_time_start', '>=', Carbon::now()->shiftTimezone('Europe/Moscow')->addDays(2)->startOfDay())
            ->where('full_time_end', '<=', Carbon::now()->shiftTimezone('Europe/Moscow')->addDays(9)->startOfDay())
            ->whereNull('reserved_at');

        return $query->get();
    }
}

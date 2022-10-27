<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SlotsResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->resource
            ->groupBy('date')
            ->map(function ($slots, $key) {
                return $slots->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'time_start' => $slot->time_start,
                        'time_end' => $slot->time_end,
                        'consultant' => [
                            'id' => $slot->user->id,
                            'name' => $slot->user->name,
                        ],
                    ];
                })->groupBy('time_start')->sortKeys();
            })
            ->sortKeys()
            ->toArray();
    }
}

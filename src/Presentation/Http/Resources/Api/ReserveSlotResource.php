<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveSlotResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'date' => $this->resource->date,
            'time_start' => $this->resource->time_start,
            'time_end' => $this->resource->time_end,
            'reserved_at' => $this->resource->reserved_at,
            'reserved_by' => $this->resource->reserved_by,
        ];
    }
}

<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Responses\Api;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use InetStudio\SchedulePackage\Slots\Domain\Entity\SlotModelContract;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Resources\Api\ReserveSlotResource;

class ReserveSlotResponse implements Responsable
{
    protected ?SlotModelContract $result;

    protected $error = null;

    public function setResult(?SlotModelContract $result): void
    {
        $this->result = $result;
    }

    public function setError(?Exception $error): void
    {
        $this->error = $error;
    }

    public function toResponse($request): JsonResponse
    {
        if ($this->error) {
            return response()->json([
                'error' => $this->error->getMessage()
            ], $this->error->getCode());
        }

        $resource = new ReserveSlotResource($this->result);

        return $resource->response();
    }
}

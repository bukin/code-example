<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Responses\Api;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Resources\Api\SlotsResource;

class GetSlotsResponse implements Responsable
{
    protected Collection $result;

    protected $error = null;

    public function setResult(Collection $result): void
    {
        $this->result = $result;
    }

    public function setError(?Exception $error): void
    {
        $this->error = $error;
    }

    public function toResponse($request): JsonResponse
    {
        $resource = new SlotsResource($this->result);

        return $resource->response();
    }
}

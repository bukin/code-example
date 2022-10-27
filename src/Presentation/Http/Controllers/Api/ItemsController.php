<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Controllers\Api;

use Exception;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Requests\Api\GetSlotsRequest;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Requests\Api\ReserveSlotRequest;
use InetStudio\SchedulePackage\Slots\Application\Actions\Api\GetSlots\GetSlotsAction;
use InetStudio\SchedulePackage\Slots\Application\Actions\Api\ReserveSlot\ReserveSlotAction;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Responses\Api\GetSlotsResponse;
use InetStudio\SchedulePackage\Slots\Presentation\Http\Responses\Api\ReserveSlotResponse;

class ItemsController extends Controller
{
    public function getSlots(GetSlotsRequest $request, GetSlotsAction $action, GetSlotsResponse $response): GetSlotsResponse
    {
        return $this->process($request, $action, $response);
    }

    public function reserveSlot(ReserveSlotRequest $request, ReserveSlotAction $action, ReserveSlotResponse $response): ReserveSlotResponse
    {
        return $this->process($request, $action, $response);
    }

    protected function process($request, $operation, $response)
    {
        $data = $request->getDataObject();

        $result = null;

        try {
            $result = $operation->execute($data);
        } catch (Exception $error) {
            $response->setError($error);
        }

        $response->setResult($result);

        return $response;
    }
}

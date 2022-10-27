<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\SchedulePackage\Slots\Application\Actions\Api\ReserveSlot\ReserveSlotData;
use Spatie\DataTransferObject\DataTransferObject;

class ReserveSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The id field is required',
            'id.uuid' => 'Field id must be a valid UUID',
            'hash.required' => 'The hash field is required',
            'hash.string' => 'The hash must be a string',
            'hash.max' => 'Field hash may not be greater than 36 symbols',
        ];
    }

    public function rules(): array
    {
        return [
            'id' => 'required|uuid',
            'hash' => 'required|string|max:36'
        ];
    }

    public function getDataObject(): ?DataTransferObject
    {
        return new ReserveSlotData([
            'id' => $this->input('id'),
            'hash' => $this->input('hash'),
        ]);
    }
}

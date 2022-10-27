<?php

namespace InetStudio\SchedulePackage\Slots\Presentation\Http\Requests\Api;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use InetStudio\SchedulePackage\Slots\Application\Actions\Api\GetSlots\GetSlotsData;
use Spatie\DataTransferObject\DataTransferObject;

class GetSlotsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'brand.required' => 'Field brand is required',
            'brand.in' => 'Field brand contains incorrect value',
        ];
    }

    public function rules(): array
    {
        return [
            'brand' => [
                'required',
                Rule::in(['laroche-posay', 'vichy'])
            ],
        ];
    }

    public function getDataObject(): ?DataTransferObject
    {
        return new GetSlotsData([
            'brand' => $this->get('brand'),
        ]);
    }
}

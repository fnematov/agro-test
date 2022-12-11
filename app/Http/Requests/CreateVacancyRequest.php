<?php

namespace App\Http\Requests;

use App\Enums\EmploymentTypeEnum;
use App\Enums\WorkplaceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateVacancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'location_id' => 'required|exists:locations,id',
            'position_id' => 'required|exists:positions,id',
            'title' => 'required|string|max:200',
            'job_description' => 'required|string|max:5000',
            'workplace_type' => ['required', new Enum(WorkplaceTypeEnum::class)],
            'employment_type' => ['required', new Enum(EmploymentTypeEnum::class)],
            'salary_from' => 'nullable|integer',
            'salary_to' => 'nullable|integer',
            'skills' => 'nullable|array',
            'skills.*' => 'required|string',
            'languages' => 'nullable|array',
            'languages.*' => 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\EmploymentTypeEnum;
use App\Enums\WorkplaceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateResumeRequest extends FormRequest
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
            'full_name' => 'required|string|max:200',
            'intro_text' => 'nullable|string|max:5000',
            'birth_date' => 'nullable|date_format:Y-m-d',
            'is_male' => 'nullable|boolean',
            'avatar' => 'nullable|image|max:4096',
            'phone_number' => 'nullable|integer',
            'expected_salary' => 'nullable|integer',
            'email' => 'nullable|email',
            'desired_position' => 'nullable|string|max:200',
            'employment_types' => 'nullable|array',
            'employment_types.*' => ['required', new Enum(EmploymentTypeEnum::class)],
            'workplace_types' => 'nullable|array',
            'workplace_types.*' => ['required', new Enum(WorkplaceTypeEnum::class)],
            'skills' => 'nullable|array',
            'skills.*' => 'required|string',
            'languages' => 'nullable|array',
            'languages.*' => 'required|string',
            'worked_places' => 'nullable|array',
            'worked_places.*.location_id' => 'required|exists:locations,id',
            'worked_places.*.organization_name' => 'required|string|max:200',
            'worked_places.*.job_title' => 'required|string|max:200',
            'worked_places.*.beginning_of_work' => 'required|date_format:Y-m-d',
            'worked_places.*.ending_of_work' => 'nullable|date_format:Y-m-d',
            'positions' => 'required|array',
            'positions.*' => 'required|exists:positions,id',
            'portfolio' => 'required|array',
            'portfolio.*.description' => 'nullable|string|max:200',
            'portfolio.*.images' => 'nullable|array',
            'portfolio.*.images.*' => 'required|image|max:4096'
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'employee' => [
                'full_name' => $this->employee->full_name,
                'phone_number' => $this->employee->phone_number
            ],
            'location' => $this->location->name,
            'full_name' => $this->full_name,
            'intro_text' => $this->intro_text,
            'birth_date' => $this->birth_date,
            'is_male' => $this->is_male,
            'avatar' => $this->avatar,
            'phone_number' => $this->phone_number,
            'expected_salary' => $this->expected_salary,
            'email' => $this->email,
            'desired_position' => $this->desired_position,
            'employment_types' => $this->employment_types,
            'workplace_types' => $this->workplace_types,
            'skills' => $this->skills,
            'languages' => $this->languages,
            'worked_places' => ResumeWorkedPlacesResource::collection($this->workedPlaces),
            'positions' => $this->positions,
            'portfolios' => ResumePortfolioResource::collection($this->portfolios)
        ];
    }
}

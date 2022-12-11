<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'job_description' => $this->job_description,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'skills' => $this->skills,
            'languages' => $this->languages,
            'organization' => [
                'name' => $this->organization->name,
                'logo' => $this->organization->logo,
            ],
            'location' => $this->location->name,
            'position' => $this->position->name,
            'resumes_count' => $this->resumes_count
        ];
    }
}

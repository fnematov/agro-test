<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeWorkedPlacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'location' => $this->location->name,
            'organization_name' => $this->organization_name,
            'job_title' => $this->job_title,
            'beginning_of_work' => $this->beginning_of_work,
            'ending_of_work' => $this->ending_of_work,
            'till_present' => !$this->ending_of_work
        ];
    }
}

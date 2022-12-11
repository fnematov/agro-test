<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacancyRequest;
use App\Http\Resources\ResumeResource;
use App\Http\Resources\VacancyResource;
use App\Models\Organization;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    private null|Organization $organization;

    public function __construct()
    {
        $this->organization = Organization::query()->where('user_id', Auth::id())->first();
    }

    public function index()
    {
        $vacancies = $this->organization->vacancies()
            ->with('organization', 'location', 'position')
            ->withCount('resumes')
            ->orderBy('id')
            ->get();
        return $this->success(VacancyResource::collection($vacancies));
    }

    public function create(CreateVacancyRequest $request)
    {
        $data = $request->validated();
        $vacancy = $this->organization->vacancies()->create($data);
        return $this->success(VacancyResource::make($vacancy), 201);
    }

    public function show(Vacancy $vacancy)
    {
        $vacancy->load('organization', 'location', 'position')->loadCount('resumes');
        return $this->success(VacancyResource::make($vacancy));
    }

    public function delete(Vacancy $vacancy)
    {
        try {
            $vacancy->delete();
        } catch (\Exception $e) {
            return $this->error([], "Can`t delete vacancy. Reason: " . $e->getMessage());
        }
        return $this->success();
    }

    public function update(CreateVacancyRequest $request, Vacancy $vacancy)
    {
        $data = $request->validated();
        $vacancy->fill($data);
        $vacancy->save();

        return $this->success(VacancyResource::make($vacancy), 204);
    }

    public function resumes(Vacancy $vacancy)
    {
        return $this->success(ResumeResource::collection($vacancy->resumes));
    }
}

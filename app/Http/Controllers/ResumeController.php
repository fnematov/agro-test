<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Http\Resources\VacancyResource;
use App\Models\Employee;
use App\Models\Resume;
use App\Models\Vacancy;
use App\Services\ResumeService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    private null|Employee $employee;
    private ResumeService $service;

    public function __construct()
    {
        $this->employee = Employee::query()->where('user_id', Auth::id())->first();
        $this->service = new ResumeService();
    }

    public function index()
    {
        return $this->success(ResumeResource::collection($this->employee->resumes));
    }

    public function create(CreateResumeRequest $request)
    {
        $data = $request->validated();
        $this->service->create($this->employee, $data);
        return $this->success([], 201);
    }

    public function update(CreateResumeRequest $request, Resume $resume)
    {
        $data = $request->validated();
        $this->service->update($resume, $data);
        return $this->success([], 204);
    }

    public function show(Resume $resume)
    {
        $resume->load('employee', 'location', 'workedPlaces.location', 'portfolios.files');

        return $this->success(ResumeResource::make($resume));
    }

    public function delete(Resume $resume)
    {
        $resume->delete();

        return $this->success($resume);
    }

    public function respondedVacancies(Resume $resume)
    {
        $vacancies = $resume->vacancies()
            ->with('organization', 'location', 'position')
            ->withCount('resumes')
            ->get();
        return $this->success(VacancyResource::collection($vacancies));
    }

    public function resumeVacancies(Resume $resume)
    {
        $vacancies = Vacancy::query()
            ->filterByLocation($resume->location_id)
            ->filterByPositions($resume->positionsPrimary->map(fn($p) => $p->position_id))
            ->filterBySalary($resume->expected_salary)
            ->filterByEmployeeTypes($resume->employment_types)
            ->filterByWorkplaceTypes($resume->workplace_types)
            ->filterByLanguages($resume->languages)
            ->filterBySkills($resume->skills)
            ->orderBy('id')
            ->get();

        return $this->success(VacancyResource::collection($vacancies));
    }

    public function response(Resume $resume, Vacancy $vacancy)
    {
        $resume->vacancyPrimary()->firstOrCreate(['vacancy_id' => $vacancy->id]);
        return $this->success(VacancyResource::make($vacancy));
    }
}

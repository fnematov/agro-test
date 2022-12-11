<?php

namespace App\Models;

use App\Casts\Comma;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property VacancyResponse[] $resumes
 */
class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'location_id', 'position_id', 'title', 'job_description', 'workplace_type',
        'employment_type', 'salary_from', 'salary_to', 'skills', 'languages', 'status'];

    protected $casts = [
        "skills" => Comma::class,
        'languages' => Comma::class
    ];

    public function scopeFilterByLocation(Builder $query, $location_id)
    {
        return $query->where('location_id', $location_id);
    }

    public function scopeFilterByPositions(Builder $builder, $positions = [])
    {
        return $builder->whereIn('position_id', $positions);
    }

    public function scopeFilterBySalary(Builder $query, $expected_salary = null)
    {
        return $query->when($expected_salary, fn(Builder $query) => $query->where(fn(Builder $builder) => $builder
            ->whereRaw('case when salary_from is null then salary_to >= ? else salary_from >= ? end', [$expected_salary, $expected_salary])
            ->orWhereRaw('case when salary_to is null then salary_from <= ? else salary_to >= ? end', [$expected_salary, $expected_salary])
        ));
    }

    public function scopeFilterByEmployeeTypes(Builder $builder, array $employee_types = [])
    {
        return $builder->whereIn('employment_type', $employee_types);
    }

    public function scopeFilterByWorkplaceTypes(Builder $builder, array $workplace_types = [])
    {
        return $builder->whereIn('workplace_type', $workplace_types);
    }

    public function scopeFilterByLanguages(Builder $builder, array $languages = [])
    {
        return $builder->where(fn(Builder $builder) => collect($languages)->each(fn($l) => $builder->orWhere('languages', 'ilike', "%$l%")));
    }

    public function scopeFilterBySkills(Builder $builder, array $skills = [])
    {
        return $builder->where(fn(Builder $builder) => collect($skills)->each(fn($s) => $builder->orWhere('skills', 'ilike', "%$s%")));
    }

    public function organization(): BelongsTo|Organization
    {
        return $this->belongsTo(Organization::class);
    }

    public function location(): BelongsTo|Location
    {
        return $this->belongsTo(Location::class);
    }

    public function position(): BelongsTo|Position
    {
        return $this->belongsTo(Position::class);
    }

    public function resumes(): HasManyThrough
    {
        return $this->hasManyThrough(Resume::class, VacancyResponse::class, 'vacancy_id', 'id', 'id', 'resume_id')
            ->with('location', 'employee', 'workedPlaces.location', 'portfolios.files');
    }
}

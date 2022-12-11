<?php

namespace App\Models;

use App\Casts\Comma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property ResumeWorkedPlace[] $workedPlaces
 * @property ResumePosition[] $positions
 * @property ResumePortfolio[] $portfolios
 * @property Vacancy[] $vacancies
 */
class Resume extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'location_id', 'full_name', 'intro_text', 'birth_date', 'is_male', 'avatar',
        'phone_number', 'expected_salary', 'email', 'desired_position', 'employment_types', 'workplace_types', 'languages',
        'skills', 'status'];

    protected $casts = [
        "skills" => Comma::class,
        'languages' => Comma::class,
        'employment_types' => Comma::class,
        'workplace_types' => Comma::class
    ];

    public function employee(): BelongsTo|Employee
    {
        return $this->belongsTo(Employee::class);
    }

    public function location(): BelongsTo|Location
    {
        return $this->belongsTo(Location::class);
    }

    public function workedPlaces(): HasMany
    {
        return $this->hasMany(ResumeWorkedPlace::class);
    }

    public function positions(): HasManyThrough
    {
        return $this->hasManyThrough(Position::class, ResumePosition::class, 'resume_id', 'id', 'id', 'position_id');
    }

    public function positionsPrimary(): HasMany
    {
        return $this->hasMany(ResumePosition::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(ResumePortfolio::class)->with('files');
    }

    public function vacancies(): HasManyThrough
    {
        return $this->hasManyThrough(Vacancy::class, VacancyResponse::class, 'resume_id', 'id', 'id', 'vacancy_id')
            ->with('location', 'organization');
    }

    public function vacancyPrimary(): HasMany
    {
        return $this->hasMany(VacancyResponse::class);
    }
}

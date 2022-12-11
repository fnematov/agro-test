<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Vacancy[] $vacancies
 */
class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'logo', 'intro_text', 'status'];

    public function user(): BelongsTo|User
    {
        return $this->belongsTo(User::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }
}

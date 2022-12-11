<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property ResumePortfolioFile[] $files
 */
class ResumePortfolio extends Model
{
    use HasFactory;

    protected $fillable = ['resume_id', 'description'];

    public function files(): HasMany
    {
        return $this->hasMany(ResumePortfolioFile::class);
    }
}

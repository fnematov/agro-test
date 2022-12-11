<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePortfolioFile extends Model
{
    use HasFactory;

    protected $fillable = ['resume_portfolio_id', 'path'];
}
